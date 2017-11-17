/**
 * Created by Brendan on 8/11/2017.
 */
/**
 * Created by Brendan on 20/09/2017.
 *
 * Usage: Call paginationService.init from within your pages controller to ensure that the page
 * has pagination support from the frontend.
 *
 */

var paginationService = (function(w){

    var me = {
        pageNumber: 1,
        finished: false,
        callback: null
    };

    /*
    *       Takes a callback which is called when the user has scrolled to the bottom
    *       of the screen. Allows paginationService to be reused.
    * */
    me.init = function(callback){
        document.addEventListener('scroll', me.CheckIfScrollBottom);
        me.callback = callback;
    };

    me.CheckIfScrollBottom = debouncer(function() {
        if(getScrollXY()[1] + window.innerHeight >= getDocHeight() - 100 && me.pageNumber > 1 && !me.finished) {
            me.callback();
        }
    },500);


    /*
    *       I believe this was sourced online? -Brendan
    *
    * */
    function debouncer(a, b, c) {
        var d;
        return function () {
            var e = this, f = arguments, g = function () {
                d = null, c || a.apply(e, f)
            }, h = c && !d;
            clearTimeout(d), d = setTimeout(g, b), h && a.apply(e, f)
        }
    }

    function getScrollXY() {
        var a = 0, b = 0;
        return "number" == typeof window.pageYOffset ? (b = window.pageYOffset, a = window.pageXOffset) : document.body && (document.body.scrollLeft || document.body.scrollTop) ? (b = document.body.scrollTop, a = document.body.scrollLeft) : document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop) && (b = document.documentElement.scrollTop, a = document.documentElement.scrollLeft), [a, b]
    }

    function getDocHeight() {
        var a = document;
        return Math.max(a.body.scrollHeight, a.documentElement.scrollHeight, a.body.offsetHeight, a.documentElement.offsetHeight, a.body.clientHeight, a.documentElement.clientHeight)
    }

    me.resetPageCount = function() {
        me.pageNumber = 1;
        me.finished = false;
    };

    return me;

}(window));
