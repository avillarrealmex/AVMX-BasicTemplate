@extends('layouts.main')

@section('content')
<link href="{{ asset('css/impress-common.css') }}" rel="stylesheet" />
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
        <h1>Código de vestimenta</h1>
    </div>
    <div id="dressCode1" class="step" data-x="0" data-y="0" data-scale="1" data-goto-prev="dressCode4">
        <img src="{{ asset('images/dressCode/dressCode1.png') }}">
    </div>
    <div id="dressCode2" class="step" data-x="0" data-y="500" data-scale="1">
        <img src="{{ asset('images/dressCode/dressCode2.png') }}">
    </div>
    <div id="dressCode3" class="step" data-x="0" data-y="1000" data-scale="1">
        <img src="{{ asset('images/dressCode/dressCode3.png') }}">
    </div>
    <div id="dressCode4" class="step" data-x="0" data-y="1500" data-scale="1" data-goto-next="inicio">
        <img src="{{ asset('images/dressCode/dressCode4.png') }}">
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