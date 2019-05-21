class QuestStep {
    constructor(id) {
        this.id = id;
        this.questsStepCount = 0;
        this.answerButtonsCount = 0;
        this.listQuestStep = [];
        this.namespace = 'http://www.w3.org/2000/svg';

        this._selectedButtonId = null; // ID нажатой кнопки ответа
        this._mouseover = null; // ID местонахождения курсора

        this.registerMainEvents();
    }

    /**
     * Создает шаг квеста
     * @param {number} x координата месторасположения блока
     * @param {number} y координата месторасположения блока
     * @param {string} text текст блока
     */
    createQuestStep(x = 1, y = 1, text = "") {
        let questStep = document.createElementNS(this.namespace, 'g');
        questStep.setAttribute('id', `questStep${this.questsStepCount}`);
        questStep.setAttribute('transform', `translate(${x},${y})`);

        let rect = document.createElementNS(this.namespace, 'rect');
        rect.setAttribute('id', `questStepMain${this.questsStepCount}`);
        rect.setAttribute('class', 'rect');
        rect.setAttribute('width', 240);
        rect.setAttribute('height', 70);
        rect.setAttribute('fill', '#1B1D20');

        let foreignObject = document.createElementNS(this.namespace, 'foreignObject');
        foreignObject.setAttribute('x', 0);
        foreignObject.setAttribute('y', 0);
        foreignObject.setAttribute('width', 240);
        foreignObject.setAttribute('height', 70);

        let elText = document.createElement('div');
        elText.setAttribute('class', 'text');
        elText.setAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
        elText.innerText = text;

        questStep.addEventListener('click', () => {
            if(
                this._selectedButtonId !== null &&
                document.getElementById(this._selectedButtonId).parentElement.id !== questStep.id
            ) {
                console.log(questStep.id);
            }
        });

        rect.addEventListener('mousedown', () => {
            console.log(rect.id);
            let index = this.listQuestStep.findIndex((el) => `questStepMain${el.id}` === rect.id)
            if(index !== -1) {
                this.listQuestStep[index].selected = true;
            }
        });

        foreignObject.addEventListener('mousedown', () => {
            console.log(rect.id);
            let index = this.listQuestStep.findIndex((el) => `questStepMain${el.id}` === rect.id)
            if(index !== -1) {
                this.listQuestStep[index].selected = true;
            }
        });

        foreignObject.appendChild(elText);
        questStep.appendChild(rect);
        questStep.appendChild(foreignObject);

        this.listQuestStep.push({
            id: this.questsStepCount,
            x: x,
            y: y,
            selected: false,
            answerButtons: []
        });

        let svg = document.getElementById(this.id);
        svg.appendChild(questStep);

        return this.questsStepCount++;
    }

    /**
     * Создает кнопку ответ для определенного шага квеста
     * @param {string|number} id INDEX массива с объектом шага квеста
     * @param {string} textAnswer Текст кнопки
     */
    createAnswerToQuestStep(id, textAnswer) {
        let numberAnswerButtons = this.listQuestStep[id].answerButtons.length;

        let main = document.createElementNS(this.namespace, 'g');
        main.setAttribute('id', `answerButton${this.answerButtonsCount}`);

        let button = document.createElementNS(this.namespace, 'rect');
        button.setAttribute('class', 'rect');
        button.setAttribute('width', 240);
        button.setAttribute('height', 50);
        button.setAttribute('fill', '#1B1D20');
        button.setAttribute('x', '0');

        let text = document.createElementNS(this.namespace, 'foreignObject');
        text.setAttribute('width', 240);
        text.setAttribute('height', 50);
        text.setAttribute('x', '0');

        let elText = document.createElement('div');
        elText.setAttribute('class', 'text');
        elText.setAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
        elText.innerText = textAnswer;

        let y = 0;
        
        if(numberAnswerButtons === 0) {
            y = 71;
        } else if(numberAnswerButtons > 0) {
            y = 71 + (51*numberAnswerButtons);
        }

        button.setAttribute('y', y);
        text.setAttribute('y', y);

        text.appendChild(elText);
        main.appendChild(button);
        main.appendChild(text);

        main.addEventListener('mousedown', (el) => {
            console.log(main.id);
            this.listQuestStep.forEach((el, index) => {
                el.answerButtons.map((el) => {
                    if(`answerButton${el.id}` === main.id) {
                        
                        if(this._selectedButtonId !== null) {
                            
                            if(this.isEqualsParentElements(this._selectedButtonId, main.id)) {
                                this.clearAllSelectedButtonsAnswerQuestStep();
                                this._selectedButtonId =`answerButton${el.id}`; 
                                document.getElementById(this._selectedButtonId).setAttribute('class', 'active-answer-button');
                                el.selected = true;
                            } else { // Если не в том же блоке =>
                                // code...
                            }
                        
                        } else {
                            this._selectedButtonId =`answerButton${el.id}`; 
                            document.getElementById(this._selectedButtonId).setAttribute('class', 'active-answer-button');
                            el.selected = true;
                        }
                    }
                });
            });
        });

        document.getElementById(`questStep${this.listQuestStep[id].id}`).appendChild(main);

        this.listQuestStep[id].answerButtons.push({
            id: this.answerButtonsCount,
            y: y,
            text: textAnswer,
            bindQuestStep: null,
            selected: false
        });

        return this.answerButtonsCount++;
    }

    createBindingQuestSteps() {
        // code...
    }

    moveQuestStep(id, x, y) {
        let element = document.getElementById(`questStep${id}`);
        let index = this.listQuestStep.findIndex((el) => el.id === id);
        if(index !== -1) {
            x = x + this.listQuestStep[index].x;
            y = y + this.listQuestStep[index].y;

            if(x < 0) x = 0;
            if(y < 0) y = 0;

            this.listQuestStep[index].x = x;
            this.listQuestStep[index].y = y;

            element.setAttribute('transform', `translate(${x},${y})`);
        }
    }

    clearAllSelectedQuestStep() {
        this.listQuestStep.map((el) => el.selected = false);
    }

    clearAllSelectedButtonsAnswerQuestStep() {
        this.listQuestStep.map((el) => {
            el.answerButtons.map((el) => {
                document.getElementById(`answerButton${el.id}`).setAttribute('class', '');
                el.selected = false
            });
        });
        this._selectedButtonId = null;
    }

    registerMainEvents() {
        // Для всего документа =>

        document.addEventListener('mouseup', () => {
            this.clearAllSelectedQuestStep();
        });

        document.addEventListener('mousemove', (event) => {
            this.listQuestStep.forEach((el) => {
                if(el.selected === true) {
                    this.moveQuestStep(el.id, event.movementX, event.movementY);
                }
            })
        });

        // Внутри элемента конструктора =>
        let main = document.getElementById(this.id);
        
        main.addEventListener('mouseleave', () => {
            console.log('mouseleave');
            this.clearAllSelectedQuestStep();
        });

        main.addEventListener('mousedown', () => {
            if(this._mouseover === "constructor")
                this.clearAllSelectedButtonsAnswerQuestStep();
        });

        main.addEventListener('mouseover', (el) => {
            this._mouseover = el.target.id;
        });
    }

    isEqualsParentElements(selectedId, selectElement) {
        if(selectedId === null) return false;
        let selected = document.getElementById(selectedId).parentElement.id;
        let select = document.getElementById(selectElement).parentElement.id;
        
        return selected === select;
    }
}