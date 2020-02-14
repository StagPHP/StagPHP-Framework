// Custom Scrollbar for all intances
function custom_scrollbar(){
  document.getElementsByClassName('body-content')[0].style.overflow = 'auto';
  var Scrollbar = window.Scrollbar;
  Scrollbar.init(document.querySelector('.nice-scroll'));
}

function stag_php_debug_console(event, log = null){
  if('init' == event){
    console.log("%c StagPHP %c DOM Development & Debug", "color: white; background: rgb(0,172,193); font-size: 24px; font-weight: bold; font-style: italic;", "font-size: 24px; font-weight: normal;");
  }
  
  else if('error' == event){
    console.log('%c ERROR %c' + log, 'color: white; background: rgb(192,57,43); font-weight: bold;', '');
  }

  else if('success' == event){
    console.log('%c SUCCESS %c ' + log, 'color: white; background: rgb(120,194,87); font-weight: bold; font-style: italic;', '');
  }

  else if('warning' == event){
    console.log('%c WARNING %c ' + log, 'color: white; background: rgb(230,126,34); font-weight: bold; font-style: italic;', '');
  }
}

function spinner_remove(element){
  element.removeClass('spinner-active spinner-added').find('div.spinner').animate({
    'opacity': 0
  }, 200, function(){
    $(this).remove();
    element.addClass('spinner-removed');
  });
}

function render_spinner(){
  $('.spinner-active.inner-html.div-type-spinner').not('.spinner-added').prepend('<div class="spinner"><svg width="1em" height="1em"><circle cx="0.5em" cy="0.5em" r="0.45em"/></svg></div>').addClass('spinner-added');
}

// Js Click as JS Link
function js_click(){
  $("[data-href]").on('click', function () {
    if($(this).is('[target=_blank]')){
      window.open($(this).attr("data-href"), '_blank');
    }else{
      window.location = $(this).attr("data-href");
    }
  });

  $("[data-link]").on('click', function () {
    var href = $('#' + $(this).attr("data-link") + '-link').attr('href');
    if(href) window.location = href;
  });

  if($('.js-click').attr('href')){
    $('.js-click').on('click', function redirect(){
      window.location = $(this).attr('href');
    });
  }
}



// Side Navigation Toggle
function toggle_menu(num) {
  if (num == 1) {
    $('#body-container, #navigation, #drawer, .footer').addClass('menu-open').bind("transitionend webkitTransitionEnd", function () {
      $('#body-container').addClass('on-flow');
    });
    document.getElementById('drawer').onclick = function () {
      toggle_menu(0)
    };
  }
  if (num == 0) {
    $('#body-container, #navigation, #drawer, .footer').removeClass('menu-open').bind("transitionend webkitTransitionEnd", function () {
      $('#body-container').removeClass('on-flow');
    });
    document.getElementById('drawer').onclick = function () {
      toggle_menu(1)
    };
  }
}
// Side Navigation Toggle using Hammer
function hammer_int(){
  var body_swap_element = document.getElementById('swipe-h');

  var options = {
    domEvents: true
  };

  var hammer = new Hammer(body_swap_element, options);

  hammer.on("swiperight", function(){  
    toggle_menu(1);
  });
  hammer.on("swipeleft", function(){  
    toggle_menu(0);
  });
}



// Disable Side Navigation Dropdown Menu
function disable_sn_dd(element){
  element.each(function(){
    var sub_m = '#sub-menu-' + $(this).data('submenu-id');

    if($(sub_m + ' > a').length == 0){
      $(this).addClass('disabled')
    }
  });
}
// Side Navigation Dropdown Menu Toggle
function sn_dd(){
  // Enable Dropdown Functionality
  $('.drop-down').on('click', function () {
    if ($(this).hasClass('opened')) {
      var sub_m = '#sub-menu-' + $(this).data('submenu-id');
      $(sub_m).removeClass('opened');
      $(this).removeClass('opened');
    } else {
      var sub_m = '#sub-menu-' + $(this).data('submenu-id');
      $(sub_m).addClass('opened');
      $(this).addClass('opened');
    }
  });

  // Disable Dropdown Functionality for blank menu
  try { disable_sn_dd($('.drop-down')); } catch (err) {}
}



// Widget Collapse Function
function widget_collapse(){
  $('.widget-minimize').on('click', function(event){
    var wid_element = $(this).parents('.widget-body');
    wid_element.children('.body').slideToggle("fast");

    var ico_button = wid_element.find('.header').children('.cyz-ico');

    if(ico_button.hasClass('cyz-ico-up-arrow')) {
      ico_button.removeClass('cyz-ico-up-arrow').addClass('cyz-ico-down-arrow');
    } else {
      ico_button.removeClass('cyz-ico-down-arrow').addClass('cyz-ico-up-arrow');
    }
  });
}
// Widget Drag Function
function widget_drag(){
  dragula([document.getElementById('drag-able')]);
}

function notify(data, type){
  console.log(data);

  $('.no-notify').remove();

  $('#notification-list').append('<tr class="alert" data-notify="' +
  type + '"><td><span class="cyz-ico cyz-ico-alert"></span></td><td><a href="#">'
  + data.replace("_", " ") + '</a></td></tr>');

  $('.alert').on('click', function(){
    if('update' == $(this).data('notify')){
      window.location = core_update;
    }
  });
}


function stag_core_update(){
  // Get core update last check variable from cookie
  var last_update_check = Cookies.get('CYZ_CU_LC');

  if(last_update_check){
    if('updated' == last_update_check) return;

    else notify(last_update_check, 'update')
  }
  
  else {
    $.ajax({
      url: stag_api_ep_core_update,
      method: "POST",
      data: {action: "check-update"}
    }).done(function(data_received){
      var data = JSON.parse(data_received);

      if(!data['status']) {
        stag_php_debug_console('error', data['description']);
        return;
      }

      var result = data['result'];

      if(result['response']){
        var msg = 'Update_Available_V_' + response['version'];
      
        Cookies.set('CYZ_CU_LC', msg, {expires: 1});

        notify(msg, 'update');
      } else {
        var msg = 'updated';

        Cookies.set('CYZ_CU_LC', msg, {expires: 1});
      }
    }).fail(function(jqXHR, textStatus){
      stag_php_debug_console('error', textStatus);
    });
  }
}


function function_sequence() {
  stag_php_debug_console('init');

  try { custom_scrollbar(); } catch (err) {}
  try { hammer_int(); } catch (err) {}
  try { js_click(); } catch (err) {}
  try { sn_dd(); } catch (err) {}
  try { widget_collapse(); } catch (err) {}
  try { widget_drag(); } catch (err) {}
  try { jdb_get_db(); } catch (err) {}
  try { stag_core_update(); } catch (err) {}
  try { view_specific_function(); } catch (err) {}
}


// =========================================================
// On Load
// =========================================================
if (window.addEventListener) {
  window.addEventListener('load', function () {
    function_sequence();
  });
} else {
  window.attachEvent('onload', function () {
    function_sequence();
  });
}
