function jdb_get_db(){
  $.ajax({
    method: "POST",
    url: app_model_query,
    data: {
      // action:  key,
      // name: name,
      // action: "get",
      // offset: "0-10"
      action: 'get-db-names'
    }
  }).done(function(result){
    try{ var data = JSON.parse(result); } catch(e) {}

    if(data && 'success' == data['status']){

      var response = data['response'];

      $('#db-names').html('')
      $('#db-names').html(function(){
        $html = '';

        response.forEach(element => {
          $html = $html + '<tr><td style="width: 50px;" class="pl-3 text-center">';
          $html = $html + '<span class="cyz-ico cyz-ico-database"></span></td>';
          $html = $html + '<td>' + element + '</td>';
          $html = $html + '<td class="pr-3"><a class="link" href="#' + element;
          $html = $html + '">Explore DB</a></td>';
        });

        return $html;
      });
    }
  }).fail(function(error) {

    console.log(error);

  });
}
