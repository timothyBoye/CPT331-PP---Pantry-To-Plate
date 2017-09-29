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
        console.log(response);
    });

}