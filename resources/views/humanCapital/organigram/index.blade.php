@extends('layouts.main')
@section('content')
    <link href="{{ asset('css/impress/organigram.css') }}" rel="stylesheet" />
    <div id="impress">
        <div class="step" data-x="0" data-y="400">
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
        </div>        
    </div>
    <script src="{{ asset('js/impress/impress.js') }}"></script>
    <script>
        impress().init();
        (function() {
            var impress = impress();
            impress.init();
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