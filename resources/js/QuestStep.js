class QuestStep {
    constructor(id) {
        this.id = id;
        this.questsStepCount = 0;
        this.listQuestStep = [];

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
        let questStep = document.createElementNS('http://www.w3.org/2000/svg', 'g');
        questStep.setAttribute('id', `questStep${this.questsStepCount}`);
        questStep.setAttribute('transform', `translate(${x},${y})`);

        let rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        rect.setAttribute('id', `questStepMain${this.questsStepCount}`);
        rect.setAttribute('class', 'rect');
        rect.setAttribute('width', '240');
        rect.setAttribute('height', '70');
        rect.setAttribute('fill', '#1B1D20');

        let foreignObject = document.createElementNS('http://www.w3.org/2000/svg', 'foreignObject');
        foreignObject.setAttribute('x', '0');
        foreignObject.setAttribute('y', '0');
        foreignObject.setAttribute('width', '235');
        foreignObject.setAttribute('height', '70');

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

        this.questsStepCount++;
        let svg = document.getElementById(this.id);
        svg.appendChild(questStep);

        return questStep;
    }

    createAnswerToQuestStep(id, textAnswer) {
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
}