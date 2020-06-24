import DiceClient from './dice.js';
import $ from 'jquery';

const gameClient = new DiceClient(window.gameConfig);

$(document).on('click', '#play', function () {
    gameClient.play();
});

