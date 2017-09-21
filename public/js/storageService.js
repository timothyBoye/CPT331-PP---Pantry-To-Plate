/**
 * Created by Brendan on 20/09/2017.
 */
var storageObject = (function(){

    var selectedIngredients = Cookies.getJSON('selectedIngredients') || [];
    var me = {};

    me.addIngredient = function(ingredientName){
        selectedIngredients.push(ingredientName);
        updateStorage();
        return selectedIngredients;
    };

    me.removeIngredient = function(ingredientName){
        var index = selectedIngredients.indexOf(ingredientName);
        if(index >= 0){
            selectedIngredients.splice(index, 1);
        }
        updateStorage();
        return selectedIngredients;
    };

    me.getSelectedIngredients = function(){
        return selectedIngredients;
    };

    me.setRecipes = function(recipes){
        Cookies.set('recipes', recipes, {
            expires: 0.5
        });
    }

    me.getRecipes = function(){
        var recipes = Cookies.getJSON('recipes');
        return recipes;
    }

    function updateStorage(){
        Cookies.set('selectedIngredients', selectedIngredients, {
            expires: 0.5
        });
    };

    return me;

}());