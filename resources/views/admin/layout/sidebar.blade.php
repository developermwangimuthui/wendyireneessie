<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="{{route('home')}}">
      <img src="/backend/assets/images/logo.png" class="logo-icon" alt="logo icon">
      <h5 class="logo-text">Kenya Sihami </h5>
    </a>
  </div>
  <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
    {{-- @can('view-dashboard') --}}
    <li class="{{ Route::currentRouteNamed('home') ? 'active ' : '' }}">
      <a href="{{route('home')}}" class="waves-effect">
        <i class="ti-home"></i> <span>Dashboard</span>
      </a>

    </li>
  <li class="{{ Route::currentRouteNamed('memes.index') ? 'active ' : '' }}">
    <a href="{{route('memes.index')}}" class="waves-effect">
        <i class="ti-shopping-cart"></i>
        <span>Meme Management</span>
      </a>

    </li>

    <li class="{{ Route::currentRouteNamed('reportedMemes') ? 'active ' : '' }}">
      <a href="{{route('reportedMemes')}}" class="waves-effect">
          <i class="ti-shopping-cart"></i>
          <span>Reported Memes</span>
        </a>

      </li>
    <li class="{{ Route::currentRouteNamed('reportedUsers') ? 'active ' : '' }}">
      <a href="{{route('reportedUsers')}}" class="waves-effect">
          <i class="ti-shopping-cart"></i>
          <span>Reported Users</span>
        </a>

      </li>
    {{-- <li class="{{ Route::currentRouteNamed('slider.index') ? 'active ' : '' }}">
      <a href="{{route('slider.index')}}" class="waves-effect">
          <i class="ti-shopping-cart"></i>
          <span>Slider Management</span>
        </a>

      </li> --}}

      <li class="{{ Route::currentRouteNamed('users.index') ? 'active ' : '' }}">
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-user"></i>
          <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          {{-- @can('manage-users') --}}

          <li class="{{ Route::currentRouteNamed('users.index') ? 'active ' : '' }}"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i>User Management</a></li>
          {{-- @endcan --}}

          {{-- @can('manage-roles') --}}

          <li class="{{ Route::currentRouteNamed('roles.index') ? 'active ' : '' }}"><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>Role Management</a></li>
          {{-- @endcan --}}

        </ul>
      </li>
      <li class="{{ Route::currentRouteNamed('adminPayment') ? 'active ' : '' }}">
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-user"></i>
          <span>Finance Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          {{-- @can('manage-users') --}}

          <li class="{{ Route::currentRouteNamed('adminPayment') ? 'active ' : '' }}"><a href="{{route('adminPayment')}}"><i class="fa fa-circle-o"></i>All  Payment Requests</a></li>
          <li class="{{ Route::currentRouteNamed('pending.payment') ? 'active ' : '' }}"><a href="{{route('pending.payment')}}"><i class="fa fa-circle-o"></i>Pending Payment</a></li>
          {{-- @endcan --}}

          {{-- @can('manage-roles') --}}

          <li class="{{ Route::currentRouteNamed('complete.payment') ? 'active ' : '' }}"><a href="{{route('complete.payment')}}"><i class="fa fa-circle-o"></i>Completed Payment</a></li>
          {{-- @endcan --}}

        </ul>
      </li>




  </ul>

</div>
