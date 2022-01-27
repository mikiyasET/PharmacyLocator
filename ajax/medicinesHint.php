<?php
include_once '../mvc/connect.php';

$searchKey = $_GET['q'];
$medicines = new MedicineView();
$medicines->name = $searchKey;
$result = $medicines->search();

foreach ($result as $medicine) {
    echo "<option value='".$medicine['name']."'></option>";
}
