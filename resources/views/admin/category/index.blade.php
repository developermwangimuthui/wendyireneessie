@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Categories
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                        data-target="#categorymodal">Add Category</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category_table" class="table table-bordered ">
                                <thead>
                               
                                        <th>Category Name</th>
                                        <th>Action</th>
                                
                                </thead>
                                 <tbody>
                                    
                                </tbody> 
                                <tfoot>
                                
                                      
                                    <th>Category Name</th>
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
<div class="modal fade servicemodal" id="categorymodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-star"></i> Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="overlay" style="display:none;" class="imguploadoverlay">
                    <div class="spinner"></div>
                    <br />
                    Saving...
                </div>
                <form id="category_add" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="title">Category Name</label>
                        <input type="text" class="form-control form-control-rounded" id="title"
                            placeholder="Enter Category Name" name="category">
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

        var table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('category.index')}}",
        columns:[
        {data: 'category', name: 'category'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs:[
       
        ]

        });

   function categorydelete(category_id) {
       console.log(category_id);
    $.ajax({
           url:'/category/destroy/',
           method:'delete',
           data:{
               category_id:category_id,
                 _token: "{{ csrf_token() }}",
           },
           success:function(data){
               if (data.errors) {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.message,
                    });
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
             $('#category_table').DataTable().ajax.reload();
           }

       });
    }



    $("#category_add").on("submit", function (event) {
        event.preventDefault();
        // console.log('aye');

        $(".imguploadoverlay").fadeIn();
        $.ajax({
            url: "/category/store",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

        $(".imguploadoverlay").fadeOut();
                console.log(data);
           if (data.errors) {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-times-circle",
                        msg: data.message,
                    });
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
                $('#categorymodal').modal('hide');
                $('#category_table').DataTable().ajax.reload();
            },
            error: function () {
            Lobibox.notify("error", {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: "top right",
                icon: "fa fa-times-circle",
                msg: "Something went wrong",
            });
            console.log("error");
                                },
        });
    });
   
</script>


@endsection