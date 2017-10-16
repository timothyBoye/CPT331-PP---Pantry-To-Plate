<?php

use Illuminate\Database\Seeder;
use App\Ingredient;
use App\IngredientCategory;

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
            array('name' => 'romaine lettuce',  'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cosberg-lettuce-x200.jpg'),
            array('name' => 'black olive',      'plural' => 'black olives', 'ingredient_category_id'=> Config::get($fruit), 'ingredient_image_url' => 'pitted-black-olives-x200.jpg'),
            array('name' => 'olive',            'plural' => 'olives', 'ingredient_category_id'=> Config::get($fruit), 'ingredient_image_url' => 'pitted-black-olives-x200.jpg'),
            array('name' => 'grape tomato',     'plural' => 'grape tomatoes', 'ingredient_category_id'=> Config::get($fruit), 'ingredient_image_url' => 'cherry-tomatoes-x200.jpg'),
            array('name' => 'pepper',           'plural' => 'peppers', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'purple onion',     'plural' => 'purple onions', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'purple-onion.jpg'),
            array('name' => 'beans',            'plural' => '', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'butter-beans-x200.jpg'),
            array('name' => 'bell pepper',      'plural' => 'bell peppers', 'ingredient_category_id' => Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'apple',            'plural' => 'apples', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'apple-2-x200.jpg'),
            array('name' => 'apricot',          'plural' => 'apricots', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'apricot.jpeg'),
            array('name' => 'avocado',          'plural' => 'avocados', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'avocado.jpg'),
            array('name' => 'banana',           'plural' => 'bananas', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'banana.jpg'),
            array('name' => 'bilberry',         'plural' => 'bilberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blueberry.jpg'),
            array('name' => 'blackberry',       'plural' => 'blackberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blackberry.jpg'),
            array('name' => 'blueberry',        'plural' => 'blueberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'blueberry.jpg'),
            array('name' => 'cherry',           'plural' => 'cherries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'cherries.jpg'),
            array('name' => 'cranberry',        'plural' => 'cranberries', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'dried-cranberries-x200.jpg'),
            array('name' => 'cucumber',         'plural' => 'cucumbers', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'cucumber-x200.jpg'),
            array('name' => 'dried apricot',    'plural' => 'dried apricots', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'Ingredients-DicedApricots_20422-2-x200 (1).jpg'),
            array('name' => 'grape',            'plural' => 'grapes', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'red-seedless-grapes-x200.jpg'),
            array('name' => 'lemon',            'plural' => 'lemons', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'lemon-x200.jpg'),
            array('name' => 'lime',             'plural' => 'limes', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'lime-x200.jpg'),
            array('name' => 'orange',           'plural' => 'oranges', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'orange-x200.jpg'),
            array('name' => 'tamarind',         'plural' => 'tamarinds', 'ingredient_category_id' => Config::get($fruit), 'ingredient_image_url' => 'tamarind-x200.jpg'),
            array('name' => 'arugula',          'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),
            array('name' => 'rocket leaves',    'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'rocket_salad_1024-x200.jpg'),
            array('name' => 'asparagus',        'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Asparagus-2-x200.jpg'),
            array('name' => 'eggplant',         'plural' => 'eggplants', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'aubergine-x200.jpg'),
            array('name' => 'mixed greens',     'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),

            //Legumes
            array('name' => 'black beans',      'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Black-beans2-x200.jpg'),
            array('name' => 'kidney beans',     'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'kidney-beans-x200.jpg'),
            array('name' => 'lentils',          'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-lentils-x200.jpg'),
            array('name' => 'butter beans',     'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'butter-beans-x200.jpg'),
            array('name' => 'peas',             'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'garden-peas-2-x200.jpg'),
            array('name' => 'snap peas',        'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'mange-tout-2-x200.jpg'),
            array('name' => 'green beans',      'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),

            //veg
            array('name' => 'celeriac',         'plural' => 'pumpkins', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'pumpkin',          'plural' => 'pumpkins', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'mangetout',        'plural' => 'mangetouts', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'cabbage',          'plural' => 'cabbages', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => ''),
            array('name' => 'broccoli',         'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'broccoli.jpg'),
            array('name' => 'cauliflower',      'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cauliflower.jpeg'),
            array('name' => 'celery',           'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'celery-stick-x200.jpg'),
            array('name' => 'kale',             'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'baby-kale-2-x200.jpg'),
            array('name' => 'mushroom',         'plural' => 'mushrooms', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'white-mushrooms-x200.jpg'),
            array('name' => 'portobello mushroom','plural' => 'portobello mushrooms', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'white-mushrooms-x200.jpg'),
            array('name' => 'chives',           'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'fresh-chives-x200.jpg'),
            array('name' => 'garlic',           'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'garlic-1712365_1280.jpg'),
            array('name' => 'onion',            'plural' => 'onions', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'onion-x200.jpg'),
            array('name' => 'red onion',        'plural' => 'red onions', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-onion-x200.jpg'),
            array('name' => 'shallot',          'plural' => 'shallots', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'shallot-x200.jpg'),
            array('name' => 'spring onion',     'plural' => 'spring onions', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spring-onion-x200.jpg'),
            array('name' => 'parsley',          'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'parsley.png'),
            array('name' => 'pepper',           'plural' => 'peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'BellPeppers.jpg'),
            array('name' => 'green pepper',     'plural' => 'green peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'green-pepper-x200.jpg'),
            array('name' => 'red pepper',       'plural' => 'red peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-pepper-x200.jpg'),
            array('name' => 'yellow pepper',    'plural' => 'yellow peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'yellow-pepper-x200.jpg'),
            array('name' => 'chili pepper',     'plural' => 'chili peppers', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'red-chilli-x200.jpg'),
            array('name' => 'green chili',      'plural' => 'green chilies', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'green-chili.jpg'),
            array('name' => 'paprika chili',    'plural' => 'paprika chilis', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'cayenne pepper',   'plural' => 'cayenne peppers', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'beetroot',         'plural' => 'beetroots', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'cooked-beetrot-4-x200.jpg'),
            array('name' => 'carrot',           'plural' => 'carrots', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'carrot-x200.jpg'),
            array('name' => 'ginger',           'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'fresh-ginger-x200.jpg'),
            array('name' => 'radish',           'plural' => 'radishes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'radish-x200.jpg'),
            array('name' => 'horseradish',      'plural' => 'horseradishes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'Horseradish-sauce-2-x200.jpg'),
            array('name' => 'spinach',          'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spinach-x200.jpg'),
            array('name' => 'baby spinach',     'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'spinach-x200.jpg'),
            array('name' => 'tomato',           'plural' => 'tomatoes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'tomato-x200.jpg'),
            array('name' => 'jerusalem artichoke','plural' => 'jerusalem artichokes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'artichoke-hearts-x200.jpg'),
            array('name' => 'potato',           'plural' => 'potatoes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'potatoes-x200.jpg'),
            array('name' => 'sweet potato',     'plural' => 'sweet potatoes', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'sweet-potato-x200.jpg'),
            array('name' => 'zucchini',         'plural' => 'zucchinis', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'courgette-x200.jpg'),
            array('name' => 'mixed vegetables', 'plural' => '', 'ingredient_category_id'=> Config::get($veg), 'ingredient_image_url' => 'mixvegitable_large.jpg'),
            array('name' => 'chestnut mushroom','plural' => 'chestnut mushrooms', 'ingredient_image_url' => 'chestnut-mushrooms.jpg', 'ingredient_category_id' => Config::get($veg)),

            //herbs
            array('name' => 'mint',             'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'mint.jpg'),
            array('name' => 'basil',            'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-basil-x200.jpg'),
            array('name' => 'coriander',        'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-coriander-x200.jpg'),
            array('name' => 'oregano',          'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'dried-oregano-x200.jpg'),
            array('name' => 'parsley',          'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-parsley-x200.jpg'),
            array('name' => 'rosemary',         'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'fresh-rosemary-x200.jpg'),
            array('name' => 'lemongrass stalk', 'plural' => 'lemongrass stalks', 'ingredient_image_url' => 'lemon-grass.jpeg', 'ingredient_category_id' => Config::get($herb)),
            array('name' => 'dried bay leaf',   'plural' => 'dried bay leaves', 'ingredient_image_url' => 'dried-bay-leaves.jpg', 'ingredient_category_id' => Config::get($herb)),
            array('name' => 'dried parsley',    'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'large_square_Parsley_Flakes__close.jpg'),
            array('name' => 'dried basil',      'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'dried-basil.jpg'),
            array('name' => 'dried oregano',    'plural' => '', 'ingredient_category_id'=> Config::get($herb), 'ingredient_image_url' => 'dried-oregano-x200.jpg'),

            //oils
            array('name' => 'olive oil',        'plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'olive-oil.jpg'),
            array('name' => 'extra virgin olive oil','plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'olive-oil.jpg'),
            array('name' => 'vegetable oil',    'plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'oil',              'plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'peanut oil',       'plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'sunflower oil',    'plural' => '', 'ingredient_category_id'=> Config::get($oil), 'ingredient_image_url' => 'veg-oil.jpg'),
            array('name' => 'toasted sesame oil','plural' => '', 'ingredient_image_url' => 'toasted-sesame-oil.jpg', 'ingredient_category_id' => Config::get($oil)),

            //condiments
            array('name' => 'sriracha sauce',   'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'spice-sauce-brown-bowl-isolated-white-background-closeup-72906255.jpg'),
            array('name' => 'hot sauce',        'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'tomato-paste-x200.jpg'),
            array('name' => 'balsamic vinegar', 'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),
            array('name' => 'mayonnaise',       'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'use-mayonnaise-facial-mask-1.jpg'),
            array('name' => 'condensed milk',   'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'condensed-milk.jpg'),
            array('name' => 'fish sauce',       'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'fish-sauce-x200.jpg'),
            array('name' => 'soy sauce',        'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),
            array('name' => 'oyster sauce',     'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'balsamic-vinegar-x200.jpg'),
            array('name' => 'french dijon mustard','plural' => '', 'ingredient_image_url' => 'french-dijon-mustard.jpg', 'ingredient_category_id' => Config::get($condiment)),
            array('name' => 'tandoori paste', 'plural' => '', 'ingredient_image_url' => 'tandoori-paste.jpg', 'ingredient_category_id' => Config::get($condiment)),

            //spices
            array('name' => 'garlic powder',    'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'garlic-powder-loose.jpg'),
            array('name' => 'onion powder',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'onion-powder.jpg'),
            array('name' => 'salt',             'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'sea-salt.jpg'),
            array('name' => 'black pepper',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'black-pepper.jpg'),
            array('name' => 'white pepper',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'WHITE_PEPPER_GROUND_1.jpg'),
            array('name' => 'chili flakes',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'chilli-flakes-250x250.jpg'),
            array('name' => 'paprika',          'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'paprika-x200.jpg'),
            array('name' => 'smoked paprika',   'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'cayenne pepper',   'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cayenne-pepper-x200.jpg'),
            array('name' => 'cumin',            'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cumin-seeds-x200.jpg'),
            array('name' => 'sumac',            'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'sumac-x200.jpg'),
            array('name' => 'cinnamon',         'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cinnamon.jpeg'),
            array('name' => 'ground cinnamon',  'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'ras-el-hanout-x200.jpg'),
            array('name' => 'mustard seeds',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'mustard.png'),
            array('name' => 'coriander seeds',   'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'coriander_seeds.jpeg'),
            array('name' => 'dill seeds',        'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => ''),
            array('name' => 'nutmeg',           'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'nutmeg.jpg'),
            array('name' => 'garam masala',     'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'garam_masala.jpeg'),
            array('name' => 'cardamom pod',     'plural' => 'cardamom pods', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'cardamom_pods.jpeg'),
            array('name' => 'turmeric',         'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'turmeric.jpg'),
            array('name' => 'red curry paste',  'plural' => '', 'ingredient_category_id'=> Config::get($spice), 'ingredient_image_url' => 'red-curry-paste.jpg'),
            array('name' => 'chili powder', 'plural' => '', 'ingredient_image_url' => 'chili-powder.jpg', 'ingredient_category_id' => Config::get($spice)),
            array('name' => 'caper bud', 'plural' => 'caper buds', 'ingredient_image_url' => 'caper-buds.jpg', 'ingredient_category_id' => Config::get($spice)),

            //sweeteners
            array('name' => 'sugar',            'plural' => '', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'bowl-of-sugar.jpg'),
            array('name' => 'maple syrup',      'plural' => '', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'fish-sauce-x200.jpg'),
            array('name' => 'erythritol',       'plural' => '', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'bowl-of-sugar.jpg'),
            array('name' => 'honey',            'plural' => '', 'ingredient_category_id'=> Config::get($condiment), 'ingredient_image_url' => 'honey-pot-x200.jpg'),
            array('name' => 'brown sugar',      'plural' => '', 'ingredient_category_id'=> Config::get($sweetener), 'ingredient_image_url' => 'brown-sugar.jpg'),
            array('name' => 'palm sugar',       'plural' => '', 'ingredient_image_url' => 'palm-sugar.jpeg', 'ingredient_category_id' => Config::get($sweetener)),

            //liquids
            array('name' => 'water',            'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'rice-vinegar-x200.jpg'),
            array('name' => 'lime juice',       'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'lime-juice.jpg'),
            array('name' => 'lemon juice',      'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'benefits-of-lemon1.jpg'),
            array('name' => 'coconut milk',     'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'coconut-milk.jpeg'),
            array('name' => 'shaoxing wine',    'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'fish-sauce-x200.jpg'),
            array('name' => 'vegetable stock',  'plural' => '', 'ingredient_category_id'=> Config::get($liquid), 'ingredient_image_url' => 'veg-stock.jpg'),
            array('name' => 'white wine vinegar','plural' => '', 'ingredient_image_url' => 'white-wine-vinegar.jpg', 'ingredient_category_id' => Config::get($liquid)),
            array('name' => 'white rice vinegar','plural' => '', 'ingredient_image_url' => 'white-rice-vinegar.jpg', 'ingredient_category_id' => Config::get($liquid)),
            array('name' => 'mirin rice wine',  'plural' => '', 'ingredient_image_url' => 'red-wine-vinegar.jpg', 'ingredient_category_id' => Config::get($liquid)),
            array('name' => 'red wine vinegar', 'plural' => '', 'ingredient_image_url' => 'red-wine-vinegar.jpg', 'ingredient_category_id' => Config::get($liquid)),
            array('name' => 'apple cider vinegar','plural' => '', 'ingredient_image_url' => 'apple-cider-vinegar.jpg', 'ingredient_category_id' => Config::get($liquid)),

            //meats
            array('name' => 'lamb chop',        'plural' => 'lamb chops', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'lamb-chop.jpg'),
            array('name' => 'pork chop',       'plural' => 'pork chops', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'pork-loin-steaks-x200.jpg'),
            array('name' => 'pork',             'plural' => '', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'pork-loin-steaks-x200.jpg'),
            array('name' => 'pork chorizo sausage','plural' => 'pork chorizo sausages', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'mini-cooking-chorizo-x200.jpg'),
            array('name' => 'rump steak',       'plural' => 'rump steaks', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'rump-steak.jpg'),
            array('name' => 'salmon',           'plural' => '', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'salmon.jpg'),
            array('name' => 'prawn',            'plural' => 'prawns', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'king-prawns-x200.jpg'),
            array('name' => 'chicken breast',   'plural' => 'chicken breasts', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'British-diced-chicken-breast-2-x200.jpg'),
            array('name' => 'chicken thigh',   'plural' => 'chicken thighs', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'British-chicken-thighs-with-skin-2-x200.jpg'),
            array('name' => 'bacon',            'plural' => '', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'bacon.jpg'),
            array('name' => 'speck',            'plural' => '', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'speck.jpg'),
            array('name' => 'crab',             'plural' => '', 'ingredient_category_id'=> Config::get($meat), 'ingredient_image_url' => 'carb.jpeg'),
            array('name' => 'pancetta lardon',  'plural' => 'pancetta lardons', 'ingredient_image_url' => 'pancetta-lardons.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'basa fillet',      'plural' => 'bassa fillets', 'ingredient_image_url' => 'basa-fillets.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'chorizo',          'plural' => '', 'ingredient_image_url' => 'chorizo.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'beef mince',       'plural' => '', 'ingredient_image_url' => 'beef-mince.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'white fish',       'plural' => '', 'ingredient_image_url' => 'white-fish.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'trout',            'plural' => '', 'ingredient_image_url' => 'trout.jpg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'brisket',          'plural' => '', 'ingredient_image_url' => 'brisket.jpeg', 'ingredient_category_id' => Config::get($meat)),
            array('name' => 'pork mince',       'plural' => '', 'ingredient_image_url' => 'pork-mince.jpeg', 'ingredient_category_id' => Config::get($meat)),

            //grains
            array('name' => 'sourdough bread',  'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'sourdough.jpg'),
            array('name' => 'corn tortilla',    'plural' => 'corn tortillas', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'Taco_CrispyCornTortilla.jpg'),
            array('name' => 'farfalle pasta',   'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'farfalle-pasta.jpeg'),
            array('name' => 'arborio rice',     'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'arborio-rice-x200.jpg'),
            array('name' => 'fettuccine',       'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'fettuccine.jpg'),
            array('name' => 'couscous',         'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'couscous.jpg'),
            array('name' => 'rice',             'plural' => '', 'ingredient_category_id'=> Config::get($grain), 'ingredient_image_url' => 'arborio-rice-x200.jpg'),

            //baking
            array('name' => 'whole wheat flour','plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'whole_wheat_flour.jpeg'),
            array('name' => 'chickpea flour',   'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'chickpea_flour.jpeg'),
            array('name' => 'all-purpose flour','plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'plain flour',      'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'coconut flour',    'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'coconut-flour.jpg'),
            array('name' => 'cornflour',        'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'baking soda',      'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'baking-soda.jpeg'),
            array('name' => 'baking powder',    'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'baking-soda.jpeg'),
            array('name' => 'vanilla',          'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'vanilla.jpg'),
            array('name' => 'powdered chocolate milk mix', 'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'Cacao-powder-and-coconut-sugar.jpg'),
            array('name' => 'cocoa powder',     'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'ras-el-hanout-x200.jpg'),
            array('name' => 'corn starch',      'plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'cornflour-x200.jpg'),
            array('name' => 'dessicated coconut','plural' => '', 'ingredient_category_id'=> Config::get($baking), 'ingredient_image_url' => 'dessicated_coconut.jpg'),
            array('name' => 'self raising flour', 'plural' => '', 'ingredient_image_url' => 'self-raising-flour.jpg', 'ingredient_category_id' => Config::get($baking)),

            //seeds
            array('name' => 'chia seeds',       'plural' => '', 'ingredient_category_id'=> Config::get($seeds), 'ingredient_image_url' => 'chia-seeds.jpg'),
            array('name' => 'clove',            'plural' => 'cloves', 'ingredient_image_url' => 'clove.jpeg', 'ingredient_category_id' => Config::get($seeds)),
            array('name' => 'sesame seed',     'plural' => 'sesame seeds', 'ingredient_image_url' => 'sesame-seeds.jpg', 'ingredient_category_id' => Config::get($seeds)),

            //dairy
            array('name' => 'feta cheese',      'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'feta-cheese-x200.jpg'),
            array('name' => 'goat cheese',      'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'goats-cheese-soft-x200.jpg'),
            array('name' => 'egg',              'plural' => 'eggs', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'egg-x200.jpg'),
            array('name' => 'milk',             'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'milk.jpeg'),
            array('name' => 'cheddar cheese',   'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'cheese',           'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'parmesan cheese',  'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'rennet-free-parmesan-x200.jpg'),
            array('name' => 'halloumi cheese',  'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'halloumi-x200.jpg'),
            array('name' => 'yoghurt',          'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'greek-yoghurt-x200.jpg'),
            array('name' => 'sour cream',       'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'sour-cream-x200.jpg'),
            array('name' => 'cream',            'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'sour-cream-x200.jpg'),
            array('name' => 'cream cheese',     'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'tofu-x200.jpg'),
            array('name' => 'salted butter',    'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'unsalted butter',  'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'butter',           'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'butter.jpg'),
            array('name' => 'mozzarella',       'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'mozzarella-ball-x200.jpg'),
            array('name' => 'parmigiano cheese','plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'rennet-free-parmesan-x200.jpg'),
            array('name' => 'pecorino cheese',  'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),
            array('name' => 'clotted cream',    'plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'clotted-cream-2-x200.jpg'),
            array('name' => 'mature cheddar cheese','plural' => '', 'ingredient_category_id' => Config::get($dairy), 'ingredient_image_url' => 'cheddar-cheese-x200.jpg'),

            //nuts
            array('name' => 'cashew nuts',       'plural' => '', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'Cashew_3.jpg'),
            array('name' => 'pine nuts',         'plural' => '', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'ttar_pinenuts_03_h_launch.jpg'),
            array('name' => 'walnuts',           'plural' => '', 'ingredient_category_id' => Config::get($nuts), 'ingredient_image_url' => 'walnut.jpg'),
            array('name' => 'almonds',           'plural' => '', 'ingredient_image_url' => 'almonds.jpeg', 'ingredient_category_id' => Config::get($nuts)),
            array('name' => 'peanuts',           'plural' => '', 'ingredient_image_url' => 'peanut.jpg', 'ingredient_category_id' => Config::get($nuts)),
            array('name' => 'peanut butter',    'plural' => '', 'ingredient_image_url' => 'peanut-butter.jpg', 'ingredient_category_id' => Config::get($nuts)),

            //misc
            array('name' => 'wonton wrapper',   'plural' => 'wonton wrappers', 'ingredient_category_id' => Config::get($misc), 'ingredient_image_url' => 'wontonwrappers.jpg'),
            array('name' => 'white miso paste', 'plural' => '', 'ingredient_image_url' => 'white-miso-paste.jpg', 'ingredient_category_id' => Config::get($misc)),
            array('name' => 'chicken stock cube','plural' => 'chicken stock cube', 'ingredient_image_url' => 'chicken-stock-cube.jpg', 'ingredient_category_id' => Config::get($misc)),
            array('name' => 'vegetable stock cube','plural' => 'chicken stock cube', 'ingredient_image_url' => 'chicken-stock-cube.jpg', 'ingredient_category_id' => Config::get($misc)),
            array('name' => 'jasmine rice',     'plural' => '', 'ingredient_image_url' => 'jasmine-rice.jpeg', 'ingredient_category_id' => Config::get($grain)),
            array('name' => 'basmati rice',     'plural' => '', 'ingredient_image_url' => 'basmati-rice.jpg', 'ingredient_category_id' => Config::get($grain)),
            array('name' => 'rice noodles',     'plural' => '', 'ingredient_image_url' => 'rice-noodles.jpg', 'ingredient_category_id' => Config::get($grain)),
            array('name' => 'wheat noodle nest','plural' => '', 'ingredient_image_url' => 'wheat-noodle-nest.jpg', 'ingredient_category_id' => Config::get($grain)),
            array('name' => 'panko breadcrumbs','plural' => '', 'ingredient_image_url' => 'panko-breadcrumbs.jpg', 'ingredient_category_id' => Config::get($grain))
        );

        foreach ($ingredients as $ingredient) {

            Ingredient::create(array(
                'name' => $ingredient['name'],
                'ingredient_category_id' => $ingredient['ingredient_category_id'],
                'ingredient_image_url' => $ingredient['ingredient_image_url'],
                'plural' => $ingredient['plural'])
            );

        }

    }
}
