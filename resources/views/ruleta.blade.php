@extends("layouts.page")

@section("head-extras")

@endsection

@section("content")
<div id="ruleta">
    <Ruleta />
</div>
<script src="{{asset("js/ruleta.js")}}" defer></script>
<style>
    body {
        background-image: url("/image/fondo3.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;

        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
@endsection