/**
 * Created by Brendan on 20/09/2017.
 */
var storageObject = (function(w){

    var selectedIngredients = Cookies.getJSON('selectedIngredients') || [];
    var me = {
        cuisineType: -1
    };

    me.addIngredient = function(ingredientID, ingredientName, ingredientImageURL){
        var ingredient = {id:ingredientID, name:ingredientName, image_url:ingredientImageURL};
        selectedIngredients.push(ingredient);
        updateIngredients();
        return selectedIngredients;
    };

    me.removeIngredient = function(ingredientID){
        var index = me.find(selectedIngredients, ingredientID, 'id');
        console.log('index: '+index);
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

    me.find = function find(myArray, searchTerm, property) {
        console.log('array: '+myArray);
        console.log('term: '+searchTerm);
        console.log('property: '+property);

        for(var i = 0, len = myArray.length; i < len; i++) {
            if (myArray[i][property] === searchTerm) {
                console.log('found: '+i);
                return i;
            }
        }
        console.log('didnt find anything');
        return -1;
    }

    return me;

}(window));