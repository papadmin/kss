/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function ( ) {
    
    if ($('#site').length > 0) {
        var PageHeight = $(window).height();
        var HeaderHeight = $('#header').height();
        var FooterHeight = $('#footer').height();
        var SiteHeight = PageHeight - HeaderHeight - FooterHeight;
        $('#site').css('min-height', SiteHeight);
    }
    
    if ($('.request').length > 0) {
        $('.request').hover(function () {

            $(this).children('.request-round').css('background-color', '#0B4A81');
        }, function () {
            $(this).children('.request-round').css('background-color', '#007AC2');
        });
    }

   



});


