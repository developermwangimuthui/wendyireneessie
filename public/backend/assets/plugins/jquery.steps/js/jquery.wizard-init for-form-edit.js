/**
 * Form wizard page
 */

!(function ($) {
    "use strict";

    var FormWizard = function () {};

    
       
        //creates vertical form
        (FormWizard.prototype.createVertical = function ($form_container) {
            var isUploading = true; //to use when uploading images to server
            $form_container.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                stepsOrientation: "vertical",
                onStepChanging: function (event, currentIndex, newIndex) {
                    
                    if (currentIndex == 0) {
                        var fileInput = $.trim($("#mainimage").val());
                        if (fileInput.length > 0) {
                            var url = $("#mainimage").attr("url");
                            var urlimg = $("#imagename").attr("url");
                            var data = new FormData();
                            data.append(
                                "mainimage",
                                $("#mainimage")[0].files[0]
                            );
                            var filesLength = document.getElementById("gallery")
                                .files.length;
                            for (var i = 0; i < filesLength; i++) {
                                data.append(
                                    "gallery[]",
                                    document.getElementById("gallery").files[i]
                                );
                            }
                            // console.log(data.gallery);
                            $(".imguploadoverlay").fadeIn();
                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            });
                            //    data.append("_token", "{{ csrf_token() }}");
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: data,
                                enctype: "multipart/form-data",
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function (data) {
                                    $(".imguploadoverlay").fadeOut();
                                    var html = "";
                                    if (data.errors) {
                                        Lobibox.notify("error", {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: "top right",
                                            icon: "fa fa-times-circle",
                                            msg: data.success,
                                        });
                                        console.log(data.success);
                                    }
                                    if (data.success) {
                                        isUploading = false;
                                        console.log("success");
                                        Lobibox.notify("success", {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: "top right",
                                            icon: "fa fa-check-circle",
                                            img: urlimg + data.mainimage, //path to image
                                            msg: data.success,
                                        });
                                        $("#imagename").val(data.mainimage);
                                        // var myJsonString = JSON.stringify(
                                        //     data.gallery
                                        // );
                                        $("#galleryvalues").val(data.gallery);
                                        
                                    }
                                },
                                error: function () {
                                    Lobibox.notify("error", {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: "top right",
                                        icon: "fa fa-times-circle",
                                        msg: "Image Upload failed. Try again",
                                    });
                                    console.log("error");
                                },
                            });
                           
                        } else{
                                isUploading = false;
                                return $form_container;
                        }
                        
                    } else if (currentIndex == 1) {
                        
                        
                    } else if (currentIndex == 2) {
                       
                    }
                    return $form_container;
                },
                onFinished: function (event, currentIndex) {
                    console.log("Submitted");
                    //store function
                    var url = $("#editvehicleform").attr("url");
                    if (isUploading) {
                        Lobibox.notify("warning", {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: "top right",
                            icon: "fa fa-exclamation-circle",
                            msg: "Image upload in progress. Please wait",
                        });
                    } else {
                         if (
                             !$.trim($(".make").val()) == "" &&
                             !$.trim($(".model").val()) == "" &&
                             !$.trim($(".bodytype").val()) == "" &&
                             !$.trim($(".condition").val()) == "" &&
                             !$.trim($(".fuel").val()) == "" &&
                             !$.trim($(".transmission").val()) == "" &&
                             !$.trim($(".vehicleprice").val()) == "" &&
                             !$.trim($(".location").val()) == "" &&
                             !$.trim($(".description").val()) == ""
                         ) {
                             $(".vehicleformoverlay").fadeIn();

                             $.ajax({
                                 url: url,
                                 method: "POST",
                                 data: new FormData(
                                     document.getElementById("editvehicleform")
                                 ),
                                 contentType: false,
                                 cache: false,
                                 processData: false,
                                 dataType: "json",

                                 success: function (data) {
                                     $(".vehicleformoverlay").fadeOut();
                                     var html = "";
                                     if (data.errors) {
                                         html =
                                             '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" \
                                        data-dismiss="alert">&times;</button><div class="alert-icon"><i class="icon-close"></i></div><div class="alert-message">\
                                        <span><strong>Errors!</strong></span><br>';
                                         for (
                                             var count = 0;
                                             count < data.errors.length;
                                             count++
                                         ) {
                                             html +=
                                                 "<span>" +
                                                 data.errors[count] +
                                                 "</span><br>";
                                         }
                                         html += "</div></div>";
                                     }
                                     if (data.warning) {
                                         html =
                                             '<div class="alert alert-warning">' +
                                             data.warning +
                                             "</div>";
                                     }
                                     if (data.success) {
                                         html =
                                             '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" \
                                        data-dismiss="alert">&times;</button><div class="alert-icon"><i class="icon-check"></i></div><div class="alert-message">\
                                        <span><strong>Success!</strong> ' +
                                             data.success +
                                             "</span></div></div>";
                                     }
                                     $("#form_result").html(html);
                                     setTimeout(function () {
                                         $("#form_result").html("");
                                     }, 3000);
                                 },
                             });
                         } else {
                             Lobibox.notify("warning", {
                                 pauseDelayOnHover: true,
                                 size: "mini",
                                 rounded: true,
                                 delayIndicator: false,
                                 icon: "fa fa-exclamation-circle",
                                 continueDelayOnInactiveTab: false,
                                 position: "top right",
                                 msg: "Please fill in the required fields",
                             });
                         }
                    }
                },
            });
            return $form_container;
        }),
        (FormWizard.prototype.init = function () {
          
            //vertical form
            this.createVertical($("#editwizard-vertical"));
        }),
        //init
        ($.FormWizard = new FormWizard()),
        ($.FormWizard.Constructor = FormWizard);
})(window.jQuery),
    //initializing
    (function ($) {
        "use strict";
        $.FormWizard.init();
    })(window.jQuery);
