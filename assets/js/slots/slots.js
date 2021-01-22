import $ from 'jquery';

require('./../../css/slots.css');

$(document).on('click', '#generate', function () {

    $.ajax("http://localhost:10002/base/play?id=5", {
        bet: 10
    }).done(function (matrix) {
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
    }).fail(function () {
        alert('Error during play');
    });

});