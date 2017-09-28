function makeRatingCall(recipeID, URL) {
    console.log('recipe_id: '+recipeID);
    console.log('URL: '+URL);
    console.log('val: '+$('input[name=rating-'+recipeID+']:checked').val());
    $.ajax({
        url: URL,
        type: 'POST',
        data: {
            id: recipeID,
            rating: $('input[name=rating-'+recipeID+']:checked').val()
        }
    }).done(function(response){
        console.log(response);
        console.log(response.html);
    }).fail(function(response){
        console.log(response);
        console.log(response.responseText);

    });

}