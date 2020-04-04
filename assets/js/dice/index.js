import DiceClient from './dice.js';
import $ from 'jquery';
require('./../../css/dice.css');

const gameClient = new DiceClient(window.gameConfig, window.gameDOMHandlers);

$(document).on('click', '#play', function () {
    gameClient.play();
});

