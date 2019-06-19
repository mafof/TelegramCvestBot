/**
 * Показывает popup меню добавления Node
 */
function showPopupAddNode() {
    if(document.getElementById('node-popup') !== null) return;
    let container = document.getElementsByClassName('container-node')[0];
    let menu = getGeneralPopupMenu(null, 'added');
    container.appendChild(menu);
}

/**
 * Создает форму с input полем текста
 * @param icon - название иконки
 * @param identification - индентификатор
 * @param typeName - id/class
 * @param text - текст внутри формы
 */
function getForm(icon, identification, typeName, text = null) {
    let formGroup = document.createElement('div');
    formGroup.className = "form-group";

    let iconEl = document.createElement('i');
    iconEl.className = icon;
    formGroup.appendChild(iconEl);

    let input = document.createElement('input');
    input.type = "text";
    input.value = (text !== null) ? text : "";
    if(typeName === 'id')
        input.id = identification;
    else if(typeName === 'class')
        input.className = identification;
    else
        throw new Error("invalid argument");

    formGroup.appendChild(input);

    return formGroup;
}

/**
 * Добавляет в popup меню вариант ответа
 */
function addQuestStep() {
    if(document.getElementById('node-popup') === null) return;
    let answers = document.getElementsByClassName('answer-main-form');
    if(answers.length !== 0) {
        let idQuest = questConstructor.createQuestNode(document.getElementById('nameQuestStep').value, 1, 1);
        for(let answer of answers) {
            questConstructor.createQuestAnswer(answer.lastChild.lastChild.value, idQuest);
        }
    }
    document.getElementById('node-popup').remove();
}