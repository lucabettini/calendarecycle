@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

          <div class="shadow my-5 py-3 px-3 rounded">
            <form method="POST" action="{{ route('addBin') }}">
              @csrf
  
              <div class="row mb-3">
                <div class="col-6 d-flex align-items-center">
                  <label for="name">Name</label>
                </div>
                <div class="col-6">
                  <input type="text" class="form-control text-black text-black @error('name') is-invalid @enderror" id="name" name="name"
                  placeholder="plastics" value="{{ old('name') }}">
                 @error('name')
                   <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                 @enderror 
                </div>  
              </div>

              <div class="row mb-3">
                <div class="col-6 d-flex align-items-center">
                  <label for="color">Color:</label>
                </div>
                <div class="col-6">
                  <select class="form-select @error('color') is-invalid @enderror" id="color" name="color">
                    @php
                      $colors = ['blue', 'red', 'yellow', 'orange', 'violet', 'green', 'brown', 'gray'];
                    @endphp
                    @foreach ($colors as $color) 
                      <option value="{{$color}}" @if ($color === old('color')) selected @endif > {{ ucfirst($color) }} </option>
                    @endforeach
                  </select>
                  @error('color')
                   <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                 @enderror 
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-6 d-flex align-items-center">
                  <label for="day">Day of the week:</label>
                </div>
                <div class="col-6">
                  <select class="form-select @error('day') is-invalid @enderror" id="day" name="day">
                    @php
                      $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    @endphp
                    @foreach ($days as $key=>$day) 
                      <option value="{{$key + 1}}" @if ($key + 1 == old('day')) selected @endif>{{ ucfirst($day) }}</option>
                    @endforeach
                  </select>
                  @error('day')
                   <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                 @enderror 
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-6 d-flex align-items-center">
                  <label for="start_at">Start at:</label>
                </div>
                <div class="col-6">
                  <select class="form-select @error('start_at') is-invalid @enderror" id="start_at" name="start_at">
                    <option selected>Choose an hour</option>
                    @for ($i = 1; $i < 25; $i++)
                      @if ($i < 10 )
                        <option value="{{$i}}" @if ($i == old('start_at')) selected @endif>0{{$i}}:00</option>                   
                      @else
                        <option value="{{$i}}" @if ($i == old('start_at')) selected @endif>{{$i}}:00</option>
                      @endif
                    @endfor
                  </select>
                  @error('start_at')
                   <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                 @enderror 
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-6 d-flex align-items-center">
                  <label for="end_at">End at:</label>
                </div>
                <div class="col-6">
                  <select class="form-select @error('end_at') is-invalid @enderror" id="end_at" name="end_at">
                    <option selected>Choose an hour</option>
                    @for ($i = 1; $i < 25; $i++)
                      @if ($i < 10 )
                        <option value="{{$i}}" @if ($i == old('end_at')) selected @endif>0{{$i}}:00</option>                   
                      @else
                        <option value="{{$i}}" @if ($i == old('end_at')) selected @endif>{{$i}}:00</option>
                      @endif
                    @endfor
                  </select>
                  @error('start_at')
                   <span class="invalid-feedback" role="alert" aria-live="assertive">{{ $message }}</span>
                 @enderror 
                </div>
              </div>
 
              <div class="d-flex justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-gray text-light-yellow mx-2">Cancel</a>
                <button type="submit" class="btn btn-cyan text-black mx-2">Confirm</button>
              </div>
                      
          </form>
          </div>
          
        </div>
    </div>
  
@endsection