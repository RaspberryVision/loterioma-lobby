import http from '../http';

const ENGINE_URL = `http://localhost:9902/index.php/dice/play`;

export default class DiceClient {

    constructor(gameObject, DOMHandlers) {
        this.config = gameObject;
        this.DOMHandlers = DOMHandlers;
    }

    play() {
        this.makeRequest().then((data) => {
            console.log(data);
            this.updateScreen(data);
        });
    }

    makeRequest() {
        return http.requestPost(`${ENGINE_URL}/${this.config.gameId}`, this.getRequestParams());
    }

    updateScreen(data) {
        this.getDOMElement(this.DOMHandlers.result).innerText = data.result;
    }

    getRequestParams() {
        return JSON.stringify({
            "gameId": this.config.gameId,
            "client": this.config.client,
            "userId": this.config.userId,
            "mode": this.config.mode,
            "parameters": this.getRoundParameters()
        });
    }

    getRoundParameters() {
        return {
            "bets":
                [
                    {
                        "number": 1,
                        "stake": 10,
                    }
                ]
        };
    }

    getDOMElement(selector) {
        return document.getElementById(selector);
    }
}

