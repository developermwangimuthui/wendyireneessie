@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div id="wrapper">
    <div class="height-100v d-flex align-items-center justify-content-center">
       <div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-4 animated bounceInDown">
           <div class="card-body">
            <div class="card-content p-2">
                <div class="text-center">
                    <img src="/backend/assets/images/logo-icon.png">
                </div>
             <div class="card-title text-uppercase text-center py-3">Sign Up</div>
             <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                 <div class="form-group">
                  <div class="position-relative has-icon-right">
                     <label for="exampleInputName" class="sr-only">First Name</label>
                     <input id="name" type="text" class="form-control form-control-rounded @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('name') }}" required autocomplete="first_name" autofocus placeholder="First Name">

                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <div class="form-control-position">
                         <i class="icon-user"></i>
                     </div>
                  </div>
                 </div>
                 <div class="form-group">
                  <div class="position-relative has-icon-right">
                     <label for="exampleInputName" class="sr-only">Last Name</label>
                     <input id="name" type="text" class="form-control form-control-rounded @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Last Name">

                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <div class="form-control-position">
                         <i class="icon-user"></i>
                     </div>
                  </div>
                 </div>
                 <div class="form-group">
                  <div class="position-relative has-icon-right">
                     <label for="exampleInputEmailId" class="sr-only">Email ID</label>
                     <input id="email" type="email" class="form-control form-control-rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <div class="form-control-position">
                         <i class="icon-envelope-open"></i>
                     </div>
                  </div>
                 </div>
                 <div class="form-group">
                  <div class="position-relative has-icon-right">
                     <label for="exampleInputPassword" class="sr-only">Password</label>
                     <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="Password">

                     @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <div class="form-control-position">
                         <i class="icon-lock"></i>
                     </div>
                  </div>
                 </div>
                 <div class="form-group">
                  <div class="position-relative has-icon-right">
                     <label for="exampleInputRetryPassword" class="sr-only">Retry Password</label>
                   
                     <input id="password-confirm" type="password" class="form-control form-control-rounded" name="password_confirmation" required autocomplete="new-password" placeholder="Retry Password"/>
                     <div class="form-control-position">
                         <i class="icon-lock"></i>
                     </div>
                  </div>
                 </div>
                <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Sign Up</button>
                 <div class="text-center pt-3">
                   <p>or Sign up with</p>
                   <a href="javascript:void()" class="btn-social btn-social-circle btn-facebook waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>
                   <a href="javascript:void()" class="btn-social btn-social-circle btn-google-plus waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>
                   <a href="javascript:void()" class="btn-social btn-social-circle btn-twitter waves-effect waves-light m-1"><i class="fa fa-twitter"></i></a>
                   <hr>
                   <p class="text-muted mb-0">Already have an account? <a href="{{route('login')}}"> Sign In here</a></p>
                 </div>
                </form>
              </div>
             </div>
            </div>
            </div>
       
        <!--Start Back To Top Button-->
       <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
       <!--End Back To Top Button-->
       </div><!--wrapper-->
       
     <!-- Bootstrap core JavaScript-->
     <script src="/backend/assets/js/jquery.min.js"></script>
     <script src="/backend/assets/js/popper.min.js"></script>
     <script src="/backend/assets/js/bootstrap.min.js"></script>
     
@endsection
