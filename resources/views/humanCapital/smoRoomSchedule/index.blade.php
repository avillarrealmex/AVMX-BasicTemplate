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

    .step[data-y="0"] {
        transform: translateY(100%);
    }

    .step[data-y="0100"] {
        transform: translateY(-100%);
    }

    img {
        width: 50vw;
        height: 60vh;
    }
    .impress-enabled .step {
        margin: 0;
        opacity: 0.1;
        transition: opacity -2s;
    }

    .impress-enabled .step.active { opacity: 1 }
</style>

<div id="impress" data-transition-duration="1000">
    <div id="smoRoomSchedule1" class="step" data-x="0" data-y="0" data-z="0" data-scale="3" data-rotate-y="90">
        <img src="{{ asset('images/smoRoomSchedule/smoRoomSchedule1.png') }}">
    </div>
    <div id="smoRoomSchedule2" class="step" data-x="0" data-y="0" data-z="0" data-scale="3" data-rotate-y="180">
        <img src="{{ asset('images/smoRoomSchedule/smoRoomSchedule2.png') }}">
    </div>
    <div id="smoRoomSchedule3" class="step" data-x="0" data-y="0" data-z="0" data-scale="3" data-rotate-y="270">
        <img src="{{ asset('images/smoRoomSchedule/smoRoomSchedule3.png') }}">
    </div>
    <div id="smoRoomSchedule4" class="step" data-x="0" data-y="0" data-z="0" data-scale="3" data-rotate-y="360">
        <img src="{{ asset('images/smoRoomSchedule/smoRoomSchedule4.png') }}">
    </div>
</div>
    <div id="impress-toolbar"></div>
    <script type="text/javascript" src="{{ asset('js/impress/extras/highlight/highlight.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/impress/extras/mermaid/mermaid.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/impress/extras/markdown/markdown.js') }}"></script>

    <script src="{{ asset('js/impress/impress.js') }}"></script>
    <script>
        impress().init();

        // Get the slides
        const slides = document.querySelectorAll('.step');

        // Add event listeners to each slide
        slides.forEach((slide, index) => {
            slide.addEventListener('click', () => {
                // Get the current slide index
                const currentIndex = index;

                // Get the next slide index
                const nextIndex = (currentIndex + 1) % slides.length;

                // Add the wheel transition effect
                wheelTransition(slides[currentIndex], slides[nextIndex]);
            });
        });

        // Wheel transition function
        function wheelTransition(currentSlide, nextSlide) {
            // Calculate the rotation angle
            const angle = 360 / slides.length;

            // Add the rotation animation to the current slide
            currentSlide.style.transform = `rotate(${angle}deg)`;

            // Add the transition animation to the next slide
            nextSlide.style.transform = `translateX(0)`;

            // Remove the active class from the current slide
            currentSlide.classList.remove('active');

            // Add the active class to the next slide
            nextSlide.classList.add('active');
        }
    </script>
@endsection