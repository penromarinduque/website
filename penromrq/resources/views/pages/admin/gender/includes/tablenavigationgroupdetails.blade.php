<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="min-width: 100px;"> LEVEL </th>
            <th class="text-center" style="min-width: 150px;"> GROUP </th>
            <th class="text-center" style="min-width: 200px;"> DESCRIPTION </th>
            <th class="text-center" style="min-width: 100px;"> PATH </th>
            <th class="text-center" style="min-width: 100px;"> BLADE </th>
            <th class="text-center" style="min-width: 100px;"> LINK </th>
            <th class="text-center" style="min-width: 100px;" title="Open in new tab"> TAB </th>
            <th class="text-center" style="min-width: 100px;" title="With Dropdown"> TYPE </th>
            <th class="text-center" style="min-width: 100px;"> STATUS </th>
            <th class="text-center" style="min-width: 100px;"> ACTION </th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $GenderNavBarDetails = app('GenderNavBarDetails')
                                        ->where('detail_level', '1')
                                        ->where('detail_parent', '0')
                                        ->orderBy('order_level','desc')->get();
        ?>
        @include('pages.admin.gender.includes.navigationgroupdetailstable', ['GenderNavBarDetails' => $GenderNavBarDetails])
    </tbody>
</table>