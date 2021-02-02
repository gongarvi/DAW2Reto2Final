@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{ URL::asset('css/game-page.css') }}">
@endsection

@section("content")
    <div id="app">
        <div class="logo text-center w-100">
            <img class="text-center m-auto" src="{{asset("image/logo.png")}}">
        </div>
        <millonario/>
    </div>
    <script src="{{asset("js/millonario.js")}}" defer>
    </script>
@endsection
