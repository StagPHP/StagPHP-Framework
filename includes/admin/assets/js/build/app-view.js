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

function show_error(extra = null){
  $('.lv-lists.error').css('display', '');
}

function show_no_result(extra = null){
  $('.lv-lists.no-result').css('display', '');
}

function show_view(extra = null){
  $('.instance-list, #lv-list').css('display', '');
  $('#item-count').html(extra);
  if(extra > 1){
    $('#item-Instance').html('Instances');
  }
}

function loaded(function_name, extra){
  js_click();

  end_time = get_time();

  var time_diff = end_time - start_time;

  var delay = 2000;

  if(time_diff < delay) delay = delay - time_diff;

  setTimeout(() => {
    $('.lv-loading').css('display', 'none');
    function_name(extra);
  }, delay);
}

function create_view_list(response){
  if(response.length) {
    $('.instance-list tbody').html(function(){
      $html = '';
    
      response.forEach(element => {
        $html = $html + '<tr><td ';
        $html = $html + 'class="p-3"><div class="md-checkbox"><input id="' + element['id'] + '" type="checkbox"><label for="' + element['id'] + '">' + element['instance_name'] + '</label></div></td>';
        $html = $html + '<td class="p-3">' + element['date_updated'] + '</td></tr>';
      });

      // data-href="' + app_view_editor + '?view=' + name + '&id=' + element['id'] + '"

      return $html;
    });

    loaded(show_view, response.length);
  }
  
  else loaded(show_no_result, null);
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

    else loaded(show_error, null);

  }).fail(function() {

    loaded(show_error, null);

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

      else loaded(show_error, null);
      
    }).fail(function() {
  
      loaded(show_error, null);
  
    });
  });
}

function view_specific_function(){
  try { get_views(); } catch (err) {}
  try { refresh_view(); } catch (err) {}
}
