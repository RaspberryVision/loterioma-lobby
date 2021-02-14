import http from '../http';
import ViewHelper from "./viewHelper";

const BACKEND_URL = `http://localhost:10001/base/session`;

export default class Cashier {

    constructor(gameObject) {
        this.config = gameObject;
        this.viewHelper = new ViewHelper([]);
    }

    payIn() {
        this.makeRequest('pay-in').then((data) => {
            window.sessionId = data.sessionId;
            this.config.sessionId = data.sessionId;
            this.config.amount = data.amount;
            this.viewHelper.updateGameSessionAmount(data.sessionId, data.amount);
        });
    }

    payOut() {
        this.makeRequest('pay-out').then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = data.amount;
            this.viewHelper.updateGameSessionAmount(data.sessionId, data.amount);
        });
    }

    makeRequest(act) {
        return http.requestPost(`${BACKEND_URL}?id=${this.config.gameId}&action=${act}`,
            JSON.stringify({...window.gameConfig, ...{amount: 100}}));
    }
}