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
            $(this).parent('.istab').addClass('link-active');

            $('.tab').removeClass('tab-active');
            $('.tab').each(function () {
                if ($(this).attr('id') == tabId) {
                    $(this).addClass('tab-active');
                }
            });

        });
    }



});


