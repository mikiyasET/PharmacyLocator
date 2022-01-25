<?php
include_once '../mvc/connect.php';


if (isset($_POST['submit'])) {
    $admin = new AdminController();
    $store = new StoreController();
    $medicine = new MedicineController();
    $pharmacy = new PharmacyController();
    $location = new LocationController();


    $adminv = new AdminView();
    $storev = new StoreView();
    $medicinev = new MedicineView();
    $pharmacyv = new PharmacyView();
    $locationv = new LocationView();


    $id = $_POST['id'];
    $adminv->id = $admin->id = $id ?? '';
    $storev->id = $store->id = $id ?? '';
    $medicinev->id = $medicinev->id = $id ?? '';
    $pharmacyv->id = $pharmacy->id = $id ?? '';
    $locationv->id = $location->id = $id ?? '';

    switch ($_POST['submit']) {
        case 'addLocation':
            $location->name = $locationv->name = $_POST['name'];
            if (!$locationv->checkName()) {
                echo $location->add() ? 'locationSuccess' : 'errorDefault';
            }else {
                echo 'locationNameExist';
            }
            break;

        case 'editLocation':
            $location->name = $locationv->name = $_POST['name'];
            if ($locationv->checkID()) {
                if (!$locationv->checkNameExceptThis()) {
                    echo $location->edit() ? 'editLocationSuccess' : 'errorDefault';
                }else {
                    echo 'locationNameExist';
                }
            }else {
                echo 'editLocationUnknownID';
            }
            break;

        case 'removeLocation':
            if ($locationv->checkID()) {
                echo $location->remove() ? 'success' : 'failure';
            } else {
                echo 'unknownID';
            }
            break;

        default:
            echo 'errorDefault';
    }

}