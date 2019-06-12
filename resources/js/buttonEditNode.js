function showEditNode() {
    if(document.getElementById('node-popup') !== null) return;
    if(questConstructor._selectedQuestStep === null) return;

    let index = questConstructor._selectedQuestStep.match(/([0-9]){1,100}/gm)[0];
    let stepQuestObj = questConstructor.listQuestStep[index];

    let container = document.getElementsByClassName('container-node')[0];
    let menu = document.createElement('div');
    menu.className = "node create-node";
    menu.id = "node-popup";

    let spanCloseWindow = document.createElement('span');
    spanCloseWindow.className = "span-close-window";
    spanCloseWindow.onclick = closeWindowNode.bind(this);
    let icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseWindow.appendChild(icon);
    menu.appendChild(spanCloseWindow);

    // Добавление описание шага =>
    let spanDescribeStep = document.createElement('span');
    spanDescribeStep.innerText = "Описание шага";
    menu.appendChild(spanDescribeStep);
    menu.appendChild(getForm('fas fa-file-signature', 'nameQuestStep', 'id', stepQuestObj.text));

    // Добавление шагов =>
    stepQuestObj.answerButtons.forEach((el) => {
        let group = document.createElement('div');
        group.className = "group";

        let spanVarAnswer = document.createElement('span');
        spanVarAnswer.innerText = "Вариант ответа";

        let spanCloseAnswer = document.createElement('span');
        spanCloseAnswer.className = "span-close-window";
        spanCloseAnswer.onclick = removeAnswer.bind(this, spanCloseAnswer);
        let iconCloseAnswer = document.createElement('i');
        iconCloseAnswer.className = "far fa-times-circle";
        spanCloseAnswer.appendChild(iconCloseAnswer);

        group.appendChild(spanCloseAnswer);
        group.appendChild(spanVarAnswer);
        group.appendChild(getForm('fas fa-arrow-circle-right', 'answer-step-input', 'class', el.text));
        menu.appendChild(group);
    });

    let spanAddAnswerQuestStep = document.createElement('span');
    spanAddAnswerQuestStep.innerText = "Добавить вариант ответа";
    spanAddAnswerQuestStep.onclick = addAnswerToNode;
    spanAddAnswerQuestStep.className = "cursor";
    menu.appendChild(spanAddAnswerQuestStep);

    let spanAppendQuestStep = document.createElement('span');
    spanAppendQuestStep.innerText = "Сохранить";
    spanAppendQuestStep.className = "span-close-window cursor";
    spanAppendQuestStep.onclick = saveQuestStep.bind(this, index);
    menu.appendChild(spanAppendQuestStep);

    container.appendChild(menu);

    function getForm(icon, name, typeNamed, text = null) {
        let formGroup = document.createElement('div');
        formGroup.className = "form-group";

        let iconEl = document.createElement('i');
        iconEl.className = icon;
        formGroup.appendChild(iconEl);

        let input = document.createElement('input');
        input.type = "text";
        input.value = (text !== null) ? text : "";
        if(typeNamed === 'id')
            input.id = name;
        else if(typeNamed === 'class')
            input.className = name;
        else
            throw new Error("invalid argument");

        formGroup.appendChild(input);

        return formGroup;
    }
}

function saveQuestStep(index) {
    console.dir(index);
    let menuNode = document.getElementById('node-popup');
    console.dir(menuNode);

    // Заполняем обновленные данные =>
    let descriptionText,
        arrayAnswerText = [];

    for(let el of menuNode.children) {
        if(el.className === 'form-group') {
            descriptionText = el.children[1].value;
        } else if(el.className === 'group') {
            arrayAnswerText.push(el.children[2].children[1].value);
        }
    }

    // Делаем изменения в Data файле =>
    questConstructor.listQuestStep[index].text = descriptionText;
    questConstructor.listQuestStep[index].answerButtons = [];

    // Делаем измения в самом Node =>
    arrayAnswerText.forEach((el) => {
       questConstructor.createAnswerToQuestStep(index, el);
    });

    let questStep = document.getElementById(`questStep${index}`);
    questStep.children[1].firstChild.innerText = descriptionText;

    menuNode.remove();

    questConstructor.clearQuestStep();
}