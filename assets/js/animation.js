
         $(document).ready(function(){
              $('#arrow').click(function(){
                   if ($('#arrowIcon').hasClass('down')) {
                    $('#arrowIcon').removeClass('down');
                    $('#arrowIcon').addClass('up');
                   }else{
                    $('#arrowIcon').removeClass('up');
                    $('#arrowIcon').addClass('down');
                   }
                  
              })
              $('.nav-link').css('color','white');


              $('.nav-text').click(function(){
                   if ($(this).parent().hasClass('dropdown')) {
                    $(this).parent().removeClass('dropdown');
                    $(this).parent().addClass('dropup');
                   } else {
                    $(this).parent().removeClass('dropup');
                    $(this).parent().addClass('dropdown');
                   }
                   $(this).parent().children('div').children('ul').slideToggle();
              })
          })
