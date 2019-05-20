class QuestStep {
    constructor(id) {
        this.id = id;
        this.questsStepCount = 0;
        this.answerButtonsCount = 0;
        this.listQuestStep = [];
        this.namespace = 'http://www.w3.org/2000/svg';

        document.addEventListener('mouseup', () => {
            console.log('mouseup');
            this.listQuestStep.map((el) => el.selected = false);
        });

        document.addEventListener('mousemove', (event) => {
            this.listQuestStep.forEach((el) => {
                if(el.selected === true) {
                    this.moveQuestStep(el.id, event.movementX, event.movementY);
                }
            })
        });

        main.addEventListener('mouseleave', () => {
            console.log('mouseleave');
            this.listQuestStep.map((el) => el.selected = false);
        });
    }

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
        });

        document.getElementById(`questStep${this.listQuestStep[id].id}`).appendChild(main);

        this.listQuestStep[id].answerButtons.push({
            id: this.answerButtonsCount,
            y: y,
            text: textAnswer,
            selected: false
        });

        return this.answerButtonsCount++;
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
}