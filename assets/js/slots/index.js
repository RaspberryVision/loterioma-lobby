import $ from "jquery";
import SlotsClient from "../slots/slots";

const gameClient = new SlotsClient(window.gameConfig, window.gameDOMHandlers);

$(document).on('click', `#game-next-action`, function () {
    gameClient.next();
});