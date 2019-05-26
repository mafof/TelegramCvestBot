@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-constructor">
            <div class="constructor" id="main">
                <svg id="constructor" width="5000" height="5000" pointer-events="all">
                </svg>
            </div>
            <div class="buttons">
                <span class="btn btn-green">Добавить ноду</span>
                <span class="btn btn-green">Редактировать ноду</span>
                <span class="btn btn-green">Удалить ноду</span>
                <span class="btn btn-green">Опубликовать</span>
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