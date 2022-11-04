$(function(){
    
    $('.modulo-single').hover(function(){
        $('.modulo-single').css('background-color','#3c898b');
        $(this).css('background-color','#3e9194');
    })

    $('.apresentacao-wrap').hover(function(){
        $('.modulo-single p a').css('background-color','#3c898b');
        $('.modulo-single p a').css('color','black');
    })

    $('.modulos-h2').hover(function(){
        $('.modulo-single p a').css('background-color','#3c898b');
        $('.modulo-single p a').css('color','black');
    })
    $('.modulo-single').hover(function(){
        $('.modulo-single p a').css('background-color','#3c898b');
        $('.modulo-single p a').css('color','black');
    })

    $('.modulo-single p a').hover(function(){
        $('.modulo-single p a').css('color','black');
        $('.modulo-single p a').css('background-color','#3c898b');
        $('.modulo-single p a').css('cursor','pointer');
        $(this).css('color','white');
        $(this).css('background-color','#11a2a5');
    })
});