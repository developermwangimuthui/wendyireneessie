@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($products as $product)
 <form id="product_add" method="POST"  enctype="multipart/form-data">
    @csrf
 <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
       <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title">Category</label>
                            <select name="category_id" id="" class="form-control form-control-rounded">
                                <option value="{{$product->category->id}}">{{$product->category->category}}</option>
                                @foreach ($categories as $category)

                                <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="description">Product</label>
                            <input type="text" class="form-control form-control-rounded" name="product"
                                placeholder="Enter Product Name" value="{{$product->product}}">
                        </div>
                   
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="main_image">Product Slug</label>
  
                            <textarea name="slug" id="" cols="30" rows="10"
                                class="form-control form-control-rounded word_count" >
                                {{$product->slug}}
                                </textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="main_image">Description</label>
                            <textarea name="description" id="summernoteEditor" cols="30" rows="10"
                                class="form-control form-control-rounded">
                                {{$product->description}}
                                </textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="main_image">Main Product Image</label>
                            <input type="file" class="form-control form-control-rounded" id="main_image"
                                placeholder="Enter Service Main Name" name="main_image">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gallery">Additional Images</label>
                            <input type="file" class="form-control form-control-rounded" id="gallery"
                                placeholder="Enter Service Additional Images" name="gallery[]" multiple>
                        </div>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-primary btn-round px-5"><i
                                class="icon-checkbox3"></i> Save</button>
                    </div>
                </form>
@endforeach

    </div>
<div class="col-md-6">
        <p>Current Images</p>
        @if (!$photos->count() > 0)
        <p>No images Yet</p>
        @else
        <div class="list_image_gallery">
            @foreach ($photos as $photo)
            <div class="icon-remove blue delete" id="imgwrapper{{$photo->id}}">
                <img class="thumbnail"
                    src="{{url('/SosioFruits_Products').'/'.$photo->image_path }}"
                    alt="image" height="100" width="100" />
                <a href="#" onclick="deletepic({{$photo->id}})" class="photodelete"
                    id="{{$photo->id}}"><i
                        class="delete-button fa fa-trash"></i></a>
            </div>
            @endforeach
        </div>
        @endif

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

  $('#summernoteEditor').summernote({
            height: 400,
            tabsize: 2
        });
var product_id =$('#product_id').val();
    $("#product_add").on("submit", function (event) {
        event.preventDefault();
        console.log(product_id);
        $.ajax({
            url: '/product/update/'+product_id,
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

                $('#productmodal').modal('hide');
                $('#product_table').DataTable().ajax.reload();
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
url:'/photo/destroy',
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
        
    }

</script>
@endsection