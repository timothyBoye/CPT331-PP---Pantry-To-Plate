/**
 * Created by Tim Boye 2017.
 */

/**
 * Called when a user rates a recipe. It accepts a recipe ID and URL, finds the user's rating for that recipe on the
 * site and returns that data to the server for saving.
 *
 * @param recipeID
 * @param URL
 */
function makeRatingCall(recipeID, URL) {
    $.ajax({
        url: URL,
        type: 'POST',
        data: {
            id: recipeID,
            rating: $('input[name=rating-'+recipeID+']:checked').val()
        }
    }).done(function(response){
        console.log('Rating updated for recipe_id: '+recipeID+', val: '+$('input[name=rating-'+recipeID+']:checked').val()+' star');
        $('.rating-editable').addClass('rated');
        $('#rated-by-who').text('your rating');
    }).fail(function(response){
        console.log('Rating call failed: '+response);
    });

}

