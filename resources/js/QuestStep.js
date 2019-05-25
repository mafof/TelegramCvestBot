class QuestStep {
    constructor(id) {
        this.id = id;
        this.questsStepCount = 0;
        this.answerButtonsCount = 0;
        this.listQuestStep = [];
        this.namespace = 'http://www.w3.org/2000/svg';

        this._selectedButtonId = null; // ID нажатой кнопки ответа
        this._selectedElementBindQuestStep = null; // Элемент связи
        this._mouseover = null; // ID местонахождения курсора

        this.registerMainEvents();
    }

    /**
     * Создает шаг квеста
     * @param {number} x координата месторасположения блока
     * @param {number} y координата месторасположения блока
     * @param {string} id ID главного блока
     * @param {string} text текст блока
     */
    createQuestStep(x = 1, y = 1, text = "", id = null) {
        let questStep = document.createElementNS(this.namespace, 'g');
        questStep.setAttribute('transform', `translate(${x},${y})`);
        
        if(id === null) {
            questStep.setAttribute('id', `questStep${this.questsStepCount}`);
        } else {
            questStep.setAttribute('id', id);
        }

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
            this.createBindingQuestSteps(questStep);
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
            text: text,
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
            bindQuestStepID: null,
            pathElement: null,
            selected: false
        });

        return this.answerButtonsCount++;
    }

    /**
     * Создает связь между кнопкой и шагом квеста
     * @param {object} elToBind Node шага квеста к которому надо связать выбранный блок
     */
    createBindingQuestSteps(elToBind) {
        if(typeof elToBind !== "object") return;

        if(this._selectedButtonId !== null) {
            let selectedButton = document.getElementById(this._selectedButtonId);
            let elFromBind = selectedButton.parentElement;
            if(elFromBind.id !== elToBind.id) {
                let elListQuestStepParent = this.listQuestStep.find((el) => elFromBind.id === `questStep${el.id}`);
                let coordFrom = {
                    x: elListQuestStepParent.x,
                    y: new Number(selectedButton.firstChild.attributes.y.value) + elListQuestStepParent.y
                }

                let elListQuestStepToBind = this.listQuestStep.find((el) => elToBind.id === `questStep${el.id}`);
                let coordTo = {
                    x: elListQuestStepToBind.x,
                    y: elListQuestStepToBind.y
                }

                coordFrom.x += 240;
                coordFrom.y += 25;
                coordTo.y += 70;

                let path = document.createElementNS(this.namespace, 'path');
                path.setAttribute('class', 'link');
                path.setAttribute('buttonAnswer', this._selectedButtonId);
                path.setAttribute('fromElementQuestStep', elFromBind.id);
                path.setAttribute('toElementQuestStep', elToBind.id);
                path.setAttribute('d', `M ${coordFrom.x},${coordFrom.y} C${coordTo.x - 20},${coordFrom.y} ${coordFrom.x + 20},${coordTo.y} ${coordTo.x},${coordTo.y}`);

                path.addEventListener('click', () => {
                    this.clearAllSelectedBindQuestStep();
                    path.setAttribute('class', 'link link-active');
                    this._selectedElementBindQuestStep = path;
                });

                this.listQuestStep.map((el) => {
                    el.answerButtons.map((el) => {
                        if(this._selectedButtonId === `answerButton${el.id}`) {
                            el.bindQuestStepID = elToBind.id;
                            el.pathElement = path
                        }
                    });
                });

                let svg = document.getElementById(this.id);
                svg.appendChild(path);
                this.clearAllSelectedButtonsAnswerQuestStep();
            }    
        }
    }

    /**
     * Преобразовывает Object с данными в JSON строку
     * @returns {JSON} JSON строка с данными для БД
     */
    exportToJsonData() {
        let data = [];

        for(let questStep of this.listQuestStep) {
            data.push({
                id: `questStep${questStep.id}`,
                text: questStep.text,
                x: questStep.x,
                y: questStep.y,
                answerButtons: []
            });
            
            for(let answerButton of questStep.answerButtons) {
                data[data.length-1].answerButtons.push({
                    bindQuestStepID: answerButton.bindQuestStepID || null,
                    text: answerButton.text
                });
            }
        }
        
        return JSON.stringify(data);
    }

    /**
     * Создает блоки и связи между ними из массива данных
     * @param {string} json json строка данных
     * @returns {boolean} был ли произведен импорт
     */
    importJsonString(json) {
        if(json === undefined || typeof json !== 'string') return false;

        let data = JSON.parse(json),
            linked = {};

        // Создаем блоки и подблоки в них =>
        for(let questStep of data) {
            let elQuestStep = this.createQuestStep(questStep.x, questStep.y, questStep.text, questStep.id);
            
            for(let answerButton of questStep.answerButtons) {
                let buttonNumberid = this.createAnswerToQuestStep(elQuestStep, answerButton.text);
                
                if(answerButton.bindQuestStepID !== null)
                    linked[`answerButton${buttonNumberid}`] = answerButton.bindQuestStepID;
            }
        }

        // Создаем связи между блоками =>
        for(let index in linked) {
            this._selectedButtonId = index;
            this.createBindingQuestSteps(document.getElementById(linked[index]));
        }
        
        return true;
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

    /**
     * Перемещает линии вместе с блоками
     */
    moveBindedLine() {
        let listBinded = document.getElementsByClassName('link'); // Список всех path
        for(let element of listBinded) {

                let elListQuestStepParent = this.listQuestStep.find((el) => element.getAttribute('fromElementQuestStep') === `questStep${el.id}`);
                let coordFrom = {
                    x: elListQuestStepParent.x,
                    y: new Number(document.getElementById(element.getAttribute('buttonAnswer')).firstChild.attributes.y.value) + elListQuestStepParent.y
                }

                let elListQuestStepToBind = this.listQuestStep.find((el) => element.getAttribute('toElementQuestStep') === `questStep${el.id}`);
                let coordTo = {
                    x: elListQuestStepToBind.x,
                    y: elListQuestStepToBind.y
                }

                coordFrom.x += 240;
                coordFrom.y += 25;
                coordTo.y += 70;

                element.setAttribute('d', `M ${coordFrom.x},${coordFrom.y} C${coordTo.x - 20},${coordFrom.y} ${coordFrom.x + 20},${coordTo.y} ${coordTo.x},${coordTo.y}`);
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

    clearAllSelectedBindQuestStep() {
        let listBindings = document.getElementsByClassName('link');
        
        for(let element of listBindings) {
            element.setAttribute('class', 'link');
        }
        this._selectedElementBindQuestStep = null;
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
                    this.moveBindedLine(el.id);
                }
            })
        });

        document.body.addEventListener('keydown', (ev) => {
            if(ev.code === "Backspace") {
                if(this._selectedElementBindQuestStep !== null) {
                    let buttonAnswerElementID = this._selectedElementBindQuestStep.getAttribute('buttonAnswer');

                    this.listQuestStep.map(el => {
                        el.answerButtons.map(el => {
                            if(`answerButton${el.id}` === buttonAnswerElementID) {
                                el.bindQuestStepID = null;
                                el.pathElement = null;
                            }
                        });
                    });

                    let svg = document.getElementById(this.id);
                    svg.removeChild(this._selectedElementBindQuestStep);
                    this.clearAllSelectedBindQuestStep();
                }
            }
        });

        // Внутри элемента конструктора =>
        let main = document.getElementById(this.id);
        
        main.addEventListener('mouseleave', () => {
            console.log('mouseleave');
            this.clearAllSelectedQuestStep();
        });

        main.addEventListener('mousedown', () => {
            if(this._mouseover === "constructor") {
                this.clearAllSelectedButtonsAnswerQuestStep();
                this.clearAllSelectedBindQuestStep();
            }
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