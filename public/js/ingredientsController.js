/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){
    w.ingredientsController = {
        selectedIngredients: storageObject.getSelectedIngredients(),

        watch: function() {

            // on dropdown click update display + get json
            $('.li-ingredient').on('click', handleIngredientClick);

            // on ingredient close button remove from list
            $('.selected-ingredients-anchor ul').on('click', 'li .cross-button', handleIngredientClick);
            updateDisplay(storageObject.getRecipes());
        }

    };

    function handleIngredientClick(e){
        var ingredientName = $(e.target).attr('data-name');

        if (!w.ingredientsController.selectedIngredients.includes(ingredientName)) {
            w.ingredientsController.selectedIngredients = storageObject.addIngredient(ingredientName);
        }
        else {
            w.ingredientsController.selectedIngredients = storageObject.removeIngredient(ingredientName);
        }
        makeCall();
        updateDisplay(storageObject.getRecipes());
    }

    function updateDisplay(recipes){
        var displayIngredientsUl = $('.selected-ingredients-anchor ul:first');
        displayIngredientsUl.hide();
        storageObject.setRecipes(recipes);
        // clear html containers
        $('.clearable').empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;
        for(var i = 0; i < ingredientsList.length; i++){
            displayIngredientsUl.show();
            var listItem = '<li class="li-ingredient-added">' + ingredientsList[i] + '<button type="button" class="close cross-button" aria-label="Close"><span aria-hidden="true" data-name="' + ingredientsList[i] + '">&times;</span></button></li>';
            $(displayIngredientsUl).append(listItem);
        }

        if(recipes !== undefined && recipes !== null){
            $.each(recipes, function(k, v){
                $.each(v, function(key, value){
                    $('#recipes').append(
                        '<div class="col-lg-3 col-md-6 col-sm-12">'
                        +'<div class="recipe-container">'
                        +'<div class="recipe-image">'
                        +'</div>'
                        +'<a href="recipe/'+value.id+'">'
                        +'<div class="recipe-text">'
                        +'<h4>' + value.name + '</h4>'
                        +'</a>'
                        +'<q>'+ value.short_description +'</q>'
                        +'</div>'
                        +'</div>'
                    );
                })
            })
        }

    }

    function makeCall(){
        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients
                }
            }).done(function(response){
                updateDisplay(response.recipes);
            }).fail(function(response){
                console.log(response);
            });
        }
        else{
            storageObject.setRecipes([]);
        }

    }

    w.ingredientsController.watch();

})(jQuery, window)
