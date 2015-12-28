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


    if ($('.phblocks').length > 0) {

        var offset = $(".phblocks").offset();
        //var topPadding = 15;
        $(window).scroll(function () {
            if ($(window).scrollTop() > offset.top) {
                //$(".phblocks").stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});
                $(".phblocks").addClass('link-fix');
            }
            else {
                //$(".phblocks").stop().animate({marginTop: 0});
                $(".phblocks").removeClass('link-fix');
            }
            ;
        });
    }






    if ($('.area-object').length > 0) {

        $('.area-object').hover(function () {

            $(this).children('.object-detalis').show();
        }, function () {
            $(this).children('.object-detalis').hide();
        });

    }


    if ($('.content-container').length > 0) {
        
         
        




        var alphaHeight = $('.content-area').outerHeight();

        var omegaHeight = $('.content-blocks').height();

        if (alphaHeight > omegaHeight) {
            $('.content-blocks').height(alphaHeight + 70);
        }
       // else {
            //$('.content-area').height(omegaHeight);
       // }




    }


    $('.form-close, .overlay').click(function () {
        $('.popup-feedback,  .popup-order, .popup-callback, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });



    $('a.link-order').click(function (e) {
        $('.popup-order, .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });
    $('a.link-feedback').click(function (e) {
        $('.popup-feedback, .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });
    $('a.link-callback').click(function (e) {
        $('.popup-callback, .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });


});





