import http from '../http';
import ViewHelper from "./viewHelper";

const BACKEND_URL = `http://localhost:5701/play/cashier`;

export default class Cashier {

    constructor(gameObject) {
        this.config = gameObject;
        this.viewHelper = new ViewHelper([]);
    }

    payIn() {
        this.makeRequest('pay-in').then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = data.amount;
            this.viewHelper.updateGameSessionAmount(data.amount);
        });
    }

    payOut() {
        this.makeRequest('pay-out').then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = 0;
            this.viewHelper.updateGameSessionAmount(0);
        });
    }

    makeRequest(act) {
        return http.requestPost(`${BACKEND_URL}/${this.config.gameId}?action=${act}`, JSON.stringify({}));
    }
}