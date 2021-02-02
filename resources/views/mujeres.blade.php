@extends("layouts.page")

@section("head-extras")
    <link rel="stylesheet" href="{{asset("css/mujeres.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section("content")

    <a class="ir-arriba" title="Volver arriba">
      <span class="fa-stack">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
      </span>
    </a>

    <div id="mujeres">
        <mujeres-component></mujeres-component>
    </div>

    <script src="{{asset("js/mujeres.js")}}" defer></script>

@endsection
