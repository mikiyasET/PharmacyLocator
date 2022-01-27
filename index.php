<?php
include_once 'mvc/connect.php';
if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'pharmacy')) {
   if ($_SESSION['role'] == 'admin') {
       $admin = new AdminView();
       $admin->id = $_SESSION['id'];
       if (!$admin->checkID()) {
           General::go("404");
       }
   }elseif ($_SESSION['role'] == 'pharmacy') {
       $pharmacy = new PharmacyView();
       $pharmacy->id = $_SESSION['id'];
       if (!$pharmacy->checkID()) {
           General::go("404");
       }
   }
}else {
    General::go('login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Locator</title>
    <?php include_once './structure/links.php' ?>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body>
<div class="body">
    <aside>
        <div class="logo">
            <img src="assets/images/icon/logo.png" alt=""/>
        </div>
        <ul id="aside-menu">
            <li>
                <a href="javascript:void(0)" id="dashboardLink" class="list-link active" onclick="loadPage('dashboard')">
                    <i class="material-icons-outlined">grid_view</i> <span>Dashboard</span>
                </a>
            </li>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <li>
                    <a href="javascript:void(0)" id="medicineLink" class="list-link" onclick="loadPage('medicine')">
                        <i class="material-icons-outlined">medication</i> <span>Medicine</span><i class="material-icons-outlined">expand_more</i>
                    </a>
                    <ul class="ca-dropdown" id="medicineTab">
                        <li onclick="loadPage('medicine','add')">Add Medicine</li>
                        <li onclick="loadPage('medicine','edit')">Edit Medicine</li>
                        <li onclick="loadPage('medicine','remove')">Remove</li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" id="locationLink" class="list-link" onclick="loadPage('location')">
                        <i class="material-icons-outlined">place</i> <span>Location</span><i class="material-icons-outlined">expand_more</i>
                    </a>
                    <ul class="ca-dropdown" id="locationTab">
                        <li onclick="loadPage('location','add')">Add Location</li>
                        <li onclick="loadPage('location','edit')">Edit Location</li>
                        <li onclick="loadPage('location','remove')">Remove</li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" id="pharmacyLink" class="list-link" onclick="loadPage('pharmacy')">
                        <i class="material-icons-outlined">local_pharmacy</i> <span>Pharmacy</span><i class="material-icons-outlined">expand_more</i>
                    </a>
                    <ul class="ca-dropdown" id="pharmacyTab">
                        <li onclick="loadPage('pharmacy','add')">Add Pharmacy</li>
                        <li onclick="loadPage('pharmacy','edit')">Edit Pharmacy</li>
                        <li onclick="loadPage('pharmacy','remove')">Remove</li>
                    </ul>
                </li>
            <?php
            } else if ($_SESSION['role'] == 'pharmacy') {
            ?>
            <li>
                <a href="javascript:void(0)" id="storeLink" class="list-link" onclick="loadPage('store')">
                    <i class="material-icons-outlined">archive</i> <span>Store</span><i class="material-icons-outlined">expand_more</i>
                </a>
                <ul class="ca-dropdown" id="storeTab">
                    <li onclick="loadPage('store','add')">Add Store</li>
                    <li onclick="loadPage('store','remove')">Remove</li>
                </ul>
            </li>

            <?php } ?>
            <li>
                <a href="javascript:void(0)" id="leaderboardLink" class="list-link" onclick="loadPage('leaderboard')"><i class="material-icons-outlined">leaderboard</i> <span>LeaderBoard</span></a>
            </li>
            <li>
                <a href="javascript:void(0)" id="settingsLink" class="list-link" onclick="loadPage('password')"><i class="material-icons-outlined">vpn_key</i> <span>Change Password</span></a>
            </li>
            <li>
                <a href="javascript:void(0)" id="settingsLink" class="list-link" onclick="loadPage('logout')"><i class="material-icons-outlined">logout</i> <span>Logout</span></a>
            </li>
        </ul>
    </aside>
    <div class="content">
        <nav>
            <div class="nav-row">
                <div id="ca-collapse" style="padding: 1.2rem;cursor: pointer">
                    <i class="material-icons-outlined">close</i>
                </div>
                <div class="page-title-con">
                    <p class="page-title">Pharmacy Locator</p>
                </div>
                <div class="page-settings">

                </div>
            </div>
        </nav>
        <div class="main" id="mainpage">

        </div>
    </div>
</div>
</body>
</html>
<?php include_once './structure/script.php' ?>
