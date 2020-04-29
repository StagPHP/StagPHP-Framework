var start_time;
var end_time;
var active_stagons = [];

// Helper Function
$('#select-all').on('click', function(){
  var classToBeSelected = '.' + $(this).data('select-class');

  if ($(this).hasClass('all-selected')) {
    $(classToBeSelected).find('input:checkbox').prop('checked', false);
    $(this).text('Select All');
    $(this).removeClass('all-selected');
  }

  else {
    $(classToBeSelected).find('input:checkbox').prop('checked', true);
    $(this).text('Clear Selection');
    $(this).addClass('all-selected');
  }
});

// Delete Button
function renderSelectionEvents(){

  /** Enable disable buttons and set value
   * of selected stagons */
  setInterval(() => {
    var elements = $('.stagon-block').find('input:checkbox');

    var activate = false;
    var deActivate = false;

    var temp_active_stagons = [];

    elements.each(function(){
      if($(this).prop('checked')){
        var id = $(this).attr('id');

        temp_active_stagons.push(id);
      }

      if('active' == $(this).data('active')){
        if($(this).prop('checked')){
          deActivate = true;
        }
      } else {
        if($(this).prop('checked')){
          activate = true;
        }
      }
    });

    if (activate && !deActivate){
      $('#activate-stagon').css('display', '');
      $('#deactivate-stagon').css('display', 'none');
    } else if (!activate && deActivate){
      $('#activate-stagon').css('display', 'none');
      $('#deactivate-stagon').css('display', '');
    } else {
      $('#activate-stagon').css('display', 'none');
      $('#deactivate-stagon').css('display', 'none');
    }

    if(temp_active_stagons.length > 0 && !deActivate){
      $('#delete-item').css('display', '');
    } else {
      $('#delete-item').css('display', 'none');
    }

    if ((JSON.stringify(active_stagons) != JSON.stringify(temp_active_stagons))) {
      active_stagons = temp_active_stagons;
    }
    
  }, 200);
}

$('#refresh-view').on('click', function(){
  start_loading();

  get_views();
});


$('#activate-stagon').on('click', function(){
  start_loading();

  var elements = $('.stagon-block').find('input:checkbox');

  var temp_active_stagons = [];

  elements.each(function(){
    if($(this).prop('checked')){
      var id = $(this).attr('id');

      temp_active_stagons.push(id);
    }
  });

  var csv = "";

  for(let i = 0; i < temp_active_stagons.length; i++){
    if("" == csv) csv = temp_active_stagons[i];

    else csv += "," + temp_active_stagons[i];
  }

  $.ajax({
    method: "POST",
    url: stag_get_stagons_list,
    data: {"action": "activate", "plugins-csv": csv}
  }).done(function(data_received){
    get_views();
  }).fail(function(){
    loaded(show_error, null);
  });
});


$('#deactivate-stagon').on('click', function(){
  start_loading();

  var elements = $('.stagon-block').find('input:checkbox');

  var stagons_array = [];

  elements.each(function(){
    if($(this).prop('checked')){
      var id = $(this).attr('id');

      stagons_array.push(id);
    }
  });

  var csv = "";

  for(let i = 0; i < stagons_array.length; i++){
    if("" == csv) csv = stagons_array[i];

    else csv += "," + stagons_array[i];
  }

  $.ajax({
    method: "POST",
    url: stag_get_stagons_list,
    data: {"action": "deactivate", "plugins-csv": csv}
  }).done(function(data_received){
    get_views();
  }).fail(function(){
    loaded(show_error, null);
  });
});


function get_stagon_block(id, is_active, title, desc, img){
  if (is_active) {
    var active_class = 'active';
    // var checked = 'checked';
  } else {
    var active_class = '';
    // var checked = '';
  }

  // Stagon Block
  var html = '<div class="col-12 stagon-block ' + active_class + ' drag-able"><table><tr>';

  // Image Block
  html += '<td><div class="stagon-media" style="background-image: url('+img+');">';
  html += '<div class="md-checkbox"><input id="'+id+'" data-active="' + active_class + '" type="checkbox">';
  html += '<label for="'+id+'"></label></div></div></td>';     
  
  // Content Block
  html += '<td class="p-3"><h3 class="card-title"><label class="head-label" for="'+id+'">';
  html += title+'</label></h3><p class="card-text mb-3">'+desc+'</p>';
  html += '<p class="m-0">';

  // Verified
  html += '<span class="stag-icon stag-icon-verified text-success"></span> <strong>Verified</strong><span class="mx-2 text-muted">|</span>';

  // Settings
  html += '<a class="link my-0" href="<?php echo get_home_url().$url_retry; ?>">Settings</a><span class="mx-2 text-muted">|</span>';

  // Documents
  html += '<a class="link my-0" href="<?php echo get_home_url().$url_retry; ?>">Docs <span class="stag-icon stag-icon-new-window"></span></a>';

  // END: Content Block
  html += '</p></td>';

  // END: Stagon Block
  html += '</tr></table></div>';

  // Return The HTML
  return html;
}

function get_time(){
  var d = new Date();
  return d.getTime();
}

function start_loading(){
  $('.tab').css('display', 'none');
  $('.lv-loading').css('display', '');
}

function show_error(extra = null){
  $('.lv-lists.error').css('display', '');
}

function show_no_result(extra = null){
  $('.lv-lists.no-result').css('display', '');
}

function show_view(extra = null){
  $('.stagons-list-container').css('display', '');
  $('#item-count').html(extra);
  renderSelectionEvents();
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

function create_stagons_list(response){
  if(response.length) {
    $('.stagons-list-container').html(function(){
      $html = '';
    
      response.forEach(element => {
        $html += get_stagon_block(element['id'], element['active'], element['title'], element['desc'], element['img_light']);
      });

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
    url: stag_get_stagons_list,
    data: {action: "get"}
  }).done(function(data_received){

    var data = JSON.parse(data_received);

    if(data['status']) create_stagons_list(data['result']['view-list']);

    else loaded(show_error, null);

  }).fail(function() {

    loaded(show_error, null);

  });
}

function view_specific_function(){
  try { get_views(); } catch (err) {}
}
