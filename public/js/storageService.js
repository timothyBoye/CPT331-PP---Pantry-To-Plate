/**
 * Created by Brendan on 20/09/2017.
 */
var storageObject = (function(w){

    var selectedIngredients = Cookies.getJSON('selectedIngredients') || [];
    var me = {
        cuisineType: -1,
        cookieExpiry: 0.5,
        ratingFilterValue: -1,
        ingredientsFilterValue: -1
    };

    me.addIngredient = function(ingredientID, ingredientName, ingredientImageURL){
        var ingredient = {id:ingredientID, name:ingredientName, image_url:ingredientImageURL};
        selectedIngredients.push(ingredient);
        updateIngredients();
        return selectedIngredients;
    };

    me.removeIngredient = function(ingredientID){
        var index = me.find(selectedIngredients, ingredientID, 'id');
        if(index >= 0){
            selectedIngredients.splice(index, 1);
        }
        updateIngredients();
        return selectedIngredients;
    };

    me.removeAllIngredients = function(){
        selectedIngredients = [];
        updateIngredients();
    }

    me.getSelectedIngredients = function(){
        return selectedIngredients;
    };

    me.setRecipes = function(recipes){
        w.sessionStorage.setItem('recipes', JSON.stringify(recipes));
    }

    me.getRecipes = function(){
        var recipes = w.sessionStorage.getItem('recipes');
        return recipes != null && recipes.length > 0 ? JSON.parse(recipes) : [];
    }

    // Cuisine types
    me.setCuisineType = function(id){
        me.cuisineType = id;
        Cookies.set('cuisineTypeId', me.cuisineType, {
            exipres: me.cookieExpiry
        })
    }

    me.getCuisineType = function(){
        return Cookies.get('cuisineTypeId');
    }

    me.setCuisinePreferenceCheckStatus = function(inputChecked){
        Cookies.set('cuisinePreferenceCheckStatus', inputChecked, me.cookieExpiry);
    }

    me.getCuisinePreferenceCheckStatus = function(){
        var isChecked = Cookies.get('cuisinePreferenceCheckStatus');
        return /^true$/.test(isChecked);
    }

    function updateIngredients(){
        Cookies.set('selectedIngredients', selectedIngredients, {
            expires: me.cookieExpiry
        });
    };

    // Ratings
    me.getRatingFilterValue = function(){
        return Cookies.get('ratingFilterValue');
    }

    me.setRatingFilter = function(id){
        me.ratingFilterValue = id;
        Cookies.set('ratingFilterValue', me.ratingFilterValue, {
            expires: me.cookieExpiry
        })
    }

    // ingredients filer
    me.getIngredientsFilterValue = function(){
        return Cookies.get('ingredientsFilterValue');
    }

    me.setIngredientsFilter = function(id) {
        me.ingredientsFilterValue = id;
        Cookies.set('ingredientsFilterValue', me.ingredientsFilterValue, {
            expires: me.cookieExpiry
        })
    }

    me.find = function find(myArray, searchTerm, property) {
        for(var i = 0, len = myArray.length; i < len; i++) {
            if (myArray[i][property] === searchTerm) {
                return i;
            }
        }

        return -1;
    }

    return me;

}(window));