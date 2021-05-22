@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <i class="fas fa-trash text-cyan main-icon"></i>
            </div> 
            <div class="col-12 d-flex flex-column justify-content-center">
                <div class="text-center">
                    <h3 class="text-cyan pt-5 font-carter">
                        Never forget again<br> to take out the trash! 
                    <br>
                    <i class="fas fa-recycle"></i><i class="fas fa-recycle px-3"></i><i class="fas fa-recycle"></i></h3>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-8 col-lg-6 text-center">
                        <p class="pt-3">Calendarecycle provides a simple way to remember when you must take out your bins... and it's completely free</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="{{route('register') }}" class="btn btn-lg btn-cyan text-light-yellow shadow">TRY IT NOW</a>
                    </div>
                </div>
            </div>
        </div>
        

        
    </div>
    


@endsection