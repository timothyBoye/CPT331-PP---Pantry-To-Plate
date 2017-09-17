/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){
    w.ingredientsController = {
        selectedIngredients: [],

        watch: function(){

            // on dropdown click update display + get json
            $('.li-ingredient').click(function(e){
                var ingredientName = $(e.target).attr('data-name');;

                if(!w.ingredientsController.selectedIngredients.includes(ingredientName)){
                    addIngredient(ingredientName);
                }
                else{
                    removeIngredient(ingredientName);
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
        var ingredientsHook = $('.ingredients-output');

        // clear html containers
        $('.clearable').empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;
        for(var i = 0; i < ingredientsList.length; i++){
            $(displayIngredientsUl).append('<li>' + ingredientsList[i] + '</li>');
        }

        // makes the call to our php controller, which then hits the db
        if(w.ingredientsController.selectedIngredients.length > 0){
            $.ajax({
                url: $('.selected-ingredients-anchor').attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    ingredients: w.ingredientsController.selectedIngredients
                },
                // this is hacky and will change in future, just a demo of output after refactor
                success: function(response){
                    $('.recipes').empty();
                    $.each(response.recipes, function(k, v){
                        $.each(v, function(key, value){
                            $('.recipes').append(
                                  '<div class="col-md-3">'
                                  +'<h4>' + value.name + '</h4>'
                                  +'</div>'
                            );
                        })
                    });
                }
            });
        }

    }

    w.ingredientsController.watch();

})(jQuery, window)
