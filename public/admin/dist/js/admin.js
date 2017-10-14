
jQuery.validator.addMethod("alpha_international", function(value, element) {
    return this.optional(element) || /^[a-zA-Z æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż]+$/i.test(value);
}, "Letters only please");

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