/**
 * Created by Brendan on 12/09/2017.
 */

// Credit to Zepernick, P. 2015. Stackoverflow accessed 23/07/2017 via https://stackoverflow.com/questions/21627170/laravel-tokenmismatchexception-in-ajax-request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});