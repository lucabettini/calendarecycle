@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 px-4 py-4 mt-5 shadow rounded">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if (session('status') === 'failed') 
                    <div class="p-3 mb-3 bg-red text-white bg-gradient rounded">
                        Login failed, bad email or password?
                    </div>
                @elseif (session('status') === 'password_changed')
                    <div class="p-3 mb-3 bg-cyan text-white bg-gradient rounded">
                        Please login again with new credentials
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <input type="email" class="form-control text-black @error('email') is-invalid @enderror" id="email" 
                      placeholder="E-mail" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                    @enderror 
                    <label for="email">E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control text-black @error('password') is-invalid @enderror" id="password" 
                      placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                    @enderror 
                    <label for="password">Password</label>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                          Remember me
                        </label>
                    </div>
    
                    <a href="{{route('forgotPassword')}}" class="text-black">Forgot Password?</a>    
                </div>

                

                <div class="d-grid"> 
                    <button class="btn btn-cyan text-black btn-lg mt-4 text-black" type="submit">LOGIN</button>
                </div>

            </form>
        </div>  
    </div>
</div>

@endsection