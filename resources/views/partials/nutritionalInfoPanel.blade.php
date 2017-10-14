<div>
    <table class="table table-responsive borderless">
        <caption class = "nutritional-table-heading">NUTRITION</caption>

        <thead class="visible-lg-3">
            <tr class = "green-text">
                <th>{{$nutritional_info_panel->calories}}</th>
                <th>{{$nutritional_info_panel->gram_protein == null ? 'unknown' : $nutritional_info_panel->gram_protein}}g</th>
                <th>{{$nutritional_info_panel->gram_total_fat == null ? 'unknown' : $nutritional_info_panel->gram_total_fat}}g</th>
                <th>{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</th>
                <th class="visible-md visible-lg">{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</th>
                <th class="visible-md visible-lg">{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</th>
            </tr>
        </thead>
        <tbody>
            <tr class="uppercase">
                <td>Calories</td>
                <td>Protein</td>
                <td>Total Fat</td>
                <td>Carbohydrates</td>
                <td class="visible-md visible-lg">Fiber </td>
                <td class="visible-md visible-lg">Sodium </td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="small">{{$nutritional_info_panel->gram_saturated_fat}} (saturated)</td>
                <td class="small">{{$nutritional_info_panel->gram_sugars}} (sugars)</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>