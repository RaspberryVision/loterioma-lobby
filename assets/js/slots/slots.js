import $ from 'jquery';
import http from '../http';
import ViewHelper from "../dice/viewHelper";

require('./../../css/slots.css');

export default class SlotsClient {

    constructor(gameObject, DOMHandlers) {
        this.config = gameObject;
        this.viewHelper = new ViewHelper(DOMHandlers);
        this.currentStageIndex = 0;
        this.bets = [];
        this.lastBets = null;
    }

    next() {
        if (!window.sessionId) {
            console.log('No session defined');
            return false;
        }

        switch (this.currentStageIndex) {
            case 0:
                this.makeRequest().then((matrix) => {
                    let data = matrix.body;
                    for (const [indexX, row] of data.result.entries()) {
                        for (const [indexY, field] of row.entries()) {
                            $('.slots-row').eq(indexX).children('.field').eq(indexY)
                                .removeClass().addClass('field symbol-' + field).text(field);
                        }
                    }

                    if (data.status === 2) {
                        $('.slots-machine-status').text('WIN');

                        for (const [indexX, row] of data.wonCombinations.entries()) {
                            for (const [indexY, field] of row.fields.entries()) {
                                $('.slots-row').eq(indexX).children('.field').eq(indexY).addClass('won');
                            }
                        }
                    } else {
                        $('.slots-machine-status').text('LOST');
                    }

                    console.log(data);

                    $('#game-session-id').text(data.sessionId);
                    $('#game-session-amount').text(data.amount);

                });
                break;
            case 1:
                this.currentStageIndex = 0;
                this.viewHelper.renderStage(0, [], this.lastBets);
                break;
        }
    }

    makeRequest() {
        return http.requestPost(`http://localhost:10002/base/play?id=${this.config.gameId}`, this.getRequestParams());
    }

    getRequestParams() {
        return JSON.stringify({
            "gameId": this.config.gameId,
            "client": this.config.client,
            "userId": this.config.userId,
            "mode": this.config.mode,
            "parameters": {
                "bet" : 10
            },
            "sessionId": window.sessionId
        });
    }
}