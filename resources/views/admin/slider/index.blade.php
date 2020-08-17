@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Sliders
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                            data-target="#slider_modal">Add Slider</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="slider_table" class="table table-bordered ">
                                <thead>

                                    <th>Slider</th>
                                    <th>Title</th>
                                    <th>description</th>
                                    <th>Action</th>

                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th>Slider</th>
                                    <th>Title</th>
                                    <th>description</th>
                                    <th>Action</th>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->
    </div>
</div>



<!-- Modal -->
<div class="modal fade slider_modal" id="slider_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Add Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="overlay" style="display:none;" class="slideroverlay">
                    <div class="spinner"></div>
                    <br />
                    Loading...
                </div>
                <span id="form_result"></span>
                <form method="POST" id="slider_add" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" id="description" class="form-control form-control-rounded" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="3"
                            class="form-control form-control-rounded">

                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="main_image">Featured Image</label>
                        <input type="file" class="form-control form-control-rounded" id="main_image"
                            placeholder="choose slider image" name="main_image" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                                class="icon-checkbox3"></i> Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Large Size Modal -->

<script>

    var table = $('#slider_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('slider.index')}}",
            columns:[
                {data:'image_path',name:'image_path',
                      render: function(data, type, full, meta){
                      return "<img src={{ URL::to('') }}/SliderImages/"+data+ " width='70' class='img-thumbnail' />" ; },orderable: false}, 
            {data: 'title', name: 'title'},
            {data: 'subtitle', name: 'subtitle'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs:[
            {targets:1, render:function(data){
            var trimmedString = data.substring(0, 50);
                return trimmedString + '...';
                }
            }
            ]

        });

    function sliderdelete(slider_id) {
        console.log(slider_id);
        $.ajax({
            url:'/slider/destroy/',
            method:'delete',
            data:{
                slider_id:slider_id,
                    _token: "{{ csrf_token() }}",
            },
            success: function (data) {

                    var html = "";
                    if (data.errors) {
                        Lobibox.notify("error", {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: "top right",
                            icon: "fa fa-times-circle",
                            msg: data.success,
                        });
                    }
                    if (data.warning) {
                        html =
                            '<div class="alert alert-warning">' +
                            data.warning +
                            "</div>";
                    }
                    if (data.success) {
                        Lobibox.notify("success", {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: "top right",
                            icon: "fa fa-check-circle", //path to image
                            msg: data.message,
                        });

                        console.log(data.success);
                    }
                    $('#slider_modal').modal('hide');
                    $('#slider_table').DataTable().ajax.reload();
                }

            });
        }



    $("#slider_add").on("submit", function (event) {
        event.preventDefault();
        $(".slideroverlay").fadeIn();
        $.ajax({
            url: "{{route('slider.store')}}",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success: function (data) {
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
                     $('#slider_add')[0].reset();
                     $('#slider_table').DataTable().ajax.reload();
                     $('#slider_modal').modal('hide');
                }
                    $("#form_result").html(html);
                    setTimeout(function () {
                        $("#form_result").html("");
                    }, 3000);

            },
            error:function (data) {
                 $(".slideroverlay").fadeOut();
                Lobibox.notify("error", {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    icon: "fa fa-times-circle",
                    msg: "Something went wrong",
                });

            },
        });
    });


</script>


@endsection
