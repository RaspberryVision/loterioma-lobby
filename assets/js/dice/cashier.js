import http from '../http';

const BACKEND_URL = `http://localhost:5701/play/cashier`;

export default class Cashier {

    constructor(gameObject) {
        this.config = gameObject;
    }

    payIn() {
        this.makeRequest().then((data) => {
            this.config.sessionId = data.sessionId;
            this.config.amount = data.amount;
        });
    }

    payOut() {
        this.makeRequest().then((data) => {
            this.config.sessionId = null;
            this.config.amount = 0;
        });
    }

    makeRequest() {
        return http.requestPost(`${BACKEND_URL}`, JSON.stringify({}));
    }
}