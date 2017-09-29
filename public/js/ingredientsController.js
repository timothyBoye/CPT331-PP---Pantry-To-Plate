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

            $('#select-cuisine-type-filter').val(storageObject.getCuisineType());

            if(w.ingredientsController.selectedIngredients.length > 0){
                makeCall();
            }

            $(document).on('change', '#select-cuisine-type-filter', function(){
                storageObject.setCuisineType($('#select-cuisine-type-filter').find('option:selected').val());
                makeCall();
            })
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
        for(var i = 0; i < ingredientsList.length; i++) {
            displayIngredientsUl.show();
            var listItem = '<li class="li-ingredient-added"><div class="ingredient-img"><button type="button" class="close cross-button" aria-label="Close"><span aria-hidden="true" data-name="' + ingredientsList[i] + '">&times;</span></button></div></div>' + ingredientsList[i] + '</li>';
            $(displayIngredientsUl).append(listItem);
        }

    }

    function makeCall(){
        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients,
                    cuisineType: storageObject.getCuisineType()
                }
            }).done(function(response){
                $('#recipes').html(response.html);

            }).fail(function(response){
                $('#recipes').html(response.responseText);

            });
        }
        else{
            storageObject.setRecipes([]);
        }

    }

    w.ingredientsController.watch();

})(jQuery, window)
