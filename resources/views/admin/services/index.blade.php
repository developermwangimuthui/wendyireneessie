@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Services
                        <a href="#" class="btn btn-info btn-round waves-effect waves-light m-1" data-toggle="modal"
                        data-target="#servicemodal">Add Service</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="service_table" class="table table-bordered ">
                                <thead>
                               
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                
                                </thead>
                                 <tbody>
                                    
                                </tbody> 
                                <tfoot>
                                
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Status</th>
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
<div class="modal fade servicemodal" id="servicemodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-star"></i> Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="service_add" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label for="title">Service Name</label>
                        <input type="text" class="form-control form-control-rounded" id="title"
                            placeholder="Enter Service Name" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control form-control-rounded">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control form-control-rounded" id="price"
                            placeholder="Enter service Price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="main_image">Main Sevirce Image</label>
                        <input type="file" class="form-control form-control-rounded" id="main_image"
                            placeholder="Enter Service Main Name" name="main_image">
                    </div>
                    <div class="form-group">
                        <label for="gallery">Additional Images</label>
                        <input type="file" class="form-control form-control-rounded" id="gallery"
                            placeholder="Enter Service Additional Images" name="gallery[]">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control form-control-rounded">
                            <option value="">Select a status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>

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

        var table = $('#service_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('service.index')}}",
        columns:[
        {data: 'title', name: 'title'},
        {data: 'description', name: 'description'},
        {data: 'price', name: 'price'},
        {data: 'status', name: 'status', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs:[
       
        ]

        });






    // ...................................
    function serviceactivate(service_id) {
       var status = "1";
       $.ajax({
           url:'/service/change/status',
           method:'PUT',
           data:{
               status:status,
               service_id:service_id,
                 _token: "{{ csrf_token() }}",
           },
           success:function(){
               console.log('make status updated');
             $('#service_table').DataTable().ajax.reload();
           }

       });
    
       
   }
     function servicedeactivate(service_id) {
         
       var status = "0";
       $.ajax({
           url:'/service/change/status',
           method:'PUT',
           data:{
               status:status,
               service_id:service_id,
                 _token: "{{ csrf_token() }}",
           },
           success:function(){
               console.log('make status updated');
             $('#service_table').DataTable().ajax.reload();
           }

       });
       
   }

   function servicedelete(service_id) {
       console.log(service_id);
    $.ajax({
           url:'/service/destroy/',
           method:'delete',
           data:{
               service_id:service_id,
                 _token: "{{ csrf_token() }}",
           },
           success:function(){
               console.log('Deleted ');
             $('#service_table').DataTable().ajax.reload();
           }

       });
    }



    $("#service_add").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/service/store",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

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
                        msg: data.success,
                     });

                     console.log(data.success);
                }
                $('#servicemodal').modal('hide');
                $('#service_table').DataTable().ajax.reload();
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
    });
   
</script>


@endsection