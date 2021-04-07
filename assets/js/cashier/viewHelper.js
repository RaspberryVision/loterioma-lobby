export default class ViewHelper {

    constructor(DOMHandlers) {
        this.DOMHandlers = DOMHandlers;
    }

    updateGameSessionAmount(sessionId, newValue, wallet) {
        this.getDOMElementById('app-wallet-amount').then(function (gameSessionElement) {
            gameSessionElement.innerText = wallet;
        });
        this.getDOMElementById('game-session-id').then(function (gameSessionElement) {
            gameSessionElement.innerText = sessionId;
        });
        this.getDOMElementById('game-session-amount').then(function (gameSessionElement) {
            gameSessionElement.innerText = newValue;
        });
    }

    getPayInAmount() {
        return this.getDOMElementById('game-pay-in-amount').then(function (element) {
            return element.value;
        })
    }

    async getDOMElementById(selector) {
        return document.getElementById(selector);
    }

    async getDOMElementByQuerySelector(querySelector) {
        return document.querySelector(querySelector);
    }
}

