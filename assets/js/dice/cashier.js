import http from '../http';

const BACKEND_URL = `http://localhost:5701/play/cashier`;

export default class Cashier {

    constructor(gameObject) {
        this.config = gameObject;
    }

    payIn() {
        this.makeRequest('pay-in').then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = data.amount;
        });
    }

    payOut() {
        this.makeRequest('pay-out').then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = 0;
        });
    }

    makeRequest(act) {
        return http.requestPost(`${BACKEND_URL}/${this.config.gameId}?action=${act}`, JSON.stringify({}));
    }
}