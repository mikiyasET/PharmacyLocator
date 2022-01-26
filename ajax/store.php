<?php
include_once '../mvc/connect.php';

$data = $_GET['func'] ?? '';
$id = $_GET['id'] ?? '';

if ($data == 'add') {
    ?>
    <div class="mt-5">
        <table id="pharmacyTable" class="table table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Medicine Name</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $medicines = new MedicineView();
            $counter = 0;
            foreach ($medicines->all() as $medicine) {
                $counter++;
                echo "
                    <tr onclick=\"addStore('".$medicine['mid']."')\">
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicine['name'])."</td>
                        <td title='".$medicine['description']."'>".substr($medicine['description'],0,25)."</td>
                    </tr>
                    ";

            }
            ?>

            </tbody>
        </table>
    </div>
    <?php
}
else if ($data == 'remove') {
    ?>
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
            $stores = new StoreView();
            $counter = 0;
            foreach ($stores->all() as $store) {
                $counter++;
                $medicine = new MedicineView();
                $medicine->id = $store['mid'];
                $medicineName = $medicine->one()->name;
                echo "
                    <tr onclick=\"remove('store','".$store['sid']."')\">
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicineName)."</td>
                    </tr>
                    ";

            }
            ?>

            </tbody>
        </table>
    </div>
    <?php
}
else {
    ?>
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
            $stores = new StoreView();
            $counter = 0;
            foreach ($stores->all() as $store) {
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
    <?php
}
?>
<script>
    $(document).ready(function() {
        $('#pharmacyTable').DataTable();
    })
</script>
