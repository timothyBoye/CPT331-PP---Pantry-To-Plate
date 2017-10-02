<div>
    <table class="table table-bordered">
        <caption>Nutritional Information</caption>

        <thead>
            <tr>
                <th>Calories</th>
                <th>Protein (g)</th>
                <th>Total Fat (g)</th>
                <th>Carbohydrates (g)</th>
                <th>Fiber (g)</th>
                <th>Sodium (mg)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$nutritional_info_panel->calories}}</td>
                <td>{{$nutritional_info_panel->gram_protein == null ? 'unknown' : $nutritional_info_panel->gram_protein}}</td>
                <td>{{$nutritional_info_panel->gram_total_fat == null ? 'unknown' : $nutritional_info_panel->gram_total_fat}}</td>
                <td>{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}</td>
                <td>{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}</td>
                <td>{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}</td>
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