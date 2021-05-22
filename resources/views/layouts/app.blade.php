<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Calendarecycle</title>
</head>
<body>
         <nav class="navbar navbar-expand-md navbar-light bg-cyan shadow">
            <div class="container-fluid px-4">
              <a class="navbar-brand font-carter text-black" href="/">CALENDARECYCLE</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">
                    @auth                     
                    <a href="{{route('about')}}" class="nav-link text-black"><i class="fas fa-question-circle"></i> ABOUT</a>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-black font-noto-md" href="#" id="binsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-trash"></i> BINS 
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="binsDropdown">
                        <li><a class="dropdown-item text-black" href="{{route('home')}}">Today</a></li>
                        <li><a class="dropdown-item text-black" href="{{route('tomorrow')}}">Tomorrow</a></li>
                        <li><a class="dropdown-item text-black" href="{{route('week')}}">This Week</a></li>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-black font-noto-md text-uppercase" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item text-black px-2" href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> Your profile</a></li>
                        <li class="logout"><form class="dropwdown-item" action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="btn nav-link text-black px-2" ><i class="fas fa-sign-out-alt"></i> Sign out</button>
                        </form></li>
                      </ul>
                    </li>
                    
                    @endauth
                    
                    @guest
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest
                  
                </ul>
              </div>
            </div>
          </nav>
    
            @yield('content')
      
   
    <footer class="bg-cyan fixed-bottom text-center text-black fw-light shadow" >
      Made by <a href="" class="text-black">Luca Bettini</a> | Read more <a href="{{ route('about') }}" class="text-black">here</a>.
    </footer>

     <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>