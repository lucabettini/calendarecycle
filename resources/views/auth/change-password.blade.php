@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 px-4 py-4 mt-5 shadow rounded">
            <form method="POST" action="{{ route('changePassword') }}">
                @csrf

                @if (session('status') === 'success') 
                    <div class="p-3 mb-3 bg-cyan text-white bg-gradient rounded">
                        Password changed!
                    </div>
                @else                
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control text-black @error('old_password') is-invalid @enderror" id="old_password" 
                        placeholder="Old password" name="old_password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                        @enderror 
                        <label for="old_password">Old password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control text-black @error('password') is-invalid @enderror" id="password" 
                        placeholder="New password" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                        @enderror 
                        <label for="password">New password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control text-black id="password_confirmation" 
                        placeholder="Confirm password" name="password_confirmation">
                        <label for="password_confirmation">Confirm password</label>
                    </div>

                    <div class="d-grid"> 
                        <button class="btn btn-cyan text-black btn-lg mt-4" type="submit">CHANGE PASSWORD</button>
                    </div>

                @endif
            </form>
        </div>  
    </div>
</div>

@endsection

