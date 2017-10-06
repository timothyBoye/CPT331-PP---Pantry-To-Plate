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

            // this was causing the flash on a cleared session- need to check if value exists before setting select menu
            if(storageObject.getCuisineType()) {
                $('#select-cuisine-type-filter').val(storageObject.getCuisineType());
            }

            if(w.ingredientsController.selectedIngredients.length > 0){
                makeCall();
            } else {
                $('.intro-message').show();
            }

            $(document).on('change', '#select-cuisine-type-filter', function(){
                storageObject.setCuisineType($('#select-cuisine-type-filter').find('option:selected').val());
                makeCall();
            });

            $('#cuisine-preference-checkbox').change(function(){
                storageObject.setCuisinePreferenceCheckStatus($('#cuisine-preference-checkbox').is(':checked'));
                makeCall();
            });

            initCuisinePreferenceCheckbox();

        }

    };

    function initCuisinePreferenceCheckbox(){
        var checked = storageObject.getCuisinePreferenceCheckStatus();
        $('#cuisine-preference-checkbox').prop('checked', checked);
    }

    function handleIngredientClick(e){
        var ingredientName = $(e.target).attr('data-name');
        var ingredientID = $(e.target).attr('data-id');
        var ingredientImage = $(e.target).attr('data-image');


        if (storageObject.find(w.ingredientsController.selectedIngredients, ingredientID, 'id') < 0 ) {
            w.ingredientsController.selectedIngredients = storageObject.addIngredient(ingredientID, ingredientName, ingredientImage);

        }
        else {
            w.ingredientsController.selectedIngredients = storageObject.removeIngredient(ingredientID);
        }
            makeCall();
            updateDisplay(storageObject.getRecipes());

            if(w.ingredientsController.selectedIngredients.length === 0) {
                $('.intro-message').show();
            } else {
                $('.intro-message').hide();
            }


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
            var listItem = '<li class="li-ingredient-added"><div class="ingredient-img" style="background-image:url(img/ingredients/'+ingredientsList[i].image_url+')"><button type="button" class="close cross-button" aria-label="Close"><span aria-hidden="true" data-name="' + ingredientsList[i].name + '" data-id="' + ingredientsList[i].id + '" data-image="' + ingredientsList[i].image_url + '">&times;</span></button></div></div>' + ingredientsList[i].name + '</li>';
            $(displayIngredientsUl).append(listItem);
        }


    }

    function makeCall(){


        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            var cuisineType = storageObject.getCuisineType();
            var cuisinePreference = storageObject.getCuisinePreferenceCheckStatus();
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients,
                    cuisineType: cuisineType,
                    cuisinePreference: cuisinePreference
                }
            }).done(function(response){
                $('#recipes').html(response.html);
                console.log(response);
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
