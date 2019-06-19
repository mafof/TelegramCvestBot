function showPopupEditNode() {
    if(document.getElementById('node-popup') !== null || questConstructor.dbclickQuestStep === null) return;
    let container = document.getElementsByClassName('container-node')[0];
    let selectedQuestStepDescription = document.getElementById(`questStepShellMain${questConstructor.dbclickQuestStep}`).lastChild.lastChild.innerText;
    let menu = getGeneralPopupMenu(selectedQuestStepDescription, 'update');
    container.appendChild(menu);
    for(let el of document.querySelectorAll(`#questStep${questConstructor.dbclickQuestStep} .answerButton`)) {
        addAnswerToNode(el.lastChild.lastChild.innerText, el.id);
    }
}

function updateQuestStep() {
    if(document.getElementById('node-popup') === null) return;
    let questStepEl = document.getElementById(`questStepShellMain${questConstructor.dbclickQuestStep}`);
    let describeText = document.getElementById('describe').lastChild.lastChild.value;

    // Устаанвливаем description =>
    questStepEl.lastChild.lastChild.innerText = describeText;

    // Удаляет связи и Node ответы =>
    arrayIdAnswerRemove.forEach(el => {
        document.getElementById(`answerButton${el}`).remove(); // Удаляем Node ответа
        // Удалим все path link =>
        for(let bind of document.querySelectorAll(`.link[answerButton=answerButton${el}]`)) {
            bind.remove();
        }
    });
    arrayIdAnswerRemove = [];

    // Проходимся по всем кнопкам =>
    let answerInputElements = document.getElementsByClassName('answer-main-form');
    for(let el of answerInputElements) {
        let answerButtonElement = document.getElementById(el.idAnswer);
        if(answerButtonElement !== null) {
            answerButtonElement.lastChild.lastChild.innerText = el.lastChild.lastChild.value;
        } else {
            questConstructor.createQuestAnswer(el.lastChild.lastChild.value, questConstructor.dbclickQuestStep);
        }
    }
    updateCoordY(questConstructor.dbclickQuestStep);

    questConstructor.clearSelectedQuestStep();
    document.getElementById('node-popup').remove();
}

/**
 * Меняет все координаты Y в определенном Node квеста
 * @param {number} idQuest - ID Node квеста
 */
function updateCoordY(idQuest) {
    let y = 71;
    let index = 0;

    let elementsAnswer = document.querySelectorAll(`#questStep${idQuest} .answerButton`);
    for(let el of elementsAnswer) {
        let yd = y + (51 * index);
        el.setAttribute('y', yd);
        el.y = yd;
        el.firstChild.setAttribute('y', yd);
        el.firstChild.y = yd;
        el.lastChild.setAttribute('y', yd);
        el.lastChild.y = yd;
        index++;
    }
}