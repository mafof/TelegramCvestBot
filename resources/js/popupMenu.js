/**
 * Создает общее popup menu
 * @param {string} typeAddedButton - тип кнопки добавления/обновления Node блока
 * @return {Node} popup окно для дальнейшего пуша в DOM
 */
function getGeneralPopupMenu(text = null, typeAddedButton = 'added') {
    // Главный блок =>
    let menu = document.createElement('div');
    menu.className = "node create-node";
    menu.id = "node-popup";

    // блок описание шага =>
    let group = document.createElement('div');
    group.className = "group describe";
    group.id = "describe";

    // блок кнопок =>
    let buttonMain = document.createElement('div');
    buttonMain.className = "group buttons-main";
    buttonMain.id = "buttonsMain";

    let spanCloseWindow = document.createElement('span');
    spanCloseWindow.className = "span-close-window";
    spanCloseWindow.onclick = closePopup;
    let icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseWindow.appendChild(icon);
    group.appendChild(spanCloseWindow);

    let spanDescribeStep = document.createElement('span');
    spanDescribeStep.innerText = "Описание шага";
    group.appendChild(spanDescribeStep);
    group.appendChild(getForm('fas fa-file-signature', 'nameQuestStep', 'id', text));

    let spanAddAnswerQuestStep = document.createElement('span');
    spanAddAnswerQuestStep.innerText = "Добавить вариант ответа";
    spanAddAnswerQuestStep.onclick = addAnswerToNode.bind(this, null, null);
    spanAddAnswerQuestStep.className = "cursor";
    buttonMain.appendChild(spanAddAnswerQuestStep);

    let spanAppendQuestStep = document.createElement('span');
    spanAppendQuestStep.className = "span-close-window cursor";

    if(typeAddedButton === 'added') {
        spanAppendQuestStep.innerText = "Добавить";
        spanAppendQuestStep.onclick = addQuestStep;
    } else if(typeAddedButton === 'update') {
        spanAppendQuestStep.innerText = "Обновить";
        spanAppendQuestStep.onclick = updateQuestStep;
    }
    buttonMain.appendChild(spanAppendQuestStep);

    menu.appendChild(group);
    menu.appendChild(buttonMain);

    return menu;
}

/**
 * Внедряет в поле конструктора Node со всеми параметрами
 * @param {string} text - Текст в input поле
 * @param {string} id - ID созданной кнопки(если есть)
 */
function addAnswerToNode(text = null, id = null) {
    if(document.getElementById('node-popup') === null) return;
    let group = document.createElement('div');
    group.className = "group answer-main-form";
    if(id !== null) group.idAnswer = id;

    let spanVarAnswer = document.createElement('span');
    spanVarAnswer.innerText = "Вариант ответа";

    let spanCloseAnswer = document.createElement('span');
    spanCloseAnswer.className = "span-close-window";
    spanCloseAnswer.onclick = removeAnswer.bind(this, group);
    icon = document.createElement('i');
    icon.className = "far fa-times-circle";
    spanCloseAnswer.appendChild(icon);

    // Создание input поля =>
    let formGroup = document.createElement('div');
    formGroup.className = "form-group";

    group.appendChild(spanCloseAnswer);
    group.appendChild(spanVarAnswer);
    group.appendChild(getForm("fas fa-arrow-circle-right", "answer-step-input", "class", text));

    let node = document.getElementById("node-popup");
    node.insertBefore(group, document.getElementById("buttonsMain"));
}

/**
 * Закрывает меню
 */
function closePopup() { document.getElementById('node-popup').remove(); }

/**
 * Удалить вариант ответа у popup меню + удалить зависимости от Node
 * @param {Node} element - элемент который надо удалить
 */
function removeAnswer(element) {
    if(element.idAnswer !== null || element.idAnswer !== "" || element.idAnswer !== undefined) {
        arrayIdAnswerRemove.push(element.idAnswer.match(/([0-9]){1,100}/gm)[0]);
    }
    element.remove();
}