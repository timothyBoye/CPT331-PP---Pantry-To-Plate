<?php

use Illuminate\Database\Seeder;
use App\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $fruit = 'constants.fruit_category_id';
        $veg = 'constants.veg_category_id';
        $dairy = 'constants.dairy_category_id';
        $herb = 'constants.herb_category_id';
        $spice = 'constants.spice_category_id';
        $meat = 'constants.meat_category_id';
        $oil = 'constants.oil_category_id';
        $sweetener = 'constants.sweetener_category_id';
        $liquid = 'constants.liquid_category_id';
        $condiment = 'constants.condiment_category_id';
        $grain = 'constants.grain_category_id';
        $seeds = 'constants.seeds_category_id';
        $nuts = 'constants.nuts_category_id';
        $baking = 'constants.baking_category_id';
        $misc = 'constants.misc_category_id';


        $ingredients = array(
            array('name' => 'romaine lettuce', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cosberg-lettuce-x200.jpg'),
            array('name' => 'black olives', 'ingredient_category_id'=> Config::get($fruit), 'ingredient_image_url' => 'pitted-black-olives-x200.jpg'),
            array('name' => 'grape tomatoes', 'ingredient_category_id'=> Config::get($fruit), 'ingredient_image_url' => 'cherry-tomatoes-x200.jpg'),
            array('name' => 'pepper', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'purple onion', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'purple-onion.jpg'),
            array('name' => 'beans', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'butter-beans-x200.jpg'),
            array('name' => 'bell peppers', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'apple', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'apple-2-x200.jpg'),
            array('name' => 'apricot', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'apricot.jpeg'),
            array('name' => 'avocado', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'avocado.jpg'),
            array('name' => 'banana', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'banana.jpg'),
            array('name' => 'bilberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blueberry.jpg'),
            array('name' => 'blackberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blackberry.jpg'),
            array('name' => 'blackberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blackberry.jpg'),
            array('name' => 'blackcurrant', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'blueberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blueberry.jpg'),
            array('name' => 'blueberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blueberry.jpg'),
            array('name' => 'boysenberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'cherry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'cherries.jpg'),
            array('name' => 'currant', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'chico fruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'coconut', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'cranberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'dried-cranberries-x200.jpg'),
            array('name' => 'cucumber', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'cucumber-x200.jpg'),
            array('name' => 'dried apricots', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'Ingredients-DicedApricots_20422-2-x200 (1).jpg'),
            array('name' => 'sugar apple', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'damson', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'date', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'dragonfruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'durian', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'elderberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'fig', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'goji berry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'gooseberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'grape', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'red-seedless-grapes-x200.jpg'),
            array('name' => 'raisin', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'grapefruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'guava', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'honeyberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'huckleberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'jabuticaba', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'jackfruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'jambul', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'jujube', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'juniper berry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'kiwifruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'kumquat', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'lemon', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'lemon-x200.jpg'),
            array('name' => 'lime', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'lime-x200.jpg'),
            array('name' => 'longan', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'lychee', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'mango', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'marionberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'melon', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'cantaloupe', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'honeydew', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'watermelon', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'miracle fruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'mulberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'nectarine', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'nance', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'olive', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'orange', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'orange-x200.jpg'),
            array('name' => 'oranges', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'orange-x200.jpg'),
            array('name' => 'clementine', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'mandarine', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'tangerine', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'papaya', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'passionfruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'peach', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'pear', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'persimmon', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'physalis', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'plantain', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'plum', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'prune', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'plumcot', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'pomegranate', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'pineapple', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'pomelo', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'purple mangosteen', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'quince', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'raspberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'salmonberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'rambutan', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'redcurrant', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'salal berry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'salak', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'satsuma', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'soursop', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'star fruit', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'solanum quitoense', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'strawberry', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'tamarillo', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => ''),
            array('name' => 'tamarind', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'tamarind-x200.jpg'),
            array('name' => 'artichoke', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'arugula', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),
            array('name' => 'rocket', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'rocket_salad_1024-x200.jpg'),
            array('name' => 'rocket leaves', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'rocket_salad_1024-x200.jpg'),
            array('name' => 'asparagus', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Asparagus-2-x200.jpg'),
            array('name' => 'aubergine', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'aubergine-x200.jpg'),
            array('name' => 'eggplant', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'aubergine-x200.jpg'),
            array('name' => 'amaranth', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'mixed greens', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),

            //Legumes
            array('name' => 'alfalfa sprouts', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'azuki beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'bean sprouts', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'black beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Black-beans2-x200.jpg'),
            array('name' => 'black-eyed peas', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'borlotti bean', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'broad beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'chickpeas', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'garbanzos', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'green beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'kidney beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'kidney-beans-x200.jpg'),
            array('name' => 'lentils', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-lentils-x200.jpg'),
            array('name' => 'lima beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'butter bean', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'butter-beans-x200.jpg'),
            array('name' => 'mung beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'navy beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'pinto beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'runner beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'split peas', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'soy beans', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'peas', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'garden-peas-2-x200.jpg'),
            array('name' => 'mangetout', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'snap peas', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'mange-tout-2-x200.jpg'),

            //veg
            array('name' => 'beet greens', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'bok choy', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'broccoflower', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'broccoli', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'broccoli.jpg'),
            array('name' => 'brussels sprouts', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'cabbage', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'calabrese', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'carrots', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'cauliflower', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cauliflower.jpeg'),
            array('name' => 'celery', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'celery-stick-x200.jpg'),
            array('name' => 'chard', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'collard greens', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'endive', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'fiddleheads', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'frisee', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'fennel', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'kale', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),
            array('name' => 'kohlrabi', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'sweetcorn', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'sorn', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'mushrooms', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'white-mushrooms-x200.jpg'),
            array('name' => 'portobello mushrooms', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'white-mushrooms-x200.jpg'),
            array('name' => 'okra', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'nettles', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'mustard greens', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'chives', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'fresh-chives-x200.jpg'),
            array('name' => 'garlic', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'garlic-1712365_1280.jpg'),
            array('name' => 'leek', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'onion', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'onion-x200.jpg'),
            array('name' => 'red onion', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-onion-x200.jpg'),
            array('name' => 'shallot', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'shallot-x200.jpg'),
            array('name' => 'spring onion', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spring-onion-x200.jpg'),
            array('name' => 'green onion', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'parsley', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'green pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'green-pepper-x200.jpg'),
            array('name' => 'red pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-pepper-x200.jpg'),
            array('name' => 'yellow pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'yellow-pepper-x200.jpg'),
            array('name' => 'chili pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-chilli-x200.jpg'),
            array('name' => 'green chili', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'green-chili.jpg'),
            array('name' => 'capsicum', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'jalapeño', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'habanero', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'paprika', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'tabasco pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'cayenne pepper', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'radicchio', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'rhubarb', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'root vegetables', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'beetroot', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cooked-beetrot-4-x200.jpg'),
            array('name' => 'scallion', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spring-onion-x200.jpg'),
            array('name' => 'beet', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'carrot', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'carrot-x200.jpg'),
            array('name' => 'celeriac', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'daikon', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'ginger', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'fresh-ginger-x200.jpg'),
            array('name' => 'parsnip', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'rutabaga', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'turnip', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'radish', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'radish-x200.jpg'),
            array('name' => 'wasabi', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'horseradish', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Horseradish-sauce-2-x200.jpg'),
            array('name' => 'white radish', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'swede', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'salsify', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'skirret', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'spinach', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spinach-x200.jpg'),
            array('name' => 'baby spinach', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spinach-x200.jpg'),
            array('name' => 'topinambur', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'acorn squash', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'butternut squash', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'banana squash\'', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'courgette', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'courgette-x200.jpg'),
            array('name' => 'cucumber', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'delicata', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'marrow', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'hubbard squash', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'squash', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'pumpkin', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'spaghetti squash', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'tomato', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'tomato-x200.jpg'),
            array('name' => 'tubers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'jicama', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'jerusalem artichoke', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'artichoke-hearts-x200.jpg'),
            array('name' => 'potato', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'potatoes-x200.jpg'),
            array('name' => 'quandong', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'sunchokes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'sweet potato', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'sweet-potato-x200.jpg'),
            array('name' => 'taro', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'turnip greens', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'water chestnut', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'watercress', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'zucchini', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'courgette-x200.jpg'),
            array('name' => 'mixed vegetables', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'mixvegitable_large.jpg'),



            //herbs
            array('name' => 'mint', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'mint.jpg'),
            array('name' => 'anise', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'basil', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-basil-x200.jpg'),
            array('name' => 'cilantro', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-coriander-x200.jpg'),
            array('name' => 'coriander', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-coriander-x200.jpg'),
            array('name' => 'chamomile', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'dill', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'fennel', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'lemon grass', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'marjoram', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'oregano', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'dried-oregano-x200.jpg'),
            array('name' => 'parsley', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-parsley-x200.jpg'),
            array('name' => 'rosemary', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-rosemary-x200.jpg'),
            array('name' => 'sage', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),
            array('name' => 'thyme', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => ''),

            //oils
            array('name' => 'olive oil', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'olive-oil.jpg'),
            array('name' => 'extra virgin olive oil', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'olive-oil.jpg'),
            array('name' => 'vegetable oil', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'oil', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'peanut oil', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),

            //condiments
            array('name' => 'sriracha sauce', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'spice-sauce-brown-bowl-isolated-white-background-closeup-72906255.jpg'),
            array('name' => 'hot sauce', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'tomato-paste-x200.jpg'),
            array('name' => 'salsa', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => ''),
            array('name' => 'balsamic vinegar', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),
            array('name' => 'mayonnaise', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'use-mayonnaise-facial-mask-1.jpg'),
            array('name' => 'condensed milk', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'condensed-milk.jpg'),
            array('name' => 'fish sauce', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'fish-sauce-x200.jpg'),
            array('name' => 'soy sauce', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),
            array('name' => 'oyster sauce', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),


            //spices
            array('name' => 'garlic powder', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'garlic-powder-loose.jpg'),
            array('name' => 'onion powder', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'onion-powder.jpg'),
            array('name' => 'salt', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'sea-salt.jpg'),
            array('name' => 'sea salt', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'sea-salt.jpg'),
            array('name' => 'pepper', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'black-pepper.jpg'),
            array('name' => 'black pepper', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'black-pepper.jpg'),
            array('name' => 'white pepper', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'WHITE_PEPPER_GROUND_1.jpg'),
            array('name' => 'chili flakes', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'chilli-flakes-250x250.jpg'),
            array('name' => 'dried basil', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'dried-basil.jpg'),
            array('name' => 'dried oregano', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'dried-oregano-x200.jpg'),
            array('name' => 'dried parsley', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'large_square_Parsley_Flakes__close.jpg'),
            array('name' => 'paprika', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'paprika-x200.jpg'),
            array('name' => 'smoked paprika', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'cayenne pepper', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'cumin', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cumin-seeds-x200.jpg'),
            array('name' => 'sumac', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'sumac-x200.jpg'),
            array('name' => 'cinnamon', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cinnamon.jpeg'),
            array('name' => 'ground cinnamon', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'ras-el-hanout-x200.jpg'),
            array('name' => 'vegetable stock cube', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => ''),
            array('name' => 'mustard seed', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => ''),
            array('name' => 'dill seed', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => ''),
            array('name' => 'coriander seed', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'coriander_seeds.jpeg'),
            array('name' => 'nutmeg', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'nutmeg.jpg'),
            array('name' => 'garam masala', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'garam_masala.jpeg'),
            array('name' => 'cardamom pods', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cardamom_pods.jpeg'),

            //sweeteners
            array('name' => 'sugar', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'bowl-of-sugar.jpg'),
            array('name' => 'maple syrup', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'fish-sauce-x200.jpg'),
            array('name' => 'erythritol', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'bowl-of-sugar.jpg'),
            array('name' => 'honey', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'honey-pot-x200.jpg'),

            //liquids
            array('name' => 'water', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'rice-vinegar-x200.jpg'),
            array('name' => 'lime juice', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'lime-juice.jpg'),
            array('name' => 'lemon juice', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'benefits-of-lemon1.jpg'),
            array('name' => 'coconut milk', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'coconut-milk.jpeg'),
            array('name' => 'shaoxing wine', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => ''),

            //meats
            array('name' => 'lamb chops', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'lamb-chop.jpg'),
            array('name' => 'pork chops', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'pork-loin-steaks-x200.jpg'),
            array('name' => 'pork', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'pork-loin-steaks-x200.jpg'),
            array('name' => 'pork chorizo sausage', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'mini-cooking-chorizo-x200.jpg'),
            array('name' => 'rump steak', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'rump-steak.jpg'),
            array('name' => 'salmon', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'salmon.jpg'),
            array('name' => 'prawn', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'king-prawns-x200.jpg'),
            array('name' => 'chicken breast', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'British-diced-chicken-breast-2-x200.jpg'),
            array('name' => 'chicken thighs', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'British-chicken-thighs-with-skin-2-x200.jpg'),
            array('name' => 'bacon', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'bacon.jpg'),
            array('name' => 'speck', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'speck.jpg'),
            array('name' => 'crab', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'carb.jpeg'),


            //grains
            array('name' => 'sourdough bread', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'sourdough.jpg'),
            array('name' => 'corn tortillas', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'Taco_CrispyCornTortilla.jpg'),
            array('name' => 'farfalle pasta', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'farfalle-pasta.jpeg'),
            array('name' => 'arborio rice', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'arborio-rice-x200.jpg'),
            array('name' => 'fettuccine', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'fettuccine.jpg'),
            array('name' => 'couscous', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'couscous.jpg'),
            array('name' => 'rice', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'arborio-rice-x200.jpg'),


            //baking
            array('name' => 'whole wheat flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'whole_wheat_flour.jpeg'),
            array('name' => 'chickpea flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'chickpea_flour.jpeg'),
            array('name' => 'all-purpose flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'plain flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'coconut flour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'coconut-flour.jpg'),
            array('name' => 'cornflour', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'baking soda', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'baking-soda.jpeg'),
            array('name' => 'baking powder', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'baking-soda.jpeg'),
            array('name' => 'vanilla', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'vanilla.jpg'),
            array('name' => 'powdered chocolate milk mix', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'Cacao-powder-and-coconut-sugar.jpg'),
            array('name' => 'cocoa powder', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'ras-el-hanout-x200.jpg'),
            array('name' => 'corn starch', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'dessicated coconut', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'dessicated_coconut.jpg'),

            //seeds
            array('name' => 'chia seeds', 'ingredient_category_id'=> Config::get($seeds), 'ingredient_image_url' => 'chia-seeds.jpg'),

            //dairy
            array('name' => 'feta cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'feta-cheese-x200.jpg'),
            array('name' => 'goat cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'goats-cheese-soft-x200.jpg'),
            array('name' => 'egg', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'egg-x200.jpg'),
            array('name' => 'milk', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'milk.jpeg'),
            array('name' => 'cheddar cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'parmesan cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'rennet-free-parmesan-x200.jpg'),
            array('name' => 'halloumi cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'halloumi-x200.jpg'),
            array('name' => 'yoghurt', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'greek-yoghurt-x200.jpg'),
            array('name' => 'cream', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => ''),
            array('name' => 'sour cream', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'sour-cream-x200.jpg'),
            array('name' => 'cream cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'tofu-x200.jpg'),
            array('name' => 'salted butter', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'unsalted butter', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'butter', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'mozzarella', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'mozzarella-ball-x200.jpg'),
            array('name' => 'parmigiano cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'rennet-free-parmesan-x200.jpg'),
            array('name' => 'pecorino cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'clotted cream', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => ''),
            array('name' => 'mature cheddar cheese', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),

            //nuts
            array('name' => 'cashew nuts', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'Cashew_3.jpg'),
            array('name' => 'pignoli nuts', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'ttar_pinenuts_03_h_launch.jpg'),
            array('name' => 'walnut', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'walnut.jpg'),

            //misc
            array('name' => 'wonton wrappers', 'ingredient_category_id' => Config::get($misc), 'ingredient_image_url' => 'wontonwrappers.jpg'),




    );

        //To Be sorted into categories above
        \App\Ingredient::create(array('name' => 'basmati rice', 'ingredient_image_url' => 'basmati-rice.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Grain')->value('id')));
        \App\Ingredient::create(array('name' => 'sesame seeds', 'ingredient_image_url' => 'sesame-seeds.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Seeds')->value('id')));
        \App\Ingredient::create(array('name' => 'red wine vinegar', 'ingredient_image_url' => 'red-wine-vinegar.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Liquid')->value('id')));
        \App\Ingredient::create(array('name' => 'peanut butter', 'ingredient_image_url' => 'peanut-butter.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Nuts')->value('id')));
        \App\Ingredient::create(array('name' => 'toasted sesame oil', 'ingredient_image_url' => 'toasted-sesame-oil.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Oil')->value('id')));
        \App\Ingredient::create(array('name' => 'rice noodles', 'ingredient_image_url' => 'rice-noodles.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Grain')->value('id')));
        \App\Ingredient::create(array('name' => 'peanut', 'ingredient_image_url' => 'peanut.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Nuts')->value('id')));
        \App\Ingredient::create(array('name' => 'white rice vinegar', 'ingredient_image_url' => 'white-rice-vinegar.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Liquid')->value('id')));
        \App\Ingredient::create(array('name' => 'wheat noodle nest', 'ingredient_image_url' => 'wheat-noodle-nest.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Grain')->value('id')));
        \App\Ingredient::create(array('name' => 'white miso paste', 'ingredient_image_url' => 'white-miso-paste.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Misc')->value('id')));
        \App\Ingredient::create(array('name' => 'chestnut mushrooms', 'ingredient_image_url' => 'chestnut-mushrooms.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Vegetable')->value('id')));
        \App\Ingredient::create(array('name' => 'chicken stock cube', 'ingredient_image_url' => 'chicken-stock-cube.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Misc')->value('id')));
        \App\Ingredient::create(array('name' => 'pancetta lardons', 'ingredient_image_url' => 'pancetta-lardons.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Meat')->value('id')));
        \App\Ingredient::create(array('name' => 'dried bay leaves', 'ingredient_image_url' => 'dried-bay-leaves.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Herb')->value('id')));
        \App\Ingredient::create(array('name' => 'basa fillets', 'ingredient_image_url' => 'basa-fillets.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Meat')->value('id')));
        \App\Ingredient::create(array('name' => 'caper buds', 'ingredient_image_url' => 'caper-buds.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Spice')->value('id')));
        \App\Ingredient::create(array('name' => 'chorizo', 'ingredient_image_url' => 'chorizo.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Meat')->value('id')));
        \App\Ingredient::create(array('name' => 'apple cider vinegar', 'ingredient_image_url' => 'apple-cider-vinegar.jpg', 'ingredient_category_id' => IngredientCategory::where('name', '=', 'Liquid')->value('id')));


        foreach ($ingredients as $ingredient) {

            Ingredient::create(array(
                'name' => $ingredient['name'],
                'ingredient_category_id' => $ingredient['ingredient_category_id'],
                'ingredient_image_url' => $ingredient['ingredient_image_url'])
            );

            // DB::table('industries')->insert($industry);
        }


//        for($i = 0; $i < count($ingredients); $i++){
//            Ingredient::create(array(
//               'name' => $ingredients[$i]
//            ));
//        }
    }
}
