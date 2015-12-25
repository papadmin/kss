/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

  



    if ($('#directories').length > 0) {

        $('#directories ul li ul').attr('status', 0);    // Всем пунктам меню присваевается неактивный (свернутый) статус

        $('#directories ul li a').click(
                function (event) {

                    if ($(this).parent().children('ul').attr('status') == 0) {  // Если пункт свернут
                        event.preventDefault();

                        $('#directories ul li a.angle-link').children('.fa').removeClass('fa-angle-up'); // У всех пунктов меняется изображение стрелки - вниз
                        $('#directories ul li a.angle-link').children('.fa').addClass('fa-angle-down');

                        //$('#directories li.level_1').css('background-color', '#ffffff'); // У всех пунктов меняется цвет фона на изначальный
                        $('#directories li.level_1').css('border-bottom', '1px solid #E2E2E2'); // У всех пунктов добавляется нижняя рамка
                        $('#directories li.level_1:last-child').css('border-bottom', 'none'); // но у крайнего она убирается
                        
                        $('#directories li.level_1').css('border-top', 'none'); 
                        $('#directories ul li ul').css('border-top', 'none'); 

                        $(this).children('.fa').removeClass('fa-angle-down'); // У пункта, на который кликнули изображение стрелки становится -  вверх
                        $(this).children('.fa').addClass('fa-angle-up');
                        
                        $(this).next('ul').css('border-top', 'none');
                        $(this).parent('li').css('border-top', '1px solid #E2E2E2');
                        $(this).parent('li').next('li').css('border-top', '1px solid #E2E2E2');

                        $(this).parent().css('border-bottom', 'none'); // Убирается нижняя рамка у пункта
                        $(this).parent().prev('li').css('border-bottom', 'none'); // Убирается нижняя рамка у предыдущего пункта
                        //$(this).parent().css('background-color', '#F5F5F5'); // У пункта меняется цвет фона

                        clearTimeout($.data(this, 'timer'));
                        $('#directories ul li ul:visible').slideUp(100); // Все развернутые пункты сворачиваются и им присваивается неактивный статус
                        $('#directories ul li ul:visible').attr('status', 0);
                        $('#directories ul li ul li ul:visible').attr('status', 2);


                        $(this).parent().children('ul').slideDown(100); // А вот пункт, на который кликнули, разворачивается 
                        //$(this).parent().children('ul').children('li').each(function () { // и разворачиваются все его
                        //$(this).children('ul').slideDown(100); // дочерние пункты
                        // });
                        $(this).parent().children('ul').attr('status', 1); // потом ему присваивается активный (развернутый) статус

                    }


                    else if ($(this).parent().children('ul').attr('status') == 1) {
                        event.preventDefault();

                        $(this).children('.fa').removeClass('fa-angle-up');
                        $(this).children('.fa').addClass('fa-angle-down');


                        //$(this).parent().css('background-color', '#ffffff');

                        $.data(this, 'timer', setTimeout($.proxy(function () {
                            $('#directories ul li ul:visible').slideUp(100);
                        }, this), 100));

                        $(this).parent().css('border-bottom', '1px solid #E2E2E2');
                        $(this).parent().prev('li').css('border-bottom', '1px solid #E2E2E2');
                        
                        $(this).next('ul').css('border-top', '1px solid #E2E2E2');
                        $(this).parent('li').css('border-top', 'none');
                        $(this).parent('li').next('li').css('border-top', 'none');

                        $('#directories ul li ul:visible').attr('status', 0);
                        $('#directories ul li ul li ul:visible').attr('status', 2);

                    }

                });

        




    }




});


