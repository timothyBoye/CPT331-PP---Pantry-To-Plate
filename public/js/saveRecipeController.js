(function($, w){

    w.saveRecipeController = {
        watch: function() {
            $('.save-recipe-btn').on('click', handleSaveButtonClick)

            $('.delete-saved-recipe-btn').on('click', handleDeleteRecipeButtonClick);
        }
    }

    function handleDeleteRecipeButtonClick(evt){
        var recipeId = $(evt.target).attr('data-recipe-id');
        var url = $('#saved_recipes_table').attr('data-delete-recipe-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                recipeId: recipeId
            }
        }).done(function(response) {
            var row = $(evt.target).closest('tr');
            console.log(response);
            row.remove();
        });
    }


    function handleSaveButtonClick(evt){
        var recipeId = $(evt.target).attr('data-id');
        var url = $('#save-recipe-div').attr('data-save-recipe-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                    recipeId: recipeId

            }

        }).done(function(response){
                console.log(response);
                $('#saved-btn-'+response.saved_recipe_id).hide();
                $('#saved-label-'+response.saved_recipe_id).removeClass('invisible');
            });

    }

    w.saveRecipeController.watch();

    }) (jQuery, window)