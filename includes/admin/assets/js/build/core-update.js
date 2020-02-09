function stag_core_update_actions(action){
  $.ajax({
    url: manage_update_rep,
    method: "POST",
    data: {action: action}
  }).done(function(result){
    console.log(result);
  
    if("download-core-update" == action){
      var data = JSON.parse(result);

      console.log('downloaded');

      if('downloaded' == data['response']){
        stag_core_update_actions('install-update');
      }
    }
    if("install-update" == action){
      console.log('Updated');
    }
  }).fail(function(jqXHR, textStatus){
    console.log("Request failed: " + textStatus);
  });
}

$('.cyz-update').on('click', function(){
  stag_core_update_actions($(this).data('update'));
})
