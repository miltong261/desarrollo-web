@extends('auth.contenido')

@section('login')
<div class="limiter">
        <div class="container-login100" style="background-image: url('Login_v3/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-logo">
                        <img class="login100-form-logo" src="Login_v3/images/Hotel.jpg" alt="">
                    </span>
    
                    <span class="login100-form-title p-b-34 p-t-27">
                        
                    </span>
    
                    <div class="wrap-input100 validate-input" data-validate="Ingrese correo">
                        <input placeholder="Ingresa guest@gmail.com"  id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="wrap-input100 validate-input" data-validate="Ingrese contraseña">
                        <input placeholder="Contraseña: guest" id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Acceder &nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i>
                        </button>
                    </div>
    
                    <div class="text-center p-t-90">
                        <a class="txt1" href="#">
                            
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

