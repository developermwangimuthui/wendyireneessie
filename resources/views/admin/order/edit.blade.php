@extends('admin.layout.main')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
 <div class="col-md-12">
          @foreach ($orders as $order)
              
    <div class="card">
     <div class="card-body">
     <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
         <li class="nav-item">
             <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
         </li>
    
         <li class="nav-item">
             <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Edit Order</span></a>
         </li>
     </ul>
     <div class="tab-content p-3">
         <div class="tab-pane active" id="profile">
             <h5 class="mb-3">{{$order->user->first_name.''.$order->user->surname}}</h5>
             <div class="row">
                 <div class="col-md-6">
                     <h6>Email</h6>
                     <p>
                         {{$order->user->email}}
                     </p>
                     <h6>Phone</h6>
                     <p>
                         {{$order->user->phone}}
                     </p>
                 </div>
                
                 <div class="col-md-12">
                     <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Order Details</h5>
                     <table class="table table-hover table-striped">
                         <tbody>  

                            @foreach($services as $index => $service)
                            @if($order->order_services()->pluck('title')->contains($service->title))                                  
                             <tr>
                                 <td>
                                     {{$service->title}}
                                 </td>
                             </tr>
                             @endif
                             @endforeach
                          
                         </tbody>
                     </table>
                 </div>
             </div>
             <!--/row-->
         </div>
       
         <div class="tab-pane" id="edit">
         <form method="GET" action="{{route('order.update',$order->id)}}">
            @csrf
                 <div class="form-group row">
                     <label class="col-lg-3 col-form-label form-control-label">Transport Cost</label>
                     <div class="col-lg-9">
                     <input class="form-control" type="number" value="{{$order->transport_cost}}" name="transport_cost">
                     </div>
                 </div>
                 
                 <div class="form-group row">
                     <label class="col-lg-3 col-form-label form-control-label"></label>
                     <div class="col-lg-9">
                         <input type="reset" class="btn btn-secondary" value="Cancel">
                         <input type="submit" class="btn btn-primary" value="Update Changes">
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
</div>    

@endforeach
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