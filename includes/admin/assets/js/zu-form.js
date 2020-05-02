function formatFileName(filename){
  var file_name_original = filename.replace(/.*(\/|\\)/, '')
  var file_name_array = file_name_original.split('.');

  // File Extension
  var extension = file_name_array[file_name_array.length - 1];

  // File name without extension
  var file_name = file_name_original.replace('.' + extension, '');
  file_name = file_name.replace(/(^-+)|([^a-zA-Z0-9\-]+)|(-$)|(-{2,})/ig, "");

  return {
    'name': file_name,
    'ext': extension,
    'name-ext': file_name + '.' + extension
  };
}

function resetZUFrom(){
  $('#zf-reset').on('click', function () {
    /** Getting file name */
    var fileName = $('#zu-form').data('file-name');

    $('#zu-sep, #zu-select-file-base, #zf-footer').css('display', '');

    $('#zu-submit-button').css('display', 'none');

    $("#zu-upload-field").val(null);

    $('#zu-form-title').html('<td><h2>Drag and Drop ' + fileName + '</h2></td>');
  });
}

function initZUForm(){
  $('#zu-form').ajaxForm({
    beforeSend: function () {
      /** Getting file name */
      var fileName = $('#zu-form').data('file-name');

      /** Submit Button */
      $('#zu-submit-button').css('display', 'none');

      /** Upload Title */
      $('#zu-form-title').html('<td><h2>Uploading ' + fileName + '</h2></td>');

      /**  */
      $('#zu-upload-progress').css('display', '').find('.progress-bar').animate({
        opacity: 1,
        width: 0
      }, 300);
    },
    uploadProgress: function (event, position, total, percentComplete) {
      $('#zu-upload-progress .progress-bar').width(percentComplete + '%');
    },
    success: function () {
      $('#zu-upload-progress .progress-bar').width('100%');
    },
    complete: function (xhr) {
      /** On Success */
      if (xhr.responseText) {
        $('#zu-upload-progress').animate({
          opacity: 0
        }, 300, function () {
          /** Hide Upload Progress */
          $(this).css({
            'display': 'none',
            'opacity': 0
          });

          /**  */
          $('#zu-installing-zip').css('display', '');

          setTimeout(() => {
            try {
              ZUSuccessFunction();
            } catch (err) {}
          }, 500);
        });
      }

      /** On failure */
      else {
        /** Getting file name */
        var fileName = $('#zu-form').data('file-name');

        // Turn file up-loader progress bar bg
        $('#zu-upload-progress .progress-bar').removeClass('bg-info').addClass('bg-danger');

        setTimeout(() => {
          $('#zu-upload-progress').animate({
            opacity: 0
          }, 300, function () {
            $(this).css({
              'display': 'none',
              'opacity': 0
            });

            try {
              /** Upload Title */
              $('#zu-form-title').html('<td><span class="stag-icon stag-icon-error-solid mr-2"></span></td><td><h2>' + fileName + ' Failed to Upload or Install</h2></td>');

              $('#failed-alert').css('display', '').children('span').text(fileName + ' failed to upload or install successfully');

              $('#zu-restart-process').css('display', '');

              $('#restart-retry-upload').text('Retry');

              ZUFailedFunction();
            } catch (err) {}
          });
        }, 500);
      }
    }
  });

  // Function Upload file
  $("#zu-upload-field").change(function () {
    var fileDetail = formatFileName($(this).val())

    // Check extension is of zip file type
    if ('zip' == fileDetail['ext']) {
      $('#zu-sep, #zu-select-file-base, #zf-footer').css('display', 'none');

      $('#zu-submit-button').css('display', '');

      $('#zu-form-title').html('<td><h2>' + fileDetail['name-ext'] + '</h2></td><td><span class="stag-icon stag-icon-close-solid ml-2" id="zu-reset"></span></td>');

      $('#zu-file-name').val(fileDetail['name-ext']);

      resetZUFrom();
    } else $(this).val(null);
  });
}