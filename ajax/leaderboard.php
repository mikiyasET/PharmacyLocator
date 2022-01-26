<?php
include_once '../mvc/connect.php';

?>
<p id="main-title">Top searched medicines</p>
<div id="main-content">
    <div class="mt-5">
        <table id="pharmacyTable" class="table table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Medicine Name</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $records = new RecordView();
            $counter = 0;
            foreach ($records->all() as $records) {
                $counter++;
                $medicine = new MedicineView();
                $medicine->id = $store['mid'];
                $medicineName = $medicine->one()->name;
                echo "
                    <tr>
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicineName)."</td>
                    </tr>
                    ";

            }
            ?>

            </tbody>
        </table>
    </div>
</div>