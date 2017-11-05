/**
 * Created by Tim Boye 2017.
 */

/**
 * JQuery Validator function for allowing any letter plus letters with accents
 */
jQuery.validator.addMethod("alpha_international", function(value, element) {
    return this.optional(element) || /^[a-zA-Z æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż]+$/i.test(value);
}, "Letters only please");

/**
 * Sets up the tables on the admin website
 */
$(function () {
    $('#datatable').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'stateSave'   : true
    })
})