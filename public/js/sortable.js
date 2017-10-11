/**
 * Created by Brendan on 25/09/2017.
 */
// jQuery Sortable.js. Accessed 25/09/17 via https://jqueryui.com/sortable/
(function(w, $){
    w.sortableController = {
        mappingResults: [],

        watch: function(){

            $( "#sortable" ).sortable({
                stop: handleSortStopEvent
            });

            $('.update-cuisine-mappings-btn').click(function(){
                $('.success-box').addClass('invisible');
                makeCall(w.sortableController.mappingResults);
            });

            $('.close').click(function(){
                $('.success-box').addClass('invisible');
            });

        }

    }

    function handleSortStopEvent(event, ui){
        var newListOrdered = $(event.target.children);
        w.sortableController.mappingResults = [];

        $.each($(newListOrdered), function(index, val){
            var mappingObj = {
                cuisineId: $(val).attr('data-mapping-id'),
                newRanking: index
            };

            w.sortableController.mappingResults.push(mappingObj);

        })

    }

    function makeCall(resultsArray){

        $.ajax({
            url: $('.cuisine-mappings-anchor').attr('data-controller-url'),
            type: 'POST',
            data: {
                data: resultsArray

            }
        }).done(function(response){
            var displayResponseDiv = $('.success-message');
            var displayResponseDivBox = $('.success-box');
            var displayResponseDivImgCross = $('.success-danger-img .cross-img');
            var displayResponseDivImgTick = $('.success-danger-img .tick');
            $(displayResponseDiv).removeClass('alert').removeClass('alert-danger').removeClass('alert-success');
            $(displayResponseDivBox).removeClass('invisible').removeClass('color-red');

            $(displayResponseDiv).addClass('alert alert-' + response.class); // success or danger
            if(response.class === 'danger') {
                $(displayResponseDivBox).addClass('color-red');
                $(displayResponseDivImgTick).addClass('invisible');
                $(displayResponseDivImgCross).removeClass('invisible');
            } else {
                $(displayResponseDivImgTick).removeClass('invisible');
                $(displayResponseDivImgCross).addClass('invisible');
            }
            $(displayResponseDiv).html(response.message);
        });

    }

    w.sortableController.watch();

})(window, jQuery)