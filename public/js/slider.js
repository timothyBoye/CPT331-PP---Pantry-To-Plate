$(document).ready(function(){
    $('.next').on('click',function(){
        var currentRecipe = $('.active');
        var nextRecipe = currentRecipe.next();

        if(nextRecipe.length == 0) {
            nextRecipe = $('.slider-inner .item:first');
        }
        currentRecipe.removeClass('active').css('z-index, -1');
        nextRecipe.addClass('active').css('z-index, 1');
    });
    $('.prev').on('click',function(){
        var currentRecipe = $('.active');
        var prevRecipe = currentRecipe.prev();

        if(prevRecipe.length == 0) {
            prevRecipe = $('.slider-inner .item:last');
        }
        currentRecipe.removeClass('active').css('z-index, -1');
        prevRecipe.addClass('active').css('z-index, 1');
    });
});
