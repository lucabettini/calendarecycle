@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <h1 class="text-center font-carter">{{auth()->user()->name}}</h1>
        </div>
        <div class="row mt-5">
            <h5>{{count(auth()->user()->bins)}} active bins</h5>
            <h5>Subscribed {{auth()->user()->created_at->diffForHumans()}}</h5>
        </div>
        <div class="row mt-5">
            <div class="col d-flex justify-content-around">             
                <a href="{{ route('editAccount') }}" class="btn btn-green text-light-yellow mx-2">Edit profile</a>
                <a href="{{ route('changePassword') }}" class="btn btn-cyan text-black text-light-yellow mx-2">Change password</a>
                <form action="{{ route('editAccount') }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-red text-light-yellow mx-2" type="submit">Delete Account</button>
                    </form>
            </div>            
        </div>
    </div>
@endsection 