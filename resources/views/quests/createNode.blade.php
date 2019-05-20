@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 main-constructor">
                <div class="col-12 constructor" id="main">
                    <svg id="constructor" width="5000" height="5000" pointer-events="all">

                        <g id="questStep2" transform="translate(300,300)">
                            <rect id="questStepMain1" class="rect" width="240" height="70" fill="#1B1D20"></rect>
                            <foreignObject x="0" y="0" width="235" height="70">
                                <div xmlns="http://www.w3.org/1999/xhtml" class="text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem ut ad, omnis eligendi quam vitae vero blanditiis minus voluptatibus deserunt consectetur molestiae a quia expedita corrupti exercitationem perferendis iste architecto!
                                </div>
                            </foreignObject>
                            <g>
                                <rect class="answer-rect" width="240" height="50" fill="#212429" y="71"></rect>
                                <foreignObject x="0" y="71" width="240" height="50">
                                    <div xmlns="http://www.w3.org/1999/xhtml" class="text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem ut ad, omnis eligendi quam vitae vero blanditiis minus voluptatibus deserunt consectetur molestiae a quia expedita corrupti exercitationem perferendis iste architecto!
                                    </div>
                                </foreignObject>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/all.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                console.log("loaded...");
                let b = new QuestStep('constructor');
                b.createQuestStep();
                let c = b.createQuestStep(100, 100, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem ut ad, omnis eligendi quam vitae vero blanditiis minus voluptatibus deserunt consectetur molestiae a quia expedita corrupti exercitationem perferendis iste architecto!');
                b.createAnswerToQuestStep(c, "Кнопка 1");
                b.createAnswerToQuestStep(c, "Кнопка 2");
                b.createAnswerToQuestStep(c, "Кнопка 3");
            });
        </script>
    </div>
@endsection