import http from '../http';

const ENGINE_URL = `http://localhost:9902/index.php/dice/play`;

export default class DiceClient {

    constructor(gameObject) {
        this.config = gameObject;
    }

    play() {
        this.makeRequest();
    }

    makeRequest() {
        let response = http.requestPost(`${ENGINE_URL}/${this.config.gameId}`, this.getRequestParams());

        console.log(response);
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
}

