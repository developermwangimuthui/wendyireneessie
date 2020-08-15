@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($seos as $seo)
 <form id="seo_add" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
        <label for="title">Product</label>
        <select name="product_id" id="" class="form-control form-control-rounded">
            <option value="{{$seo->product->id}}">{{$seo->product->product}}</option>
            @foreach ($products as $product)
                
        <option value="{{$product->id}}">{{$product->product}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description">Meta Description</label>
        <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control form-control-rounded">
{{$seo->meta_description}}
        </textarea>
    </div>
    <div class="form-group">
        <label for="description">Meta Keywords</label>
        <textarea name="meta_keyword" id="meta_keywords" cols="30" rows="10" class="form-control form-control-rounded">
{{$seo->meta_keyword}}
        </textarea>
    </div>
    
                  


    <div class="form-group">
        <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                class="icon-checkbox3"></i> Save</button>
    </div>
</form>
@endforeach

    </div>

</div>
</div>
<script>



var seo_id =$('#seo_id').val();
    $("#seo_add").on("submit", function (event) {
        event.preventDefault();
        console.log(seo_id);
        $.ajax({
            url: '/seo/update/'+seo_id,
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

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
            },
            error:function (data) {
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





function deletepic(photo_id) {
        $.ajax({
url:'/service/photo/destroy',
method:'Delete',
data:{
    photo_id:photo_id,
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
location.reload();
},
error:function(){
    console.log('error');

}
        });
        
    }
</script>
@endsection