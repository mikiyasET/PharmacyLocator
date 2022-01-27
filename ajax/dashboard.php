<?php
include_once '../mvc/connect.php';

$medicine = new MedicineView();
$location = new LocationView();
$pharmacy = new PharmacyView();
$user = new UsersView();

$mc = count($medicine->all());
$lc = count($location->all());
$pc = count($pharmacy->all());
$uc = count($user->all());

?>
<p id="main-title">Dashboard</p>
<div id="main-content">
    <div class="row">
        <div class="col-md-4">
            <div class="dash-box" title="Medicines">
                <span class="material-icons-outlined">local_pharmacy</span>
                <p><?php echo $mc; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dash-box" title="Locations">
                <span class="material-icons-outlined">place</span>
                <p><?php echo $lc; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dash-box" title="Pharmacies">
                <span class="material-icons-outlined">local_hospital</span>
                <p><?php echo $pc; ?></p>
            </div>
        </div>
        <div class="col-md-4 mt-5">
            <div class="dash-box" title="Users">
                <span class="material-icons-outlined">groups</span>
                <p><?php echo $uc; ?></p>
            </div>
        </div>
    </div>
</div>