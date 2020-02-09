function tabs_action(event, func = null){
  var tabs = $(event).parents('.tabbed').find('.tab');
  var pointed_tab = $(event).data('href').replace("#", ".");

  $(event).parent('.header-tabs').children('a').removeClass('active');

  $(event).addClass('active');

  tabs.css('opacity', '').removeClass('active');

  $(pointed_tab).addClass('active').animate({
    opacity: 1
  }, 200);

  if(func) func();

  return false;
}
