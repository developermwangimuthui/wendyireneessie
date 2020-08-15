@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <span id="form_result"></span>
            </div>
            <div id="overlay" style="display:none;" class="slideroverlay">
                <div class="spinner"></div>
                <br />
                Loading...
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-uppercase">
                        Update Slider
                    </div>
                    <div class="card-body">
                        @foreach ($sliders as $slider)
                        <form id="slider_add" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="slider_id" value="{{$slider->id}}" id="slider_id">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" id="description" class="form-control form-control-rounded"
                                    value=" {{$slider->title}}" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="3"
                                    class="form-control form-control-rounded">{{$slider->subtitle}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="main_image">Slider Image</label>
                                <input type="file" class="form-control form-control-rounded" id="main_image"
                                    placeholder="Enter Slider Image" name="main_image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                                        class="icon-checkbox3"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-uppercase">
                        Current Slider Image
                    </div>
                    <div class="card-body">
                        <div class="list_image_gallery">
                            <div class="icon-remove blue delete" id="imgwrapper{{$slider->id}}">
                                <img class="thumbnail" src="{{url('/SliderImages').'/'.$slider->image_path }}"
                                    alt="image" height="300" width="300" />

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var slider_id =$('#slider_id').val();
         $("#slider_add").on("submit", function (event) {
        event.preventDefault();
        $(".slideroverlay").fadeIn();
        $.ajax({
            url: '/slider/update/'+slider_id,
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success:function(data){
                $(".slideroverlay").fadeOut();
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
                        Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.warning,
                    });
                }
                if (data.success) {
                    html =
                        '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" \
                    data-dismiss="alert">&times;</button><div class="alert-icon"><i class="icon-check"></i></div><div class="alert-message">\
                    <span><strong>Success!</strong> ' +
                        data.success +
                        "</span></div></div>";
                        Lobibox.notify("success", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.success,
                    });
                }
                $("#form_result").html(html);
                setTimeout(function () {
                    $("#form_result").html("");
                }, 3000);

                window.location.reload();

            },
           
         });
    });

</script>
@endsection
