/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function ( ) {

    if ($('.tabs').length > 0) {

        $('.tabs .istab a').hover(function () {


            $(this).parent('.istab').addClass('link-hover');
        }, function () {


            $(this).parent('.istab').removeClass('link-hover');

        });

        $('.tabs .istab a').click(function (event) {
            event.preventDefault();
            var tabId = 'd-' + $(this).attr('id');
            $('.istab').removeClass('link-active');
            $('.tabs .istab a').attr('status', 0);
            $(this).parent('.istab').addClass('link-active');
            $(this).attr('status', 1);

            $('.tab').removeClass('tab-active');
            $('.tab').each(function () {
                if ($(this).attr('id') == tabId) {
                    $(this).addClass('tab-active');
                }
            });

        });
    }

    if (getUrlVars()["opencomment"]) {
        $('.istab').removeClass('link-active');
        $('.tab').removeClass('tab-active');
        $('.tabs .istab a').attr('status', 0);
        $('#t5').parent('.istab').addClass('link-active');
        $('#t5').attr('status', 1);
        $('#d-t5').addClass('tab-active');

    }

});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}


