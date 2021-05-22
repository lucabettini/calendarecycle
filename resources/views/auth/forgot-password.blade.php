@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 px-4 py-4 mt-5 shadow rounded">
            <form method="POST" action="{{ route('forgotPassword') }}">
                @csrf

                @if(session('status') === 'success')
                    <div class="p-3 mb-3 bg-cyan text-white bg-gradient rounded">
                        Check your email!
                    </div>
                @else
                    @if (session('status') === 'failed') 
                    <div class="p-3 mb-3 bg-red text-white bg-gradient rounded">
                        Email not valid 
                    </div>
                    @endif
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control text-black" id="email" 
                          placeholder="E-mail" name="email">
                        <label for="email">E-mail</label>
                    </div>                

                    <div class="d-grid"> 
                        <button class="btn btn-cyan text-black btn-lg mt-4" type="submit">SEND EMAIL</button>
                    </div>
                
                @endif

                

            </form>
        </div>  
    </div>
</div>

@endsection