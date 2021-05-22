@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 px-4 py-4 mt-5 shadow rounded">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                @if (session('status') === 'failed') 
                    <div class="p-3 mb-3 bg-red text-white bg-gradient rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="token" id="token" value="{{ $token }}">

                <div class="form-floating mb-3">
                    <input type="email" class="form-control text-black id="email" 
                      placeholder="E-mail" name="email">
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

                <div class="form-floating mb-3">
                    <input type="password" class="form-control text-black id="password_confirmation" 
                      placeholder="Confirm password" name="password_confirmation">
                    <label for="password_confirmation">Confirm password</label>
                </div>

                <div class="d-grid"> 
                    <button class="btn btn-cyan text-black btn-lg mt-4" type="submit">RESET PASSWORD</button>
                </div>

            </form>
        </div>  
    </div>
</div>

@endsection