
jQuery.validator.addMethod("alpha_international", function(value, element) {
    return this.optional(element) || /^[a-zA-Z æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż]+$/i.test(value);
}, "Letters only please");