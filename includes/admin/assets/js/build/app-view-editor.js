var start_time;
var end_time;

function get_time(){
  var d = new Date();
  return d.getTime();
}


function start_loading(){
  $('#fe-php-editor, .sidebar-content').css('display', 'none');
  $('.block-loading').css('display', '');
}


function show_error(){
  // $('.lv-lists.error').css('display', '');
}

function show_no_result(){
  // $('.lv-lists.no-result').css('display', '');
}

function show_view(){
  $('.sidebar-content').css('display', '');
}



function load_editor(response){
  $('#fe-php-editor').text(response);


  // trigger extension
  ace.require("ace/ext/language_tools");
  var editor = ace.edit("fe-php-editor");
  editor.setTheme("ace/theme/monokai");
  editor.session.setMode("ace/mode/php");
  editor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: false,
    // scrollPastEnd: 0.1,
    fontSize: "12pt"
  });

  var beautify = require("ace/ext/beautify");
  editor.commands.addCommands(beautify.commands);

  $('#fe-php-editor').animate({
    opacity: 1
  }, 300);
}



function loaded(response, function_name){
  js_click();

  end_time = get_time();

  var time_diff = end_time - start_time;

  var delay = 2000;

  if(time_diff < delay) delay = delay - time_diff;

  setTimeout(() => {
    $('.block-loading-floating, .block-loading').css('display', 'none');
    load_editor(response);
    function_name();
  }, delay);
}



function show_code(result){

  try{ var data = JSON.parse(result); } catch(e) {}
  
  if(data && 'success' == data['status']){

    var response = data['response'];
      loaded(data['response'], show_view);
    } else {
      // loaded(show_no_result);
    }

  // loaded(show_error);
}



function get_code(){
  start_time = get_time();

  $.ajax({
    method: "POST",
    url: app_edit,
    data: {
      id: id
    }
  }).done(function(result){
    
    show_code(result);
    
  }).fail(function() {

    // loaded(show_error);

  });
}



function view_specific_function(){
  try { get_code(); } catch (err) {}
}
