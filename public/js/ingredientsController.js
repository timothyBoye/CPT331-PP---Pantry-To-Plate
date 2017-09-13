/**
 * Created by Brendan on 9/09/2017.
 */
(function($, w){

    var currentPageIndex = 1;
    var totalPageCount = 1;
    var maxResultsPerPage = 10;


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


        }

    };

    function addPageButtonListeners() {
        // on page button update display + get json for page index
        $('.li-page').click(function(e){

            currentPageIndex = $(this).text();
            updateDisplay();
        });
    }

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
        $("#pagination-list").empty();

        var ingredientsList = w.ingredientsController.selectedIngredients;

        for(var i = 0; i < ingredientsList.length; i++){
            $(displayIngredientsUl).append('<li>' + ingredientsList[i] + '</li>');
            apiString += ingredientsList[i];
        }

        // add pagination to the url query string
        var startOffset = maxResultsPerPage * currentPageIndex;
        apiString += "&maxResult=" + maxResultsPerPage + "&start=" + startOffset;

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
        if(w.ingredientsController.selectedIngredients.length > 0){
            $.ajax({
                url: apiP.attr('data-api-controller-url'),
                type: 'POST',
                data: {
                    apiUrl: apiUrl,
                    page: pageIndex
                },
                success: function(response){
                    $('#json-results').text(JSON.stringify(response.yummly_results.matches));
                    console.log(response.yummly_results.matches);

                    var matchesJson = response.yummly_results.matches;
                    var totalResults = response.yummly_results.totalMatchCount;
                    totalPageCount = totalResults / maxResultsPerPage;
                    //$('#json-results').text(JSON.stringify(matchesJson));

                    // results count / title
                    $("#json-results-count").text(totalResults + ' results, pages: ' + totalPageCount);

                    // create pagination buttons
                    var maxPageButtons = 10;
                    for(var i = 0; i < totalPageCount; i++) {
                        if(i < maxPageButtons) {
                            $("#pagination-list").append("<li class='li-page'><a href='#'>"+(i+1)+"</a></li>");
                        }
                    }
                    addPageButtonListeners();

                    // loop results display in container
                    for(var i = 0; i < matchesJson.length; i++) {
                        $('#json-results').append( '<h1>'+matchesJson[i].recipeName +'</h1>');
                    }

                }
            });
        }

    }

    w.ingredientsController.watch();

})(jQuery, window)
