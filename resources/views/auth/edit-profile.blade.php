@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 px-4 py-4 mt-5 shadow rounded">
            <form method="POST" action="{{ route('editAccount') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control text-black @error('name') is-invalid @enderror" id="name" 
                      placeholder="Username" name="name" value="{{ auth()->user()->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                    @enderror 
                    <label for="name">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control text-black @error('email') is-invalid @enderror" id="email" 
                      placeholder="E-mail" name="email" value="{{ auth()->user()->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                    @enderror 
                    <label for="email">E-mail</label>
                </div>

                <div class="d-grid"> 
                    <button class="btn btn-cyan text-black btn-lg mt-4" type="submit">EDIT PROFILE</button>
                  </div>
            </form>
        </div>  
    </div>
</div>

@endsection
