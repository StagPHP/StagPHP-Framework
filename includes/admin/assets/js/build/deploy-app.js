function deployApplication(){
  $.ajax({
    method: "POST",
    url: stag_api_ep + "/internal/deploy-app/",
    data: {
      'action': 'install'
    }
  }).done(function (response) {
    var data = JSON.parse(response);

    if (data['status']) {
      $('#zu-form-title').html('<td><span class="stag-icon stag-icon-check-circle-solid mr-2"></span></td><td><h2>Application Uploaded and Deployed</h2></td>');

      $('#success-alert').css('display', '').children('span').text('Application Uploaded and Deployed successfully');

      $('#zu-restart-process').css('display', '');

      $('#zu-installing-zip').css('display', 'none');
    }
  });
}

function ZUSuccessFunction(){
  deployApplication();
}

function ZUFailedFunction(){
  
}


// // Application Package Upload
// var file_vs = file_size = null;
// var bar = $('.progress-bar');
// var percent = $('.percent');
// var file_type = 'unknown';

// function application_upload_form() {

//   // Function to get file size
//   function get_file_size(file) {
//     var _size = file;
//     var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
//       i = 0;
//     while (_size > 900) {
//       _size /= 1024;
//       i++;
//     }
//     file_size = (Math.round(_size * 100) / 100) + ' ' + fSExt[i];
//     return file_size;
//   }

//   // Function Upload file
//   $("#application-upload").change(function () {
//     // Get file name from the absolute file path set by browser
//     var file_name_original = $(this).val().replace(/.*(\/|\\)/, '');

//     // Split the file name by dot
//     var file_name_array = file_name_original.split('.');

//     // Get the File Extension
//     // Assuming it is the last element of the array
//     var extension = file_name_array[file_name_array.length - 1];

//     // Validate Extension
//     if ('zip' == extension) {

//       $(this).parent(".file-upload-wrapper").attr("data-text", file_name_original).addClass('file-selected');
//       file_vs = event.target.files[0];

//       $('#file-hint-text').html('<span class="cyz-ico cyz-ico-zip"></span> Zip file selected. Size ' + get_file_size(file_vs.size));

//       //   fs_auto_fill(file_vs, new_file_title, new_file_name);
//     } else {
//       $(this).parent(".file-upload-wrapper").attr("data-text", 'File type not allowed!').removeClass('file-selected');
//       $(this).val(null);

//       $('#file-hint-text').html('<span class="cyz-ico cyz-ico-error"></span> Please select correct zip file');
//     }
//   });

//   // Ajax form for file upload
//   $('#upload_package').ajaxForm({
//     beforeSend: function () {
//       $('#upload_package').css('display', 'none');
//       $('#uploading_bar').css('display', '').animate({
//         opacity: 1
//       }, 300);
//       var percentVal = '0%';
//       bar.width(percentVal)
//       percent.html(percentVal);
//     },
//     uploadProgress: function (event, position, total, percentComplete) {
//       var percentVal = percentComplete + '%';
//       bar.width(percentVal)
//       percent.html(percentVal);
//     },
//     success: function () {
//       var percentVal = '100%';
//       bar.width(percentVal)
//       percent.html(percentVal);
//     },
//     complete: function (xhr) {
//       if (xhr.responseText) {
//         console.log(xhr.responseText);
//         $('#uploading_bar, .upload_package_title').animate({
//           opacity: 0
//         }, 300, function () {
//           $(this).css({
//             'display': 'none',
//             'opacity': 0
//           });
//           $('#done_info').css('display', '').animate({
//             opacity: 1
//           }, 300);
//           $('#nb-deployment').removeClass('disabled');
//         });
//       } else {
//         bar.removeClass('bg-endereum').addClass('bg-danger');
//         $('#uploading_bar').animate({
//           opacity: 0
//         }, 300, function () {
//           $(this).css({
//             'display': 'none',
//             'opacity': 0
//           });
//           $('#failed_info').css('display', '').animate({
//             opacity: 1
//           }, 300);
//         });
//       }
//     }
//   });
// }



// function app_deploy() {
//   $('.slider-for').slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     arrows: false,
//     draggable: false,
//     swipe: false,
//     touchMove: false,
//     infinite: false,
//     fade: true,
//     asNavFor: '.slider-nav'
//   });
//   $('.slider-nav').slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     accessibility: false,
//     arrows: false,
//     draggable: false,
//     swipe: false,
//     touchMove: false,
//     infinite: false,
//     asNavFor: '.slider-for',
//     dots: false,
//     focusOnSelect: true
//   });
//   $('.slick-next').on('click', function () {
//     $('.slider-for').slick('slickNext');
//   });
//   $('.slick-prev').on('click', function () {
//     $('.slider-for').slick('slickPrev');
//   });
// }



// function deployment_select() {
//   $('.select-deployment').on('click', function () {
//     $('.select-deployment').removeClass('selected');
//     $(this).addClass('selected');
//     Cookies.set('deployment_selected', $(this).data('deploy'), {
//       expires: 4
//     });
//     $('#nb-deployment').removeClass('disabled');
//   });
// }



// function monitor_slick() {
//   $('.slider-for').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
//     if ('1' == nextSlide) {
//       var deployment_selected = Cookies.get('deployment_selected');

//       $('#nb-deployment').addClass('disabled');

//       if (deployment_selected) {
//         if ('manual-upload-deployment' == deployment_selected) {
//           $('#manual-upload-deployment').css({
//             'display': '',
//             'opacity': 1
//           });

//         } else if ('github-deployment' == deployment_selected) {
//           $('#github-deployment').css({
//             'display': '',
//             'opacity': 1
//           });
//         } else {
//           $('#deploy-mns').css({
//             'display': '',
//             'opacity': 1
//           });
//         }
//       } else {
//         $('#deploy-mns').css({
//           'display': '',
//           'opacity': 1
//         });
//       }
//     }
//   });
// }



// function function_sequence(){
//   try { app_deploy(); } catch (err) {}
//   try { deployment_select(); } catch (err) {}
//   try { application_upload_form(); } catch (err) {}
//   try { monitor_slick(); } catch (err) {}
// }
