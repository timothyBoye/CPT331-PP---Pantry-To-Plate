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
        DB::table('ingredients')->delete();

        $fruit = 'constants.fruit_category_id';
        $veg = 'constants.veg_category_id';
        $dairy = 'constants.dairy_category_id';
        $herb = 'constants.herb_category_id';
        $spice = 'constants.spice_category_id';
        $meat = 'constants.meat_category_id';

        $ingredients = array(
            array('name' => 'romaine lettuce', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'black olives', 'ingredient_category_id'=> Config::get($fruit)),
            array('name' => 'grape tomatoes', 'ingredient_category_id'=> Config::get($fruit)),
            array('name' => 'pepper', 'ingredient_category_id' => Config::get($veg)),
            array('name' => 'purple onion', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'beans', 'ingredient_category_id' => Config::get($spice)),
            array('name' => 'feta cheese', 'ingredient_category_id' => Config::get($dairy)),
            array('name' => 'apple', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'apricot', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'avocado', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'banana', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'bilberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'blackberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'blackcurrant', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'blueberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'boysenberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'cherry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'currant', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'chico fruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'coconut', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'cranberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'cucumber', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'sugar apple', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'damson', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'date', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'dragonfruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'durian', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'elderberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'fig', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'goji berry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'gooseberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'grape', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'raisin', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'grapefruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'guava', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'honeyberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'huckleberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'jabuticaba', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'jackfruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'jambul', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'jujube', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'juniper berry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'kiwifruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'kumquat', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'lemon', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'lime', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'longan', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'lychee', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'mango', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'marionberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'melon', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'cantaloupe', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'honeydew', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'watermelon', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'miracle fruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'mulberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'nectarine', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'nance', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'olive', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'orange', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'clementine', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'mandarine', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'tangerine', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'papaya', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'passionfruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'peach', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'pear', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'persimmon', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'physalis', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'plantain', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'plum', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'prune', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'plumcot', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'pomegranate', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'pineapple', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'pomelo', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'purple mangosteen', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'quince', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'raspberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'salmonberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'rambutan', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'redcurrant', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'salal berry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'salak', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'satsuma', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'soursop', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'star fruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'solanum quitoense', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'strawberry', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'tamarillo', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'tamarind', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'ugli fruit', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'yuzu', 'ingredient_category_id' => Config::get($fruit)),
            array('name' => 'artichoke', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'arugula', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'asparagus', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'aubergine', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'eggplant', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'amaranth', 'ingredient_category_id'=> Config::get($veg)),
            //Legumes
            array('name' => 'alfalfa sprouts', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'azuki beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'bean sprouts', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'black beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'black-eyed peas', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'borlotti bean', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'broad beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'chickpeas', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'garbanzos', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'green beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'kidney beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'lentils', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'lima beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'butter bean', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'mung beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'navy beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'pinto beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'runner beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'split peas', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'soy beans', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'peas', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'mangetout', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'snap peas', 'ingredient_category_id'=> Config::get($veg)),
            //veg
            array('name' => 'beet greens', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'bok choy', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'broccoflower', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'broccoli', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'brussels sprouts', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'cabbage', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'calabrese', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'carrots', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'cauliflower', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'celery', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'chard', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'collard greens', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'endive', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'fiddleheads', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'frisee', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'fennel', 'ingredient_category_id'=> Config::get($veg)),
            //herbs
            array('name' => 'anise', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'basil', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'cilantro', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'coriander', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'chamomile', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'dill', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'fennel', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'lemon grass', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'marjoram', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'oregano', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'parsley', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'rosemary', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'sage', 'ingredient_category_id'=> Config::get($herb)),
            array('name' => 'thyme', 'ingredient_category_id'=> Config::get($herb)),
            //veg
            array('name' => 'kale', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'kohlrabi', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'sweetcorn', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'sorn', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'mushrooms', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'okra', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'nettles', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'mustard greens', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'chives', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'garlic', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'leek', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'onion', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'shallot', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'spring onion', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'green onion', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'parsley', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'peppers', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'green pepper', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'red pepper', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'chili pepper', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'capsicum', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'jalapeño', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'habanero', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'paprika', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'tabasco pepper', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'cayenne pepper', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'radicchio', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'rhubarb', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'root vegetables', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'beetroot', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'scallion', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'beet', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'carrot', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'celeriac', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'daikon', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'ginger', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'parsnip', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'rutabaga', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'turnip', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'radish', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'wasabi', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'horseradish', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'white radish', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'swede', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'salsify', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'skirret', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'spinach', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'topinambur', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'acorn squash', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'butternut squash', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'banana squash\'', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'courgette', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'cucumber', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'delicata', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'marrow', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'hubbard squash', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'squash', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'pumpkin', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'spaghetti squash', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'tat soi', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'tomato', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'tubers', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'jicama', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'jerusalem artichoke', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'potato', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'quandong', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'sunchokes', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'sweet potato', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'taro', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'turnip greens', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'water chestnut', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'watercress', 'ingredient_category_id'=> Config::get($veg)),
            array('name' => 'zucchini', 'ingredient_category_id'=> Config::get($veg))
        );

        foreach ($ingredients as $ingredient) {

            Ingredient::create(array(
                'name' => $ingredient['name'],
                'ingredient_category_id' => $ingredient['ingredient_category_id'])
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
