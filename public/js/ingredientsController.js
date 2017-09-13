/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){
    w.ingredientsController = {
        selectedIngredients: [],
        appendIngredientToURLString: '&allowedIngredient=',
        watch: function(){
            $('.li-ingredient').click(function(e){
                var ingredientName = $(e.target).attr('data-name');
                var ingString = w.ingredientsController.appendIngredientToURLString.concat(ingredientName);

                if(w.ingredientsController.selectedIngredients.indexOf(ingString) < 0){
                    addIngredient(ingString);
                }
                else{
                    removeIngredient(ingString);
                }
                updateDisplay();

            });
        }

    };

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
        var apiP = $('.api-key');
        var apiKey = $(apiP).attr('data-api-url');

        var apiString = '';

        $(displayIngredientsUl).empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;

        for(var i = 0; i < ingredientsList.length; i++){
            $(displayIngredientsUl).append('<li>' + ingredientsList[i] + '</li>');
            apiString += ingredientsList[i];
        }

        $(apiP).text(apiKey + apiString);

        // makes the call to our php controller, which then hits the api
        $.ajax({
            url: apiP.attr('data-api-controller-url'),
            type: 'POST',
            data: {
                apiUrl: apiKey.concat(apiString)
            },
            success: function(response){
                $('#json-results').text(JSON.stringify(response.yummly_results.matches));
                console.log(response.yummly_results.matches);
            }
        });
    }

    w.ingredientsController.watch();

})(jQuery, window)
