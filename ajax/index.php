<?php
include_once '../mvc/connect.php';

function uploadFile($file) {
    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = APP_ROOT.'/assets/images/medicines/'; // upload directory
    if($file)
    {
        $img = $file['name'];
        $tmp = $file['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = uniqid().$img;
        // check's valid format
        if(in_array($ext, $valid_extensions))
        {
            $path = $path.strtolower($final_image);
            if(move_uploaded_file($tmp,$path))
            {
                return $final_image;
            }
        }
        else
        {
            return '';
        }
    }
}
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


    $id = $_POST['id'] ?? null;
    $adminv->id = $admin->id = $id ?? '';
    $storev->id = $store->id = $id ?? '';
    $medicinev->id = $medicine->id = $id ?? '';
    $pharmacyv->id = $pharmacy->id = $id ?? '';
    $locationv->id = $location->id = $id ?? '';
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'pharmacy')) {
        if ($_SESSION['role'] == 'admin') {
            $adminn = new AdminView();
            $adminn->id = $_SESSION['id'];
            if ($adminn->checkID()) {
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
                    case 'addMedicine':
                        $medicine->name = $medicinev->name = $_POST['name'];
                        $medicine->description = $medicinev->description = $_POST['description'];
                        $medicine->admin = $medicinev->admin = $_SESSION['id'];
                        $medicine->img = uploadFile($_FILES['image']);
                        if ($medicine->img != '') {
                            if (!$medicinev->checkName()) {
                                echo $medicine->add() ? 'success' : 'errorDefault';
                            }else {
                                echo 'nameExist';
                            }
                        }else {
                            echo 'imageError';
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
                    case 'editMedicine':
                        $medicine->name = $medicinev->name = $_POST['name'];
                        $medicine->description = $medicinev->description = $_POST['description'];
                        $medicine->admin = $medicinev->admin = $_SESSION['id'];
                        if ($_FILES["image"]["size"] > 0) {
                            $medicine->img = uploadFile($_FILES['image']);
                        }else {
                            $medicine->img = 'noImage';
                        }
                        if ($medicine->img != '' || $medicine->img == 'noImage') {
                            if ($medicine->img == 'noImage') {
                                $medicine->img = '';
                            }
                            if (!$medicinev->checkNameExceptThis()) {
                                echo $medicine->edit() ? 'editsuccess' : 'errorDefault';
                            }else {
                                echo 'nameExist';
                            }
                        }else {
                            echo 'imageError';
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
                    case 'changePassword':
                        $current = $_POST['current'];
                        $new = $_POST['new'];
                        $re = $_POST['confirm'];
                        $admin->id = $adminv->id = $_SESSION['id'] ?? 0;
                        $adminv->password = $current;
                        if (strlen($re) >= 8) {
                            if ($adminv->isPassword()) {
                                $admin->password = $re;
                                if ($admin->changePassword()) {
                                    echo 'success';
                                } else {
                                    echo 'error';
                                }
                            } else {
                                echo 'currentError';
                            }
                        }else {
                            echo 'passwordInvalid';
                        }
                        break;

                    default:
                        echo 'errorDefault';
                }
            }
        }elseif ($_SESSION['role'] == 'pharmacy') {
            $pharmacyy = new PharmacyView();
            $pharmacyy->id = $_SESSION['id'];
            if ($pharmacyy->checkID()) {
                switch ($_POST['submit']) {
                    case 'addStore':
                        $store->medicine = $storev->medicine = $_POST['id'];
                        $store->pharmacy = $storev->pharmacy = $_SESSION['id'];
                        if (!$storev->checkMed()) {
                            echo $store->add() ? 'success' : 'error';
                        }else {
                            echo 'medExist';
                        }
                        break;


                    case 'removeStore':
                        if ($storev->checkID()) {
                            echo $store->remove() ? 'success' : 'failure';
                        } else {
                            echo 'unknownID';
                        }
                        break;

                    case 'changePasswordP':
                        $current = $_POST['current'];
                        $new = $_POST['new'];
                        $re = $_POST['confirm'];
                        $pharmacy->id = $pharmacyv->id = $_SESSION['id'] ?? 0;
                        $pharmacyv->password = $current;
                        if (strlen($re) >= 8) {
                            if ($pharmacyv->isPassword()) {
                                $pharmacy->password = $re;
                                if ($pharmacy->changePassword()) {
                                    echo 'success';
                                } else {
                                    echo 'error';
                                }
                            } else {
                                echo 'currentError';
                            }
                        }else {
                            echo 'passwordInvalid';
                        }
                        break;

                    default:
                        echo 'errorDefault';
                }

            }
        }
    }



}