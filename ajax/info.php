<?php
include_once '../mvc/connect.php';

$medicines = new MedicineView();
$medicines->name = $_POST['query'];
$medicines->id = $medicines->getID();
$medicine = $medicines->one();

echo "<div class=\"modal-header\">
        <h5 class=\"modal-title text-center\" id=\"detailsModalLabel\">{$medicine->name}</h5>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
    </div>
    <div class=\"modal-body\">
    <img src='assets/images/medicines/{$medicine->img}' width='100%' height='450' alt='{$medicine->name} Image'>
    <pre class='mt-3' style='white-space: pre-wrap;'>{$medicine->description}</pre>
    </div>
    <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
    </div>";