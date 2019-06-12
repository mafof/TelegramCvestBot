function showAddNode() {
    if(document.getElementById('node-popup') !== null) return;
    let container = document.getElementsByClassName('container-node')[0];
    let menu = document.createElement('div');
    menu.className = "node create-node";
    menu.id = "node-popup";

    let spanCloseWindow = document.createElement('span');
    spanCloseWindow.className = "span-close-window";
    spanCloseWindow.onclick = closeWindowNode;
    let icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseWindow.appendChild(icon);
    menu.appendChild(spanCloseWindow);

    let spanDescribeStep = document.createElement('span');
    spanDescribeStep.innerText = "Описание шага";
    menu.appendChild(spanDescribeStep);
    menu.appendChild(getForm('fas fa-file-signature', 'nameQuestStep', 'id'));

    let group = document.createElement('div');
    group.className = "group";

    let spanVarAnswer = document.createElement('span');
    spanVarAnswer.innerText = "Вариант ответа";

    let spanCloseAnswer = document.createElement('span');
    spanCloseAnswer.className = "span-close-window";
    spanCloseAnswer.onclick = removeAnswer.bind(this, spanCloseAnswer);
    icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseAnswer.appendChild(icon);

    group.appendChild(spanCloseAnswer);
    group.appendChild(spanVarAnswer);
    group.appendChild(getForm('fas fa-arrow-circle-right', 'answer-step-input', 'class'));
    menu.appendChild(group);

    let spanAddAnswerQuestStep = document.createElement('span');
    spanAddAnswerQuestStep.innerText = "Добавить вариант ответа";
    spanAddAnswerQuestStep.onclick = addAnswerToNode;
    spanAddAnswerQuestStep.className = "cursor";
    menu.appendChild(spanAddAnswerQuestStep);

    let spanAppendQuestStep = document.createElement('span');
    spanAppendQuestStep.innerText = "Добавить";
    spanAppendQuestStep.className = "span-close-window cursor";
    spanAppendQuestStep.onclick = addQuestStep;
    menu.appendChild(spanAppendQuestStep);

    container.appendChild(menu);

    function getForm(icon, name, typeNamed) {
        let formGroup = document.createElement('div');
        formGroup.className = "form-group";

        let iconEl = document.createElement('i');
        iconEl.className = icon;
        formGroup.appendChild(iconEl);

        let input = document.createElement('input');
        input.type = "text";
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

function closeWindowNode() {
    document.getElementById('node-popup').remove();
}

/**
 * @deprecated
 */
function addAnswerToNode() {
    if(document.getElementById('node-popup') === null) return;
    let group = document.createElement('div');
    group.className = "group";

    let spanVarAnswer = document.createElement('span');
    spanVarAnswer.innerText = "Вариант ответа";

    let spanCloseAnswer = document.createElement('span');
    spanCloseAnswer.className = "span-close-window";
    spanCloseAnswer.onclick = removeAnswer.bind(this, spanCloseAnswer);
    icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseAnswer.appendChild(icon);

    // Создание input поля =>
    let formGroup = document.createElement('div');
    formGroup.className = "form-group";

    let iconEl = document.createElement('i');
    iconEl.className = "fas fa-arrow-circle-right";
    formGroup.appendChild(iconEl);

    let input = document.createElement('input');
    input.type = "text";
    input.className = "answer-step-input";
    formGroup.appendChild(input);

    group.appendChild(spanCloseAnswer);
    group.appendChild(spanVarAnswer);
    group.appendChild(formGroup);

    let node = document.getElementById("node-popup");
    node.insertBefore(group, node.children[node.children.length - 2]);

}

function addQuestStep() {
    let menuNode = document.getElementById('node-popup');
    let questStep = null;
    console.dir(menuNode);

    for(let el of menuNode.children) {
        if(el.className === "form-group") {
            if(questStep === null) {
                questStep = questConstructor.createQuestStep(1, 1, el.children[1].value);
            } else {
                questConstructor.createAnswerToQuestStep(questStep, el.children[1].value);
            }
        } else if(el.className === "group") {
            questConstructor.createAnswerToQuestStep(questStep, el.children[2].children[1].value);
        }
    }
    menuNode.remove();
}

function removeAnswer(element) {
    element.parentNode.remove();
}