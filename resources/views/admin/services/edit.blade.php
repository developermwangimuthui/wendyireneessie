@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-6">
@foreach ($services as $service)
 <form id="service_add" method="GET" enctype="multipart/form-data" action="{{route('service.update',$service->id)}}" >
    @csrf
    <div class="form-group">
        <label for="title">Service Name</label>
        <input type="text" class="form-control form-control-rounded" id="title"
    placeholder="Enter Service Name" name="title" value="{{$service->title}}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control form-control-rounded" placeholder="">
        {{$service->description}}
        </textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control form-control-rounded" id="price"
    placeholder="Enter service Price" name="price" value="{{$service->price}}">
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
        <option value="{{$service->status}}">Select a status</option>
            <option value="1">Active</option>
            <option value="0">Deactive</option>
        </select>

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
                    src="{{url('/ServiceImages').'/'.$photo->image_path }}"
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

function deletepic(photo_id) {
        $.ajax({
url:'/photo/destroy',
method:'Delete',
data:{
    photo_id:photo_id,
    _token: "{{ csrf_token() }}",
},
success:function(){
location.reload();
},
error:function(){
    console.log('error');

}
        });
        
    }
</script>
@endsection