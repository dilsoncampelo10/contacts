<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @stack('css')
    </head>
    <body>
        <nav class="navbar bg-body-tertiary mb-5">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{route('contacts.index')}}"><i class="fa-solid fa-address-book"></i> Contact List</a>
              @auth

                  <form action="{{route('logout')}}" method="post">
                    @csrf
                        <button class="btn btn-outline-primary" type="submit">Sair</button>
                  </form>
              @endauth
              @guest
                <a href="{{route('login')}}" class="btn btn-outline-primary">Login</a>
              @endguest
              
              
            </div>
          </nav>
  
          @if (session('success'))
          <div class="alert alert-success">
              <div>{{session('success')}}</div>
              
          </div>
      @endif

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
       
        @yield('content')

        @stack('js')
    </body>
</html>
