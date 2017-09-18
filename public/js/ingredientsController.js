/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){
    w.ingredientsController = {
        selectedIngredients: [],

        watch: function() {

            // on dropdown click update display + get json
            $('.li-ingredient').on('click', handleIngredientClick);

            // on ingredient close button remove from list
            $('.selected-ingredients-anchor ul').on('click', 'li .cross-button', handleIngredientClick);

        }

    };

    function handleIngredientClick(e){
        var ingredientName = $(e.target).attr('data-name');

        if (!w.ingredientsController.selectedIngredients.includes(ingredientName)) {
            addIngredient(ingredientName);
        }
        else {
            removeIngredient(ingredientName);
        }
        updateDisplay();
    }

    function addIngredient(ingredientName){
        w.ingredientsController.selectedIngredients.push(ingredientName);
    };

    function removeIngredient(ingredientName){
        var index = w.ingredientsController.selectedIngredients.indexOf(ingredientName);
        if(index >= 0){
            w.ingredientsController.selectedIngredients.splice(index, 1);
        }
    };

    function updateDisplay(){
        var displayIngredientsUl = $('.selected-ingredients-anchor ul:first');

        // clear html containers
        $('.clearable').empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;
        for(var i = 0; i < ingredientsList.length; i++){
            var listItem = '<li class="li-ingredient">' + ingredientsList[i] + '<button type="button" class="close cross-button" aria-label="Close"><span aria-hidden="true" data-name="' + ingredientsList[i] + '">&times;</span></button></li>';
            $(displayIngredientsUl).append(listItem);
        }

        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients
                }
            }).done(function(response){
                    $.each(response.recipes, function(k, v){
                        $.each(v, function(key, value){
                            $('.recipes').append(
                                '<div class="col-md-3">'
                                +'<a href="recipe/'+value.id+'">'
                                +'<h4>' + value.name + '</h4>'
                                +'</a>'
                                +'</div>'
                            );
                        })
                    })
            }).fail(function(response){
                console.log(response);
            });
        }

    }

    w.ingredientsController.watch();

})(jQuery, window)
