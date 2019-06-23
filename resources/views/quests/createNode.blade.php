@extends('layouts.app')

@section('content')
    <div class="container main-container">
        <div class="container-node"></div>
        <div class="main-constructor">
            <div class="constructor" id="main">
                <svg id="constructor" width="5000" height="5000" pointer-events="all" xmlns="http://www.w3.org/2000/svg">
                </svg>
            </div>
            <form action="/quest" method="POST">
                @csrf
                <div class="buttons">
                    <span onclick="showPopupAddNode()" class="btn btn-green btn-quest">Добавить ноду</span>
                    <span onclick="showPopupEditNode()" class="btn btn-green btn-quest">Редактировать ноду</span>
                    <span onclick="removeNodeQuest()" class="btn btn-green btn-quest">Удалить ноду</span>
                    <span onclick="sendQuest()" class="btn btn-green btn-quest">Опубликовать</span>
                </div>
                <input id="questsStepsJsonString" type="hidden" name="questsStepsJson">
            </form>
        </div>
        <script src="{{ asset('js/all.js') }}"></script>
        <script>
            let questConstructor = null;
            let arrayElementsRemove = []; // Массив с данными привязок которые при обновление удаляются @deprecated
            let arrayIdAnswerRemove = []; // Массив с ID элементами ответов, которые нужно удалить
            document.addEventListener('DOMContentLoaded', () => {
                console.log("loaded...");
                questConstructor = new QuestStepConstructor('constructor');
            });
        </script>
    </div>
@endsection