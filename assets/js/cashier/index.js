import Cashier from "./cashier";
import $ from 'jquery';

const cashier = new Cashier(window.gameConfig);

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