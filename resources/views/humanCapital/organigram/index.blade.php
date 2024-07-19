@extends('layouts.main')
@section('content')
    <link href="{{ asset('css/impress/organigram.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('css/impress/impress-common.css') }}" rel="stylesheet" /> -->
    <div id="impress">
        <!-- <div class="step" data-x="0" data-y="400">
            <div class="scheduleContainer">
                <div class="title">Organigram Title</div>
            </div>
        </div>
        <div class="step" data-x="400" data-y="800">
            <div class="scheduleContainer">
                <div class="node">
                    <div class="name">CEO</div>
                    <div class="role">Chief Executive Officer</div>
                </div>
            </div>
        </div>
        <div class="step" data-x="400" data-y="1200">
            <div class="scheduleContainer">
                <div class="node">
                    <div class="name">VP of Operations</div>
                    <div class="role">Vice President of Operations</div>
                </div>
            </div>
        </div>
        <div class="step" data-x="400" data-y="-40">
            <div class="scheduleContainer">
                <div class="node">
                    <div class="name">VP of Marketing</div>
                    <div class="role">Vice President of Marketing</div>
                </div>
            </div>
        </div> -->
        <div class="organigramContainer">
            <h1 class="level-1 rectangle">CEO</h1>
            <!-- Segundo nivel -->
            <ol class="level-2-wrapper">
                <li>
                Level 2
                    <ol class="level-3-wrapper">
                        <li>
                            <h3 class="level-3 rectangle">Level 3</h3>
                        </li>
                        <li>
                            <h3 class="level-3 rectangle">Level 3</h3>
                        </li>
                    </ol>
                </li>
                <li>
                Leve 2
                    <ol class="level-3-wrapper">
                        <li>
                            <h3 class="level-3 rectangle">Level 3</h3>
                        </li>
                        <li>
                            <h3 class="level-3 rectangle">Level 3</h3>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>
    <script src="{{ asset('js/impress/impress.js') }}"></script>
    <script>
        impress().init();
        

    (function() {
        var impress = impress();

        impress.init();

        // Optional: Add navigation controls (next, previous, etc.)
        var prevButton = document.createElement('button');
        prevButton.textContent = 'Previous';
        prevButton.addEventListener('click', function() {
            impress.prev();
        });
        document.body.appendChild(prevButton);

        var nextButton = document.createElement('button');
        nextButton.textContent = 'Next';
        nextButton.addEventListener('click', function() {
            impress.next();
        });
        document.body.appendChild(nextButton);
    })();

    </script>
@endsection