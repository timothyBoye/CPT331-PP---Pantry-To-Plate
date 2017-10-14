{{--<div>--}}
    {{--<table class="table table-responsive borderless">--}}
        {{--<caption class = "nutritional-table-heading">NUTRITION</caption>--}}

        {{--<thead class="visible-lg-3">--}}
            {{--<tr class = "green-text">--}}
                {{--<th>{{$nutritional_info_panel->calories}}</th>--}}
                {{--<th>{{$nutritional_info_panel->gram_protein == null ? 'unknown' : $nutritional_info_panel->gram_protein}}g</th>--}}
                {{--<th>{{$nutritional_info_panel->gram_total_fat == null ? 'unknown' : $nutritional_info_panel->gram_total_fat}}g</th>--}}
                {{--<th>{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</th>--}}
                {{--<th class="visible-md visible-lg">{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</th>--}}
                {{--<th class="visible-md visible-lg">{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</th>--}}
            {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--<tr class="uppercase">--}}
                {{--<td>Calories</td>--}}
                {{--<td>Protein</td>--}}
                {{--<td>Total Fat</td>--}}
                {{--<td>Carbohydrates</td>--}}
                {{--<td class="visible-md visible-lg">Fiber </td>--}}
                {{--<td class="visible-md visible-lg">Sodium </td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
                {{--<td class="small">{{$nutritional_info_panel->gram_saturated_fat}} (saturated)</td>--}}
                {{--<td class="small">{{$nutritional_info_panel->gram_sugars}} (sugars)</td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
            {{--</tr>--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--</div>--}}

<div class = "nutritional-table-heading">NUTRITION</div>

<div class = "line"></div>
<div class = "nut-numbers">
    <ul style="list-style: none outside none;">
        <li class = "table-row" >{{$nutritional_info_panel->calories}}</li>
        <li class = "table-row-left" >{{$nutritional_info_panel->gram_protein == null ? 'unknown' : $nutritional_info_panel->gram_protein}}g</li>
        <li class = "table-row-left" >{{$nutritional_info_panel->gram_total_fat == null ? 'unknown' : $nutritional_info_panel->gram_total_fat}}g</li>
        <li class = "table-row-left show-desktop" >{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</li>
        <li class = "table-row-left show-desktop" >{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</li>
        <li class = "table-row-left show-desktop" >{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</li>
    </ul>
</div>
<div class = "nut-names">
    <ul style="list-style: none outside none;">
        <li class = "table-row" >Calories</li>
        <li class = "table-row-left" >Protein</li>
        <li class = "table-row-left" >Total Fat</li>
        <li class = "table-row-left show-desktop" >Carbs</li>
        <li class = "table-row-left show-desktop" >Fiber </li>
        <li class = "table-row-left show-desktop" >Sodium </li>
    </ul>
</div>
<div>
    <ul>
        <li class = "table-row"></li>
        <li class = "table-row-left"></li>
        <li class="small table-row-left">{{$nutritional_info_panel->gram_saturated_fat}} (saturated)</li>
        <li class="small table-row-left show-desktop">{{$nutritional_info_panel->gram_sugars}} (sugars)</li>
        <li class = "table-row-left show-desktop"></li>
        <li class = "table-row-left show-desktop"></li>
    </ul>
</div>


{{-- On Mobile View--}}
<div class = "nut-numbers">
    <ul>
        <li class = "table-row-height show-mobile" >{{$nutritional_info_panel->gram_total_carbohydrates == null ? 'unknown' : $nutritional_info_panel->gram_total_carbohydrates}}g</li>
        <li class = "table-row-height show-mobile" >{{$nutritional_info_panel->gram_fiber == null ? 'unknown' : $nutritional_info_panel->gram_fiber}}g</li>
        <li class = "table-row-height show-mobile" >{{$nutritional_info_panel->mg_sodium == null ? 'unknown' : $nutritional_info_panel->mg_sodium}}mg</li>
    </ul>
</div>
<div class = "nut-names">
    <ul>
        <li class = "table-row-height show-mobile" >Carbs</li>
        <li class = "table-row-height show-mobile" >Fiber </li>
        <li class = "table-row-height show-mobile" >Sodium </li>
    </ul>
</div>
<div>
    <ul>
        <li class="small table-row-height show-mobile">{{$nutritional_info_panel->gram_sugars}} (sugars)</li>
        <li class = "table-row-height show-mobile"></li>
        <li class = "table-row-height show-mobile"></li>
    </ul>
</div>