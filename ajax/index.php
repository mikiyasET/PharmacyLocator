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
        case 'addPharmacy':
            $pharmacy->name = $pharmacyv->name = $_POST['name'] ?? '';
            $pharmacy->email = $pharmacyv->email = $_POST['email'] ?? '';
            $pharmacy->location = $_POST['location'] ?? '';
            $pharmacy->mapLink = $_POST['mapLink'] ?? '';
            $pharmacy->password = $_POST['password'] ?? '';
            if (filter_var($pharmacy->email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($pharmacy->password) >= 8) {
                    if (!$pharmacyv->checkNameEmail()) {
                        echo $pharmacy->add() ? 'pharmacySuccess' : 'errorDefault';
                    } else {
                        echo 'pharmacyNameEmailExist';
                    }
                } else {
                    echo 'passwordLength';
                }
            } else {
                echo 'emailError';
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
        case 'editPharmacy':
            $pharmacy->name = $pharmacyv->name = $_POST['name'] ?? '';
            $pharmacy->email = $pharmacyv->email = $_POST['email'] ?? '';
            $pharmacy->location = $_POST['location'] ?? '';
            $pharmacy->mapLink = $_POST['mapLink'] ?? '';
            if ($pharmacyv->checkID()) {
                if (filter_var($pharmacy->email, FILTER_VALIDATE_EMAIL)) {
                    if (!$pharmacyv->checkNameEmailExceptThis()) {
                        echo $pharmacy->edit() ? 'editPharmacySuccess' : 'errorDefault2';
                    } else {
                        echo 'pharmacyNameEmailExist';
                    }
                } else {
                    echo 'emailError';
                }
            }else {
                echo 'editPharmacyUnknownID';
            }
            break;

        case 'removeLocation':
            if ($locationv->checkID()) {
                echo $location->remove() ? 'success' : 'failure';
            } else {
                echo 'unknownID';
            }
            break;
        case 'removeMedicine':
            if ($medicinev->checkID()) {
                echo $medicine->remove() ? 'success' : 'failure';
            } else {
                echo 'unknownID';
            }
            break;
        case 'removePharmacy':
            if ($pharmacyv->checkID()) {
                echo $pharmacy->remove() ? 'success' : 'failure';
            } else {
                echo 'unknownID';
            }
            break;
        case 'removeStore':
            if ($storev->checkID()) {
                echo $store->remove() ? 'success' : 'failure';
            } else {
                echo 'unknownID';
            }
            break;

        default:
            echo 'errorDefault';
    }

}