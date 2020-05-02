function installStagON(){
  $.ajax({
    method: "POST",
    url: stag_api_ep + "/internal/stagon-add/",
    data: {
      'action': 'install'
    }
  }).done(function (response) {
    var data = JSON.parse(response);

    if (data['status']) {
      $('#zu-form-title').html('<td><span class="stag-icon stag-icon-check-circle-solid mr-2"></span></td><td><h2>StagON Uploaded and Installed</h2></td>');

      $('#success-alert').css('display', '').children('span').text('StagON uploaded and installed successfully');

      $('#zu-restart-process').css('display', '');

      $('#zu-installing-zip').css('display', 'none');
    }
  });
}

function ZUSuccessFunction(){
  installStagON();
}

function ZUFailedFunction(){
  
}

// function formatFileName(filename) {
//   var file_name_original = filename.replace(/.*(\/|\\)/, '')
//   var file_name_array = file_name_original.split('.');

//   // File Extension
//   var extension = file_name_array[file_name_array.length - 1];

//   // File name without extension
//   var file_name = file_name_original.replace('.' + extension, '');
//   file_name = file_name.replace(/(^-+)|([^a-zA-Z0-9\-]+)|(-$)|(-{2,})/ig, "");

//   return {
//     'name': file_name,
//     'ext': extension,
//     'name-ext': file_name + '.' + extension
//   };
// }

// function resetZFFrom() {
//   $('#zf-reset').on('click', function () {
//     $(this).parents(".zf-upload-block").find('#zf-or-sep, #zf-select-file, #zf-footer').css('display', '');
//     $(this).parents(".zf-upload-block").find('#zf-submit-button').css('display', 'none');

//     $(this).parents(".zf-upload-block").find("#stagon-upload-field").val(null);

//     $(this).parents(".zf-upload-block").find('#upload-status').html('<td><h2>Drag and Drop StagON</h2></td>');
//   });
// }

// // Function Upload file
// $("#stagon-upload-field").change(function () {
//   var fileDetail = formatFileName($(this).val())

//   // Check extension is of zip file type
//   if ('zip' == fileDetail['ext']) {
//     var html_data = '<td><h2>' + fileDetail['name-ext'] + '</h2></td><td><span class="stag-icon stag-icon-close-solid ml-2" id="zf-reset"></span></td>';

//     $(this).parents(".zf-upload-block").find('#zf-or-sep, #zf-select-file, #zf-footer').css('display', 'none');
//     $(this).parents(".zf-upload-block").find('#zf-submit-button').css('display', '');

//     $(this).parents(".zf-upload-block").find('#upload-status').html(html_data);

//     $(this).parents(".zf-upload-block").find('#file_name').val(fileDetail['name-ext']);

//     resetZFFrom();
//   } else $(this).val(null);
// });

// $('#upload-file').ajaxForm({
//   beforeSend: function () {
//     $('#zf-submit-button').css('display', 'none');
//     $('#upload-status').html('<td><h2>Uploading StagON</h2></td>');
//     $('#zf-progress').css('display', '').find('.progress-bar').animate({
//       opacity: 1,
//       width: 0
//     }, 300);
//   },
//   uploadProgress: function (event, position, total, percentComplete) {
//     var percentVal = percentComplete + '%';
//     $('#zf-progress .progress-bar').width(percentVal)
//   },
//   success: function () {
//     var percentVal = '100%';
//     $('#zf-progress .progress-bar').width(percentVal)
//   },
//   complete: function (xhr) {

//     console.log('The response from the server: ' + xhr.responseText);

//     if (xhr.responseText) {
//       $('#zf-progress').animate({
//         opacity: 0
//       }, 300, function () {
//         $(this).css({
//           'display': 'none',
//           'opacity': 0
//         });

//         $('#zf-installing-zip').css('display', '');

//         setTimeout(() => {
//           installStagON();
//         }, 500);
//       });
//     } else {
//       $('#zf-progress .progress-bar').removeClass('bg-info').addClass('bg-danger');

//       $('#zf-progress').animate({
//         opacity: 0
//       }, 300, function () {
//         $(this).css({
//           'display': 'none',
//           'opacity': 0
//         });

//         var html_data = '<td><span class="stag-icon stag-icon-error-solid mr-2"></span></td><td><h2>StagON Failed to Upload or Install</h2></td>';

//         $('#upload-status').html(html_data);

//         $('#failed-alert').css('display', '').children('span').text('StagON failed to upload or install successfully');

//         $('#restart-retry-upload').text('Retry');

//         $('#zf-restart-process').css('display', '');
//       });
//     }
//   }
// });