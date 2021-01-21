import $ from 'jquery';

require('./../../css/slots.css');

$(document).on('click', '#generate', function () {

    $.get("http://localhost:10002/base/play?id=5", {
        bet: 10
    }, function (matrix) {

        let data = matrix.body;
        for (const [indexX, row] of data.result.entries()) {
            for (const [indexY, field] of row.entries()) {
                $('.wheel').eq(indexX).children('.field').eq(indexY)
                    .removeClass().addClass('field symbol-' + field).text(field);
            }
        }
        console.log(data.status);
    });
});