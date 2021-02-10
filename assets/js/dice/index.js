import DiceClient from './dice.js';
import Cashier from "./cashier";
import $ from 'jquery';

require('./../../css/dice.css');

const gameClient = new DiceClient(window.gameConfig, window.gameDOMHandlers);
const cashier = new Cashier(window.gameConfig);

$(document).on('click', `#${gameClient.viewHelper.DOMHandlers.nextAction}`, function () {
    gameClient.next();
});

$(document).on('click', `#${gameClient.viewHelper.DOMHandlers.numbersList} li`, function (event) {
    if (gameClient.currentStageIndex !== 0) {
        return;
    }

    let value = "5";
    if ($(event.currentTarget).hasClass('bet')) {
        value = gameClient.searchBet($(event.currentTarget).data('number'));
    }

    let stake = Number.parseInt(prompt("Please enter stake:", value));
    if (isNaN(stake)) {
        alert('Wrong stake format!');
        return;
    }

    gameClient.addBet(
        $(event.currentTarget).data('number'),
        stake
    );

    if (stake > 0 && !$(event.currentTarget).hasClass('bet')) {
        $(event.currentTarget).addClass('bet');
    } else {
        $(event.currentTarget).removeClass('bet');
    }
});

$(document).on('click', `#${gameClient.viewHelper.DOMHandlers.lastBets}`, function () {
    gameClient.loadLastBets();
});

$(document).on('click', `#game-pay-in-action`, function () {
    console.log('PayIn Request Start')
    cashier.payIn();
    console.log('PayIn Request End')
});

$(document).on('click', `#game-pay-out-action`, function () {
    console.log('PayOut Request Start')
    cashier.payOut();
    console.log('PayOut Request End')
});





