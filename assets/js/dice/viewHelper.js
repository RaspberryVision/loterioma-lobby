export default class ViewHelper {

    constructor(DOMHandlers) {
        this.DOMHandlers = DOMHandlers;
    }

    renderStage(stage, currentRound, lastRoundBets = null) {
        switch (stage) {
            case 0:
                this.renderBetsList(currentRound.bets, lastRoundBets);
                this.clearParameterNumbers();
                this.updateNextButton('Set bets and play!');
                break;
            case 1:
                this.renderResult(currentRound);
                this.markWinNumber(currentRound.status, currentRound.result[0][0]);
                this.markBetsList(currentRound.result[0][0]);
                this.updateNextButton('Next round!');
                break;
        }
    }

    renderBetsList(list, lastBetsList = null) {
        this.getDOMElementById(this.DOMHandlers.betsList).then((listDOMElement) => {
            listDOMElement.innerText = '';

            if (lastBetsList != null) {
                let repeatLastBetsElement = document.createElement('li');
                repeatLastBetsElement.innerHTML = `<div class='btn' id="${this.DOMHandlers.lastBets}">Repeat last bets (${lastBetsList.length})`;
                listDOMElement.appendChild(repeatLastBetsElement);
            }

            let sumOfStakes = 0;
            for (let i = 0; i < list.length; i++) {
                sumOfStakes+= list[i].stake;
                let element = document.createElement('li');
                element.setAttribute('data-number', list[i].number);
                element.innerHTML = this.renderBetElement(i, list[i].number, list[i].stake, list[i].win)
                listDOMElement.appendChild(element);
            }

            this.renderBetsCost(sumOfStakes);
        });
    }

    renderBetElement(id, number, stake, win) {
        return `${id + 1}. No <b>${number}</b> stake <b>${stake}</b>, to win - ${win}`
    }

    renderResult(data) {
        this.getDOMElementById(this.DOMHandlers.result).then(function (resultDOMElement) {
            switch (data.status) {
                default:
                case 0:
                    resultDOMElement.innerHTML = `<h1>Set bets and</h1><p class='winning'>Start :)</p>`;
                    break;
                case 1:
                    resultDOMElement.innerHTML = `<h1 class="loss-number">${data.result[0][0]}</h1><p class='winning'>Lost!</p>`;
                    break;
                case 2:
                    resultDOMElement.innerHTML = `<h1 class="win-number">${data.result[0][0]}</h1><p class='winning'>Win!</p><p class='amount'>44</p>`;
                    break;
            }
        });
    }

    renderBetsCost(sumOfBetsRates) {
        this.getDOMElementByQuerySelector(`#${this.DOMHandlers.betsCost}`).then(function (winNumberElement) {
            winNumberElement.innerText = sumOfBetsRates + ' ₭C' ;
        });
    }

    markWinNumber(status, winNumber) {
        this.getDOMElementByQuerySelector(`#${this.DOMHandlers.numbersList} [data-number="${winNumber}"]`).then(function (winNumberElement) {
            if (status === 2) {
                winNumberElement.classList.add('win');
            } else {
                winNumberElement.classList.add('lost');
            }
        });
    }

    markBetsList(winNumber) {
        this.getDOMElementById(this.DOMHandlers.betsList).then(function (betsListElement) {
            let children = betsListElement.children;
            for (let i = 0; i < children.length; i++) {
                if (children[i].getAttribute('data-number') !== null &&
                    children[i].getAttribute('data-number') === winNumber) {

                    children[i].classList.add('win-bet');
                } else {
                    children[i].classList.add('loss-bet');
                }
            }
        });
    }

    updateNextButton(caption) {
        this.getDOMElementById(this.DOMHandlers.nextAction).then((nextActionButtonElement) => {
            nextActionButtonElement.innerText = caption;
        });
    }

    clearParameterNumbers() {
        this.getDOMElementByQuerySelector(`#${this.DOMHandlers.numbersList}`).then(function (numbersListElement) {
            let children = numbersListElement.children;
            for (let i = 0; i < children.length; i++) {
                children[i].classList.remove('last-win');
                if (children[i].classList.contains('win')) {
                    children[i].classList.remove('win');
                    children[i].classList.add('last-win');
                }

                children[i].classList.remove('last-lost');
                if (children[i].classList.contains('lost')) {
                    children[i].classList.remove('lost');
                    children[i].classList.add('last-lost');
                }

                children[i].classList.remove('bet');
            }
        });
    }

    async getDOMElementById(selector) {
        return document.getElementById(selector);
    }

    async getDOMElementByQuerySelector(querySelector) {
        return document.querySelector(querySelector);
    }
}

