@extends('layouts.main')

@section('content')
<!-- <link href="{{ asset('css/impress/impress-common.css') }}" rel="stylesheet" /> -->
<style>
    .step {
        position: relative;
        width: 57vw;
        height: 70vh;
        padding: 40px 60px;
        margin: 20px auto;
        box-sizing: border-box;
        line-height: 1.5;
        background-color: #d2d2d2;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
        text-shadow: 0 2px 2px rgba(0, 0, 0, .1);
        font-family: 'Open Sans', Arial, sans-serif;
        font-size: 40pt;
        letter-spacing: -1px;
        vertical-align: middle;
        align-items: center;
    }

    .step {
        transition: all 1s ease-in-out;
    }

    .step[data-y="100"] {
        transform: translateY(100%);
    }

    .step[data-y="-100"] {
        transform: translateY(-100%);
    }

    img {
        width: 50vw;
        height: 60vh;
    }
    .impress-enabled .step {
        margin: 0;
        opacity: 0.1;
        transition: opacity 1s;
    }

    .impress-enabled .step.active { opacity: 1 }
</style>

<div id="impress" data-transition-duration="1000">
    <div id="inicio" class="step overview" data-x="1350" data-y="100" data-z="100" data-scale="3" data-rotate-y="90">
        <h1>Beneficios no salariales</h1>
    </div>
    <div id="beneficios" class="step" data-x="0" data-y="500" data-z="0" data-goto-prev="dudas">
            <img src="{{ asset('images/nonWageBenefits/beneficios.png') }}">
        </div>
        <div id="cumple" class="step" data-x="0" data-y="1000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/cumple.png') }}">
        </div>
        <div id="madrePadre" class="step" data-x="0" data-y="1500" data-z="-0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/madrePadre.png') }}">
        </div>
        <div id="boda" class="step" data-x="0" data-y="2000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/boda.png') }}">
        </div>
        <div id="nacimiento" class="step" data-x="0" data-y="2500" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/nacimiento.png') }}">
        </div>
        <div id="fallecimiento" class="step" data-x="0" data-y="3000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/fallecimiento.png') }}">
        </div>
        <div id="accidentes" class="step" data-x="0" data-y="3500" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/accidente.png') }}">
        </div>
        <div id="kitSalud" class="step" data-x="0" data-y="4000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/kitSalud.png') }}">
        </div>
        <div id="tiendaKoi" class="step" data-x="0" data-y="4500" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/tiendaKoi.png') }}">
        </div>
        <div id="tiendaKoi1" class="step" data-x="0" data-y="5000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/fin1.png') }}">
        </div>
        <div id="tiendaKoi2" class="step" data-x="0" data-y="5500" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/fin2.png') }}">
        </div>
        <div id="reconocimiento" class="step" data-x="0" data-y="6000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/reconocimiento.png') }}">
        </div>
        <div id="reconocimiento1" class="step" data-x="0" data-y="6500" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx">
            <img src="{{ asset('images/nonWageBenefits/reconocimiento2.png') }}">
        </div>
        <div id="dudas" class="step" data-x="0" data-y="7000" data-z="0" data-rotate-z="0" data-rotate-y="0" data-rotate-order="zyx" data-goto-next="inicio">
            <img src="{{ asset('images/nonWageBenefits/dudas.png') }}">
        </div>
    <!-- Add more steps with images here -->

</div>

    <div id="impress-toolbar"></div>

    <script type="text/javascript" src="{{ asset('js/impress/extras/highlight/highlight.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/impress/extras/mermaid/mermaid.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/impress/extras/markdown/markdown.js') }}"></script>

    <script src="{{ asset('js/impress/impress.js') }}"></script>
    <script>
        impress().init();
    </script>
@endsection