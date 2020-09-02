@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Memes
                       
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportedUsers_table" class="table table-bordered ">
                                <thead>
                               
                                    <th>Action</th>
                                    <th>Memelord</th>
                                    <th>Email</th>
                                
                                </thead>
                                 <tbody>
                                    
                                </tbody> 
                                <tfoot>
                                    <th>Action</th>
                                    <th>Memelord</th>
                                    <th>Email</th>
                                 
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
<!-- Modal -->


<!-- Large Size Modal -->

<div class="modal fade" id="viewmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h2 class="modal-title">External Link Content</h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <iframe id="link_view" src=""
                style="width:100%; height:350px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse-warning" data-dismiss="modal" onclick="closeAudio()"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $(".word_count").on('keyup', function() {
        console.log('me');
        var words = this.value.match(/\S+/g).length;
        if (words > 40) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 200).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left').text(40-words);
        }
    });
 }); 


        var table = $('#reportedUsers_table').DataTable({
        processing: true,
        serverSide: true,    
        ajax: "{{ route('reportedUsers')}}",
        columns:[

        {data: 'action', name: 'action', orderable: false, searchable: false},

        {data: 'firstname', name: 'firstname',render: function ( data, type, row ) {
            // Combine the first and last names into a single table field
            var name = '';


            if (data !=null) {
                name = data +'    '+row['lastname'];                 
            } else if (row['username'] !=null) {
                
            name = row['username']  
            }else{
                name = row['id']
            }
            return name;
         }},
       
        
        
        {data: 'email', name: 'user.email'},
               ],
        columnDefs:[
       
        ]

        });

        function closeAudio() {
        $('#link_view').attr('src', '');

        
             }
//   $('#summernoteEditor').summernote({
//             height: 400,
//             tabsize: 2
//         });



   function memedelete(user_id) {
    if (confirm("Do you want to delete this MemeLord!")) {

       console.log(user_id);
    $.ajax({
           url:'/user/destroy/',
           method:'delete',
           data:{
               user_id:user_id,
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

                }
                $('#reportedUsers_table').DataTable().ajax.reload();
            },
            

       });}else{
        txt = "You pressed Cancel!";

       }
    }



    // $("#product_add").on("submit", function (event) {
    //     event.preventDefault();

    //     $(".imguploadoverlay").fadeIn();
    //     $.ajax({
    //         url: '/product/store/',
    //         method: "POST",
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: "json",

    //         success:function(data){

    //             // $(".imguploadoverlay").fadeOut();
    //            if (data.errors) {
    //                 Lobibox.notify("error", {
    //                     pauseDelayOnHover: true,
    //                     continueDelayOnInactiveTab: false,
    //                     position: "top right",
    //                     icon: "fa fa-times-circle",
    //                     msg: data.message,
    //                 });
    //             }
    //             if (data.success) {
    //                 Lobibox.notify("success", {
    //                     pauseDelayOnHover: true,
    //                     continueDelayOnInactiveTab: false,
    //                     position: "top right",
    //                     icon: "fa fa-check-circle", //path to image
    //                     msg: data.message,
    //                  });

    //             }

    //             $('#productmodal').modal('hide');
    //             $('#reportedUsers_table').DataTable().ajax.reload();
    //         },
    //         error:function (data) {
    //         Lobibox.notify("error", {
    //             pauseDelayOnHover: true,
    //             continueDelayOnInactiveTab: false,
    //             position: "top right",
    //             icon: "fa fa-times-circle",
    //             msg: "Something went wrong",
    //         });

    //         },
    //     });
    // });
   
    $(function () {

$(document).on('click', '.view', function(){

          var id = $(this).attr('id');
          console.log(id);
          $('#form_result').html('');
          $.ajax({
           url:"/meme-show/"+id,
           dataType:"json",
           success:function(html){
            console.log(html);
            if (html.type=='image') {                
            $('#link_view').attr('src', '/Postimages/'+ html.data);
            } else {
            $('#link_view').attr('src', '/Postvideos/'+ html.data);                
            }

            $('.modal-title').text("Preview");
            $('#viewmodal').modal({backdrop: 'static', keyboard: false}) 
            $('#viewmodal').modal('show');
           }
          })
         });
});
   
</script>


@endsection
