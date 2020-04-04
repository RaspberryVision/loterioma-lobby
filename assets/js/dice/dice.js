import http from '../http';

const ENGINE_URL = `http://localhost:9902/index.php/play/dice`;

export default class DiceClient {

    constructor(gameObject) {
        this.config = gameObject;
    }

    play() {
        this.makeRequest();
    }

    makeRequest() {

        alert('lece z requestem');
        let response = http.requestGet(`${ENGINE_URL}/${this.config.gameId}`, []);

        console.log(response);
    }
}

