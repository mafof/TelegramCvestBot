@extends('layouts.app')

@section('content')
    <div class="container main-container">
        <div class="container-node">
            <!--div class="node create-node" id="node-popup">
                <span>Описание шага</span>
                <span class="span-close-window" onclick="closeWindowNode()"><i class="far fa-times-circle"></i></span>
                <div class="form-group">
                    <i class="fas fa-file-signature"></i>
                    <input type="text" id="nameQuestStep">
                </div>
                <div class="group">
                    <span>Вариант ответа</span>
                    <span class="span-close-window" onclick="removeAnswer(this)"><i class="far fa-times-circle"></i></span>
                    <div class="form-group">
                        <i class="fas fa-arrow-circle-right"></i>
                        <input type="text" class="answer-step-input">
                    </div>
                </div>
                <span class="cursor">Добавить вариант ответа</span>
                <span class="span-close-window cursor">Добавить</span>
            </div-->
        </div>
        <div class="main-constructor">
            <div class="constructor" id="main">
                <svg id="constructor" width="5000" height="5000" pointer-events="all" xmlns="http://www.w3.org/2000/svg">
                </svg>
            </div>
            <div class="buttons">
                <span onclick="showPopupAddNode()" class="btn btn-green btn-quest">Добавить ноду</span>
                <span onclick="showPopupEditNode()" class="btn btn-green btn-quest">Редактировать ноду</span>
                <span onclick="removeNodeQuest()" class="btn btn-green btn-quest">Удалить ноду</span>
                <span class="btn btn-green btn-quest">Опубликовать</span>
            </div>
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