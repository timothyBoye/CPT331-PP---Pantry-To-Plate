(function($, w){

    w.saveRecipeController = {
        watch: function() {
            $('.save-recipe-btn').on('click', handleSaveButtonClick);

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
            row.remove();
        });
    }


    function handleSaveButtonClick(evt){
        var recipeId = $(evt.target).attr('data-id');

        // Remove save or
        if ($('#saved-btn-' + recipeId).html() == 'Saved') {
            var url = $('.save-recipe-div').attr('data-delete-recipe-url');

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    recipeId: recipeId
                }
            }).done(function(response) {
                $('#saved-btn-' + recipeId).removeClass('disabled');
                $('#saved-btn-' + recipeId).html('Save');
            });
        // Add saved recipe
        } else {
            var url = $('.save-recipe-div').attr('data-save-recipe-url');

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    recipeId: recipeId
                }
            }).done(function (response) {
                $('#saved-btn-' + response.saved_recipe_id).addClass('disabled');
                $('#saved-btn-' + response.saved_recipe_id).html('Saved');
            });
        }
    }

    w.saveRecipeController.watch();

    }) (jQuery, window)