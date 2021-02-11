import http from '../http';
import ViewHelper from "./viewHelper";

const ENGINE_URL = `http://localhost:10001/base/play`;
const BACKEND_URL = `http://localhost:5701/play/backend`;

export default class DiceClient {

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
                this.makeRequest().then((data) => {
                    http.requestPost(`${BACKEND_URL}`, JSON.stringify({
                        'status': data.body.status,
                        'result': data.body.result,
                        'matched': data.body.matched
                    }));

                    this.currentStageIndex++;
                    this.lastBets = this.bets;
                    this.bets = [];
                    this.viewHelper.renderStage(1, data.body);
                });
                break;
            case 1:
                this.currentStageIndex = 0;
                this.viewHelper.renderStage(0, [], this.lastBets);
                break;
        }
    }

    makeRequest() {
        return http.requestPost(`${ENGINE_URL}?id=${this.config.gameId}`, this.getRequestParams());
    }

    getRequestParams() {
        return JSON.stringify({
            "gameId": this.config.gameId,
            "client": this.config.client,
            "userId": this.config.userId,
            "mode": this.config.mode,
            "parameters": this.getRoundParameters(),
            "sessionId": window.sessionId
        });
    }

    addBet(number, stake) {
        if (!this.searchBet(number)) {
            this.bets.push({
                'number': number,
                'amount': stake,
                'win': this.calculateBetWin(stake)
            });
        } else {
            this.updateBet(number, stake);
        }

        this.viewHelper.renderBetsList(this.bets, null);
    }

    searchBet(number) {
        for (let bet of this.bets) {
            if (bet.number === number) {
                return bet.stake;
            }
        }

        return false;
    }

    updateBet(number, stake) {
        for (let i = this.bets.length - 1; i >= 0; i--) {
            if (this.bets[i].number === number) {
                if (0 === stake) {
                    this.bets.splice(i, 1);
                } else {
                    this.bets[i].amount = stake;
                    this.bets[i].win = this.calculateBetWin(stake)
                }
            }
        }
    }

    loadLastBets() {
        for (let bet of this.lastBets) {
            this.addBet(bet.number, bet.stake);
        }
        this.viewHelper.renderBetsList(this.bets, null);
    }

    getRoundParameters() {
        return {
            "bets": this.bets
        };
    }

    calculateBetWin(stake) {
        return stake * (this.config.generatorConfig.max - 1);
    }
}