<?php
include_once '../mvc/connect.php';

?>
<p id="main-title">Top searched medicines</p>
<div id="main-content">
    <div class="mt-2">
        <table id="pharmacyTable" class="table table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">Rank</th>
                <th scope="col">Medicine Name</th>
                <th scope="col">Searched</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $records = new RecordView();
            $counter = 0;

            foreach ($records->all() as $record) {
                $counter++;
                echo "
                    <tr>
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($record['name'])."</td>
                        <td>".$record['searched']." Times</td>
                    </tr>
                    ";

            }
            ?>

            </tbody>
        </table>
    </div>
</div>