/**
 * Created by Brendan on 20/09/2017.
 */
var storageObject = (function(w){

    var selectedIngredients = Cookies.getJSON('selectedIngredients') || [];
    var me = {
        cuisineType: -1
    };

    me.addIngredient = function(ingredientName){
        selectedIngredients.push(ingredientName);
        updateIngredients();
        return selectedIngredients;
    };

    me.removeIngredient = function(ingredientName){
        var index = selectedIngredients.indexOf(ingredientName);
        if(index >= 0){
            selectedIngredients.splice(index, 1);
        }
        updateIngredients();
        return selectedIngredients;
    };

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

    me.setCuisineType = function(id){
        me.cuisineType = id;
        Cookies.set('cuisineTypeId', me.cuisineType, {
            exipres: 0.5
        })
    }

    me.getCuisineType = function(){
        return Cookies.get('cuisineTypeId');
    }

    function updateIngredients(){
        Cookies.set('selectedIngredients', selectedIngredients, {
            expires: 0.5
        });
    };

    return me;

}(window));