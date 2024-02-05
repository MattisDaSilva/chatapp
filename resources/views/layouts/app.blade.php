<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>@yield('title', 'Formation Laravel 10')</title>
</head>

<body>
    <!-- resources/views/layouts/app.blade.php -->

<style>
    .chat {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .chat li {
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
      margin: 0;
      color: #777777;
    }

    .panel-body {
      overflow-y: scroll;
      height: 350px;
    }

    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
  </style>

  <div class="container">
    <nav class="pb-1">
      <div>

      </div>
      <div>
        {{ __('Vous naviguez en') }} [{{ session('locale') }}] [{{ App::getLocale() }}]
        <a href="{{ route('language.change', ['code_iso' => 'fr']) }}">{{ __('French') }}</a>
        <a href="{{ route('language.change', ['code_iso' => 'en']) }}">{{ __('English') }}</a>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">
          {{ __('Log Out') }}
        </x-dropdown-link>
      </form>
    </nav>
    @yield('content')
  </div>
</body>

</html>
