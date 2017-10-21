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

            if(storageObject.getRatingFilterValue()) {
                $('#select-rating-type-filter').val(storageObject.getRatingFilterValue());
            }

            if(storageObject.getIngredientsFilterValue()) {
                $('#select-ingredient_filter_value').val(storageObject.getIngredientsFilterValue());
            }

            if(storageObject.getIngredientsNeededFilterValue()) {
                $('#select-ingredients_needed_filter_value').val(storageObject.getIngredientsNeededFilterValue());
            }

            // displays recipes for any ingredients in local storage when page loads
            if(w.ingredientsController.selectedIngredients.length > 0){
                makeCall();
            } else {
                $('.intro-message').show();
            }

            // update filter values and call function to send values to controller
            $(document).on('change', '#select-cuisine-type-filter', function(){
                storageObject.setCuisineType($('#select-cuisine-type-filter').find('option:selected').val());
                makeCall();
            });

            $(document).on('change', '#select-rating-type-filter', function(){
                storageObject.setRatingFilter($('#select-rating-type-filter').find('option:selected').val());
                makeCall();
            });

            $(document).on('change', '#select-ingredient_filter_value', function(){
                storageObject.setIngredientsFilter(($('#select-ingredient_filter_value').find('option:selected').val()));
                makeCall();
            });

            $(document).on('change', '#select-ingredients_needed_filter_value', function(){
                storageObject.setIngredientsNeededFilter(($('#select-ingredients_needed_filter_value').find('option:selected').val()));
                makeCall();
            });

            $('#cuisine-preference-checkbox').on('ifChanged', function(){
                storageObject.setCuisinePreferenceCheckStatus($('#cuisine-preference-checkbox').is(':checked'));
                makeCall();
            });

            $('#ingredient-search-button').on('click', handleSearchInput);

            $('#ingredient-input').keypress(function(e){
                // clears search box validation feedback when new term is entered
                $('#search-validation').empty();
                // enables search to run on 'Enter'
                if(e.which === 13){
                    $('#ingredient-search-button').click();
                }
            });

            $('.clear-all-ingredients-btn').on('click', clearAllIngredients);

            initCuisinePreferenceCheckbox();

        }

    };

    function clearAllIngredients(){
        storageObject.removeAllIngredients();
        w.ingredientsController.selectedIngredients = storageObject.getSelectedIngredients();
        makeCall();
        updateDisplay(storageObject.getSelectedIngredients());
    }

    function handleSearchInput(){
        // trims and validates search input
        var typedIngredientName = $('#ingredient-input').val().trim();
        var reg = /^[A-z\-\s]+$/;
        if(reg.test(typedIngredientName)) {
            $(".li-ingredient").find("a[data-name='" + typedIngredientName + "']").click();
        } else {
            $('#search-validation').text("Invalid characters in search term");
        }
    }

    function initCuisinePreferenceCheckbox(){
        var checked = storageObject.getCuisinePreferenceCheckStatus();
        $('#cuisine-preference-checkbox').prop('checked', checked);
    }

    // toggles ingredient display when an ingredient is searched or selected from dropdown menu
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

    }

    function updateDisplay(recipes){
        var displayIngredientsUl = $('.selected-ingredients-anchor ul:first');
        displayIngredientsUl.hide();
        storageObject.setRecipes(recipes);
        // clear html containers
        $('.clearable').empty();

        // display ingredient images in selected ingredients panel
        var ingredientsList = w.ingredientsController.selectedIngredients;
        for(var i = 0; i < ingredientsList.length; i++) {
            displayIngredientsUl.show();
            var ingredientImageUrl = "img/ingredients/" +  ingredientsList[i].image_url;
            var listItem = '<li class="li-ingredient-added"><div class="ingredient-img" style="background-image:url('+ingredientImageUrl+')"><button type="button" class="close cross-button" aria-label="Close" data-name="' + ingredientsList[i].name + '" data-id="' + ingredientsList[i].id + '" data-image="' + ingredientsList[i].image_url + '"><span aria-hidden="true" data-name="' + ingredientsList[i].name + '" data-id="' + ingredientsList[i].id + '" data-image="' + ingredientsList[i].image_url + '">&times;</span></button></div></div>' + ingredientsList[i].name + '</li>';
            $(displayIngredientsUl).append(listItem);
        }

        // toggle introduction message and clear ingredients button based on whether any ingredients have been selected
        if(w.ingredientsController.selectedIngredients.length === 0) {
            $('.intro-message').show();
            $('.clear-all-ingredients-btn').hide();
        } else {
            $('.intro-message').hide();
            $('.clear-all-ingredients-btn').show();
        }

    }

    function makeCall(){
        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            var cuisineType = storageObject.getCuisineType();
            var cuisinePreference = storageObject.getCuisinePreferenceCheckStatus();
            var ratingFilterValue = storageObject.getRatingFilterValue();
            var ingredientFilterValue = storageObject.getIngredientsFilterValue();
            var ingredientsNeededFilterValue = storageObject.getIngredientsNeededFilterValue();
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients,
                    cuisineType: cuisineType,
                    cuisinePreference: cuisinePreference,
                    ratingFilterValue: ratingFilterValue,
                    ingredientFilterValue: ingredientFilterValue,
                    ingredientsNeededFilterValue: ingredientsNeededFilterValue
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

})(jQuery, window);

