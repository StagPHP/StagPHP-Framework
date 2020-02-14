var start_time;
var end_time;

function get_time(){
  var d = new Date();
  return d.getTime();
}

function start_loading(){
  $('.lv-head, .lv-lists').css('display', 'none');
  $('.lv-loading').css('display', '');
}

function show_error(){
  $('.lv-lists.error').css('display', '');
}

function show_no_result(){
  $('.lv-lists.no-result').css('display', '');
}

function show_view(){
  $('.lv-head, #lv-list').css('display', '');
}

function loaded(function_name){
  js_click();

  end_time = get_time();

  var time_diff = end_time - start_time;

  var delay = 2000;

  if(time_diff < delay) delay = delay - time_diff;

  setTimeout(() => {
    $('.lv-loading').css('display', 'none');
    function_name();
  }, delay);
}

function create_view_list(response){
  if(response.length) {
    $('#lv-list').html('')
    $('#lv-list').html(function(){
      $html = '<table>';

      response.forEach(element => {
        $html = $html + '<tr><td class="py-2 px-3"><input type="checkbox"/></td>';
        $html = $html + '<td data-href="' + app_view_editor + '?view=' + name + '&id=' + element['id'] + '"';
        $html = $html + 'class="p-3">' + element['instance_name'] + '</td>';
        $html = $html + '<td class="p-3">' + element['date_updated'] + '</td></tr>';
      });

      return $html + '</table>';
    });

    loaded(show_view);
  }
  
  else loaded(show_no_result);
}

function get_views(){
  start_time = get_time();

  $.ajax({
    method: "POST",
    url: stag_get_static_view_list,
    data: {
      name: name,
      action: "get",
      offset: "0-10"
    }
  }).done(function(data_received){

    var data = JSON.parse(data_received);

    if(data['status']) create_view_list(data['result']['view-list']);

    else loaded(show_error);

  }).fail(function() {

    loaded(show_error);

  });
}

function refresh_view(){
  $('#refresh-view').on('click', function(){
    start_loading();

    $.ajax({
      method: "POST",
      url: stag_get_static_view_list,
      data: {
        name: name,
        action: "refresh-view",
        offset: "0-10"
      }
    }).done(function(data_received){

      var data = JSON.parse(data_received);
  
      if(data['status']) get_views();

      else loaded(show_error);
      
    }).fail(function() {
  
      loaded(show_error);
  
    });
  });
}

function view_specific_function(){
  try { get_views(); } catch (err) {}
  try { refresh_view(); } catch (err) {}
}
