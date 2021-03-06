<!-- Displays nutritional info table on recipe page -->
<div>
    <table class="table table-responsive borderless">
        <caption class = "nutritional-table-heading">NUTRITION</caption>
        <!-- Column headings -->
        <thead>
            <tr class="uppercase">
                <th>Calories</th>
                <th>Protein</th>
                <th>Total Fat</th>
                <!-- Column headers - desktop view -->
                <th class=" show-desktop">Carbohydrates</th>
                <th class="show-desktop">Fiber </th>
                <th class="show-desktop">Sodium </th>
            </tr>
        </thead>
        <!-- Nutrient details -->
        <tbody>
            <tr class = "green-text">
                <td>{{$nutritional_info_panel->calories}}</td>
                <td>{{$nutritional_info_panel->gram_protein == null ? 'unknown' : $nutritional_info_panel->gram_protein}}g</td>
                <td>{{$nutritional_info_panel->gram_total_fat == null ? 'unknown' : $nutritional_info_panel->gram_total_fat}}g</td>
                <td class = "show-desktop">{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</td>
                <td class="show-desktop">{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</td>
                <td class="show-desktop">{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</td>
            </tr>
            <!-- Additional breakdown for fats and sugars -->
            <tr>
                <td></td>
                <td></td>
                <td class="small">{{$nutritional_info_panel->gram_saturated_fat}} (saturated)</td>
                <td class="small show-desktop">{{$nutritional_info_panel->gram_sugars}} (sugars)</td>
                <td class="show-desktop"></td>
                <td class="show-desktop"></td>
            </tr>
        </tbody>
        <!-- Second header row for more compact mobile view -->
        <thead>
        <tr class="uppercase">
            <th class="show-mobile">Carbohydrates</th>
            <th class="show-mobile">Fiber </th>
            <th class="show-mobile">Sodium </th>
        </tr>
        </thead>
        <!-- Nutrient details -->
        <tbody>
        <tr class = "green-text">
            <td class ="show-mobile">{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</td>
            <td class="show-mobile">{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</td>
            <td class="show-mobile">{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</td>
        </tr>
        <tr>
            <!-- Additional breakdown for sugars on mobile -->
            <td class=" small show-mobile">{{$nutritional_info_panel->gram_sugars}} (sugars)</td>
            <td class="show-mobile"></td>
            <td class="show-mobile"></td>
        </tr>
        </tbody>
    </table>
</div>
