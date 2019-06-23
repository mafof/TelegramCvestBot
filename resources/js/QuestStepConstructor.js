class QuestStepConstructor {
    constructor(id = "main") {
        this.mainId = id;
        this.namespace = "http://www.w3.org/2000/svg";
        this._mouseover = null; // Где находиться курсор

        this.counterQuestsSteps = 0;
        this.counterQuestsAnswers = 0;
        this.counterBind = 0;

        this.dbclickQuestStep = null; // ID выбранного Node квеста (для события dbclick)
        this.clickQuestStep = null; // ID выбранного Node квеста (для события click)
        this.pressedQuestStep = null; // ID  выбранного Node квеста (для события mousedown, mouseuo)

        this.clickAnswerButton = null; // ID выбранной кнопки варианта ответа
        this.clickBind = null; // ID выбранной связи кнопки <-> Node квеста

        this.registerGeneralEvents();

        this.importToCanvas(document.getElementById('questsStepsJsonString').value);
    }

    /**
     * Создаем Node квеста
     * @param text - описание в Node
     * @param x - coord
     * @param y - coord
     * @param id - уникальный индетификатор
     * @return {number} ID созданного Node
     */
    createQuestNode(text, x = 0, y = 0) {
        let _id = this.counterQuestsSteps;
        let questStep = document.createElementNS(this.namespace, 'g');
        questStep.setAttribute('transform', `translate(${x},${y})`);
        questStep.setAttribute('id', `questStep${_id}`);
        questStep.setAttribute('class', 'questStep');
        // custom properties =>
        questStep.x = x;
        questStep.y = y;

        // Создаем обертку для основы =>
        let shell = document.createElementNS(this.namespace, 'g');
        shell.setAttribute('id', `questStepShellMain${_id}`);

        // Создаем основу =>
        let rect = document.createElementNS(this.namespace, 'rect');
        rect.setAttribute('class', 'rect');
        rect.setAttribute('width', 240);
        rect.setAttribute('height', 70);
        rect.setAttribute('fill', '#1B1D20');

        // Создаем блок с текстом =>
        let foreignObject = document.createElementNS(this.namespace, 'foreignObject');
        foreignObject.setAttribute('x', 0);
        foreignObject.setAttribute('y', 0);
        foreignObject.setAttribute('width', 240);
        foreignObject.setAttribute('height', 70);

        let elText = document.createElement('div');
        elText.setAttribute('class', 'text');
        elText.setAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
        elText.innerText = text;
        foreignObject.appendChild(elText);

        // регистрируем события =>
        shell.addEventListener('dblclick', () => {
            if(this.dbclickQuestStep !== null) this.clearSelectedQuestStep();
            this.dbclickQuestStep = _id;
            rect.style.setProperty('stroke', 'red');
        });

        shell.addEventListener('click', () => {
            if(this.clickAnswerButton !== null) {
                this.clickQuestStep = _id;
                this.createBind(this.clickAnswerButton);
            }
        });

        shell.addEventListener('mousedown', () => {
           this.pressedQuestStep = _id;
        });
        shell.addEventListener('mouseup', () => {
            this.pressedQuestStep = null;
        });

        // Добавляем элементы в DOM =>
        shell.appendChild(rect);
        shell.appendChild(foreignObject);
        questStep.appendChild(shell);

        let svg = document.getElementById(this.mainId);
        svg.appendChild(questStep);

        return this.counterQuestsSteps++;
    }

    /**
     * Создает кнопку ответа (для перехода на следующий шаг)
     * @param text - текст ответа
     * @param {number} from - для какого Node квеста
     * @return {number} ID созданного ответа
     */
    createQuestAnswer(text, from) {
        let _id = this.counterQuestsAnswers;
        let main = document.createElementNS(this.namespace, 'g');
        main.setAttribute('id', `answerButton${_id}`);
        main.setAttribute("class", "answerButton");
        main.setAttribute("x", '0');

        let button = document.createElementNS(this.namespace, 'rect');
        button.setAttribute('class', 'rect');
        button.setAttribute('width', 240);
        button.setAttribute('height', 50);
        button.setAttribute('fill', '#1B1D20');
        button.setAttribute('x', '0');

        // Создание текста =>
        let textObj = document.createElementNS(this.namespace, 'foreignObject');
        textObj.setAttribute('width', 240);
        textObj.setAttribute('height', 50);
        textObj.setAttribute('x', '0');

        let elText = document.createElement('div');
        elText.setAttribute('class', 'text');
        elText.setAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
        elText.innerText = text;

        let svg = document.getElementById(this.mainId);
        svg.appendChild(main);

        // определенеи расположение кнопки по оси Y =>
        let y = 71 + (51 * this.getNumberAnswerInQuestNode(from));
        main.setAttribute("y", y);
        button.setAttribute("y", y);
        textObj.setAttribute("y", y);

        // Свойства для биндинга линий =>
        main.x = 0;
        main.y = y;

        // Биндим события =>
        main.addEventListener('click', () => {
            if(this.clickAnswerButton !== null) this.clearSelectedAnswerButton();
            this.clickAnswerButton = _id;
            document.getElementById(`answerButton${_id}`).style.stroke = "red";
        });

        // Добавляем все в корневой элемент =>
        textObj.appendChild(elText);
        main.appendChild(button);
        main.appendChild(textObj);
        document.getElementById(`questStep${from}`).appendChild(main);

        return this.counterQuestsAnswers++;
    }

    /**
     * Создает взаимосвязь между ответом и блоком Node квест
     * @param {number} answerButtonId - ID кнопки ответа
     * @param {number} toQuestStepId - ID Node квеста
     */
    createBind(answerButtonId, toQuestStepId = null) {
        console.log(`call -> createBind with args => ${answerButtonId} ${toQuestStepId}`);
        if(toQuestStepId === null && this.clickQuestStep === null) return;
        toQuestStepId = (toQuestStepId === null) ? this.clickQuestStep : toQuestStepId;
        let _id = this.counterBind;

        const WIDTH_QUEST_STEP = 240;
        const HEIGHT_QUEST_STEP = 70;
        const HALF_HEIGHT_ANSWER_BUTTON = 25;

        let answerButtonEl = document.getElementById(`answerButton${answerButtonId}`),
            questStepEl    = answerButtonEl.parentElement,
            toQuestStepEl  = document.getElementById(`questStep${toQuestStepId}`);

        // Объявляем координаты для дуги =>
        let coordFromBindEl = {
            x: questStepEl.x + WIDTH_QUEST_STEP,
            y: answerButtonEl.y + HALF_HEIGHT_ANSWER_BUTTON + questStepEl.y
        };

        let coordToBindEl = {
            x: toQuestStepEl.x,
            y: toQuestStepEl.y + HEIGHT_QUEST_STEP
        };

        // Создаем дугу =>
        let path = document.createElementNS(this.namespace, 'path');
        path.setAttribute('class', 'link');
        path.setAttribute('id', `arc${_id}`);
        path.setAttribute('answerButton', `answerButton${answerButtonId}`);
        path.setAttribute('toQuestStepId', toQuestStepId);
        path.setAttribute('d', `M ${coordFromBindEl.x},${coordFromBindEl.y} C${coordToBindEl.x - 20},${coordFromBindEl.y} ${coordFromBindEl.x + 20},${coordToBindEl.y} ${coordToBindEl.x},${coordToBindEl.y}`);

        path.addEventListener('click', () => {
           if(this.clickBind !== null) this.clearSelectedBind();
           this.clickBind = _id;
           path.setAttribute('class', 'link link-active');
        });

        document.getElementById(this.mainId).appendChild(path);
        this.clearSelectedAnswerButton();

        return this.counterBind++;
    }

    /**
     * Двигает выбранный Node
     * @param mx - движение мыши по оси X
     * @param my - движение мыши по оси Y
     */
    moveQuestNode(mx, my) {
        if(this.pressedQuestStep === null) return;
        let questStep = document.getElementById(`questStep${this.pressedQuestStep}`);
        let x = questStep.x + mx,
            y = questStep.y + my;

        if(x < 0) x = 0;
        if(y < 0) y = 0;
        questStep.x = x;
        questStep.y = y;

        questStep.setAttribute('transform', `translate(${x}, ${y})`);
    }

    /**
     * Передвигает все path
     */
    moveBind() {
        let listBinds = document.getElementsByClassName('link');
        const WIDTH_QUEST_STEP = 240;
        const HEIGHT_QUEST_STEP = 70;
        const HALF_HEIGHT_ANSWER_BUTTON = 25;

        for(let bind of listBinds) {

            let answerButtonEl = document.getElementById(bind.getAttribute('answerButton')),
                questStepEl    = answerButtonEl.parentElement,
                toQuestStepEl  = document.getElementById(`questStep${bind.getAttribute('toQuestStepId')}`);

            // Объявляем координаты для дуги =>
            let coordFromBindEl = {
                x: questStepEl.x + WIDTH_QUEST_STEP,
                y: answerButtonEl.y + HALF_HEIGHT_ANSWER_BUTTON + questStepEl.y
            };

            let coordToBindEl = {
                x: toQuestStepEl.x,
                y: toQuestStepEl.y + HEIGHT_QUEST_STEP
            };

            bind.setAttribute('d', `M ${coordFromBindEl.x},${coordFromBindEl.y} C${coordToBindEl.x - 20},${coordFromBindEl.y} ${coordFromBindEl.x + 20},${coordToBindEl.y} ${coordToBindEl.x},${coordToBindEl.y}`);
        }
    }

    /**
     * Снимает выделение с выбранного Node (двойным кликом мыши)
     */
    clearSelectedQuestStep() {
        if(this.dbclickQuestStep === null) return;
        document.getElementById(`questStepShellMain${this.dbclickQuestStep}`).children[0].style.stroke = "";
        this.dbclickQuestStep = null;
    }

    /**
     * Снимает выделение с выбранной кнопки ответа (одинарным нажатием мыши)
     */
    clearSelectedAnswerButton() {
        if(this.clickAnswerButton === null) return;
        document.getElementById(`answerButton${this.clickAnswerButton}`).style.stroke = "";
        this.clickAnswerButton = null;
    }

    clearSelectedBind() {
        let listBindings = document.getElementsByClassName('link');
        for(let bind of listBindings) {
            bind.setAttribute('class', 'link');
        }
        this.clickBind = null;
    }

    /**
     * Регистрация общих событий документа
     */
    registerGeneralEvents() {
        document.addEventListener('mousemove', (ev) => {
            this.moveQuestNode(ev.movementX, ev.movementY);
            this.moveBind();
        });

        // События холста =>
        let svg = document.getElementById(this.mainId);

        svg.addEventListener('mouseleave', () => {
            this.pressedQuestStep = null;
        });

        svg.addEventListener('mousedown', () => {
            if(this._mouseover === this.mainId) {
                this.clearSelectedQuestStep();
                this.clearSelectedAnswerButton();
                this.clearSelectedBind();
            }
        });

        svg.addEventListener('mouseover', (el) => {
            this._mouseover = el.target.id;
        });

        document.body.addEventListener('keydown', (ev) => {
            if (ev.code === "Backspace") {
                if(this.clickBind !== null) {
                    document.getElementById(`arc${this.clickBind}`).remove();
                    this.clickBind = null;
                }
            }
        });
    }

    /**
     * Функция возвращающая колл-во элементов кнопок в Node квеста
     * @param id - ID Node квеста
     * @return {number} - колл-во кнопок ответов
     */
    getNumberAnswerInQuestNode(id) {
        return document.querySelectorAll(`#questStep${id} > .answerButton`).length;
    }

    /**
     * @return {string} - json строка для дальнейшего внедрения в скрытое поле и отправки формы
     */
    exportToJson() {
        // code...
    }

    /**
     * Импортирует json строку в визуальные блоки
     */
    importToCanvas(data) {
        // code...
    }
}