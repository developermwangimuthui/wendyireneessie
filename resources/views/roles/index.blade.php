@extends('admin.layout.main')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Role Management</h3>

                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif


                        <div class="panel panel-default">
                            <div class="row">
                                {{-- @can('role-create') --}}
                                <a class="btn btn-info" href="{{ route('roles.create') }}"
                                    style="margin-left: 20px !important;">Add Role</a>
                                {{-- @endcan --}}
                            </div>
                            <br><br>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        @if ($role->name == 'Producer')
                                        <td><label class="badge badge-warning">{{ $role->name }}</label></td>
                                        @elseif($role->name == 'Artist')
                                        <td><label class="badge badge-success">{{ $role->name }}</label></td>
                                        @elseif( $role->name == 'Normal User')
                                        <td><label class="badge badge-info">{{ $role->name }}</label></td>
                                        @elseif($role->name == 'Super-Admin')
                                        <td><label class="badge badge-danger">{{ $role->name }}</label></td>
                                        @else
                                        <td><label class="badge badge-pill badge-dark m-1">{{ $role->name }}</label></td>
                                        @endif
                                        
                                        <td>
                                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                            {{-- @can('role-edit') --}}
                                            <a class="btn btn-primary"
                                                href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                            {{-- @endcan --}}
                                            @if ($role->name != "Super-Admin" && $role->name != "Normal-User")

                                            @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                                            $role->id],'style'=>'display:inline','onsubmit' => 'return confirm("Are you sure you want to delete this Role?");']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>


                                {!! $roles->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection