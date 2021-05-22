@extends('layouts.app')

@section('content')
    <div class="container">
        
        @if (count($bins) === 0)
            <div class="row mt-5 font-noto" >
                <h2 class="text-center">
                    There is nothing here yet...
                </h2>
            </div>
        @endif

        {{-- BUTTONS --}}

        <div class="row mt-5 mb-5 d-flex justify-content-center">   
            <div class="col-8 col-md-6 d-grid">
                <a href="{{ route('addBin') }}" class="btn btn-cyan text-black btn-lg text-black font-noto-md"><i class="fas fa-plus" ></i> ADD A NEW BIN</a>
            </div>                           
        </div>

        <div class="row mb-5">   
            <div class="col-4 d-grid">
                <a href="{{ route('home') }}" class="btn btn-outline-cyan btn-sm text-black
                @if (Route::current()->getName() === 'home') btn-cyan text-black @endif">Today</a>
            </div> 
            <div class="col-4 d-grid">
                <a href="{{ route('tomorrow') }}" class="btn btn-outline-cyan btn-sm text-black
                @if (Route::current()->getName() === 'tomorrow') btn-cyan text-black @endif">Tomorrow</a>
            </div>  
            <div class="col-4 d-grid">
                <a href="{{ route('week') }}" class="btn btn-outline-cyan btn-sm text-black
                @if (Route::current()->getName() === 'week') btn-cyan text-black @endif">All week</a>
            </div>                            
        </div>     

        {{-- BINS --}}

        <div class="row mt-5">
            @foreach($bins as $bin)                               
                <div class="col-12 col-md-6 col-lg-4 bin-hover">
                    <div class="container mb-4 py-4 text-black rounded shadow ">
                        <a href="{{ route('editBin', $bin) }}" style="text-decoration: none;">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <i class="fas fa-trash text-{{$bin->color}}" style="font-size: 7rem" ></i>
                                </div>
                                <div class="col-12 mt-3 d-flex flex-column">
                                    <h5 class="font-carter text-{{$bin->color}} mx-auto text-uppercase">
                                        {{ $bin->name }}
                                    </h5>
                                    @if (Route::current()->getName() === 'week')
                                        @php $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']; @endphp
                                        <p class="mx-auto text-black">
                                            {{ ucfirst($days[$bin->day - 1]) }}
                                        </p>
                                    @else 
                                        <p class="mx-auto text-black">                                   
                                            h. {{ $bin->start_at}}.00 - {{$bin->end_at}}.00
                                        </p>                                    
                                    @endif                                    
                                </div>
                            </div>
                        </a>
                                  
                    </div>
                </div>
                    
               
                    
            @endforeach
        </div>       
    </div>

@endsection 
