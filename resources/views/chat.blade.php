<x-app-layout>
    @section('content')
        <style>
            .chan {
                background-color: #eff0f6;
                height: 70vh;
                overflow: y;
            }

            .chatname {
                background-color: #d5dcf4;
                padding: 10px 20px;
            }

            input[type="text"] {
                width: 100%;
            }   
        </style>
        <section class="app">
            <div class="chatname">
                <h2>{{ __('Salon principal') }}</h2>
            </div>
            <div class="chan" id="messageArea"></div>

            <form id="form">
                <input type="text" autocomplete="off" placeholder="{{ __('Ecris un message') }}" id="message">
                <button type="submit">{{ __('Envoyer') }}</button>
            </form>
        </section>
    @endsection
</x-app-layout>
