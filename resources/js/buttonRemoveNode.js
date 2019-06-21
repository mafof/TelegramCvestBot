function removeNodeQuest() {
    if(questConstructor.dbclickQuestStep === null) return;
    let questStepId = questConstructor.dbclickQuestStep;

    // Удаление связей =>
    let binds = document.querySelectorAll(`.link[toQuestStepId="${questStepId}"]`);
    for(let el of binds) { el.remove(); }

    let listAnswerElement = document.querySelectorAll(`#questStep${questStepId} .answerButton`);
    for(let answerButton of listAnswerElement) {
        let binds = document.querySelectorAll(`.link[answerButton="${answerButton.id}"]`);
        for(let el of binds) { el.remove(); }
    }

    // Очищаем выборку =>
    questConstructor.clearSelectedQuestStep();

    // Удаляем сам элемент =>
    document.getElementById(`questStep${questStepId}`).remove();
}