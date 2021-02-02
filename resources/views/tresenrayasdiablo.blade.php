@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{asset("css/tresenrayasdiablo.css")}}">
@endsection

@section("content")


        <div class="game-board safari-fix mt-5">
            <div class="choice">
                <h2>Selecciona tu dardo:</h2>
            </div>
            <div id="X" class="choice">
                <p class="piece">X</p>
            </div>
            <div id="O" class="choice">
                <p class="piece">O</p>
            </div>
        </div>

    <script src="{{asset("js/tresenrayasdiablo.js")}}"></script>
@endsection