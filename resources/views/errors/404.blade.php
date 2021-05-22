<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Calendarecycle - Not found</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <h2>
                I have climbed the highest mountains
            </h2>
            <h2 class="mb-4">I have run through the fields...</h2>
            <h2>But I still haven't found what you're looking for.</h2>
            <p class="mt-5">
                
                I promise that I will keep searching, but in the meantime, you can 
                @guest
                    <a href="/" class="text-cyan">go back</a>
                @endguest
                @auth
                    <a href="{{route('home')}}" class="text-cyan">go back</a>
                @endauth
                .
            </p>
            

        </div>
    </div>

</body>
</html>