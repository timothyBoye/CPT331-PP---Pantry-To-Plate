/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){

    var currentPageIndex = 1;

    w.ingredientsController = {
        selectedIngredients: [],
        appendIngredientToURLString: '&allowedIngredient=',
        watch: function(){

            // on dropdown click update display + get json
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

            // on page button update display + get json for page index
            $('.li-page').click(function(e){

                currentPageIndex = $(this).text();
                alert(currentPageIndex);
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

    var getQueryString = function ( field, url ) {
        var href = url ? url : window.location.href;
        var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
        var string = reg.exec(href);
        return string ? string[1] : null;
    };

    function updateDisplay(){
        var displayIngredientsUl = $('.selected-ingredients-anchor ul:first');
        var apiP = $('.api-key');
        var apiKey = $(apiP).attr('data-api-url');

        var apiString = '';

        // clear html containers
        $(displayIngredientsUl).empty();
        $('#json-results').empty();
        $("#json-results-count").empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;

        for(var i = 0; i < ingredientsList.length; i++){
            $(displayIngredientsUl).append('<li>' + ingredientsList[i] + '</li>');
            apiString += ingredientsList[i];
        }

        // apiString += "&maxResult=2&start=10";

        $(apiP).text(apiKey + apiString);

        // use the saved page index
        var pageIndex = currentPageIndex;
        /*var queryPage = getQueryString("page");
        if(queryPage) {
            pageIndex = queryPage;
        }*/
        var apiUrl = apiKey.concat(apiString);

        console.log("page: ", pageIndex);
        console.log("apiUrl: ", apiUrl);
        
        // makes the call to our php controller, which then hits the api
        $.ajax({
            url: apiP.attr('data-api-controller-url'),
            type: 'POST',
            data: {
                apiUrl: apiUrl,
                page: pageIndex
            },
            success: function(response){

                var matchesJson = response.data.matches
                //$('#json-results').text(JSON.stringify(matchesJson));

                $("#json-results-count").text(JSON.stringify(response.data.totalMatchCount) + ' results');

                // loop results display in container
                for(var i = 0; i < matchesJson.length; i++) {
                    $('#json-results').append( '<h1>'+matchesJson[i].recipeName +'</h1>');
                }

            }
        });
    }

    w.ingredientsController.watch();

})(jQuery, window)
