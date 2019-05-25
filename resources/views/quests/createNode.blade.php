@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 main-constructor">
                <div class="col-12 constructor" id="main">
                    <svg id="constructor" width="5000" height="5000" pointer-events="all">
                    </svg>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/all.js') }}"></script>
        <script>
            let b = null;
            document.addEventListener('DOMContentLoaded', () => {
                console.log("loaded...");
                b = new QuestStep('constructor');
            });
        </script>
    </div>
@endsection