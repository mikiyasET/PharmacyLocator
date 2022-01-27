<?php
include_once 'mvc/connect.php';
$users = new UsersView();
$users->id = $_SESSION['user'];
if (isset($_SESSION['user'])) {
    if (!$users->checkID()) {
        General::go('404');
    }
}
else {
    General::go('userAuth.php');
}
$user = $users->one();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Locator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/css/user.css">
    <?php include_once './structure/script.php' ?>

</head>
<body>
<?php

?>

<div class="body">
    <div class="user-content">
        <div class="searchTab">
            <div class="d-flex">
                <div class="logo">
                    PharmacyLocator
                </div>
                <ul class="navTab">
                    <li style="font-size: 14px;padding: 2px;">Welcome <b><?php echo ucfirst($user->username); ?></b></li>
                    <li><a href="changePassword.php"><span class="material-icons-outlined">lock_open</span></a></li>
                    <li><a href="logout.php?logout=1"><span class="material-icons-outlined">logout </span></a></li>
                </ul>
            </div>
            <div class="searchBox">
                <input class="" list="medicinesHint" type="search" placeholder="Search ..." aria-label="Search" onkeyup="showHint(this.value)">
                <datalist id="medicinesHint">
                </datalist>
                <button class="" type="submit" onclick="search()"><span class="material-icons-outlined">search</span> Search</button>
            </div>
            <div class="medicineDetails"><a href="#" class="btn d-none" id="medDetails" data-med="" data-bs-toggle='modal' data-bs-target='#medinfo'><span class="material-icons-outlined pe-2">info</span> Medicine Details</a></div>
        </div>
        <div class="search-field mt-5" id="mainpage">
        </div>
    </div>
</div>
<div class="modal fade" id="medinfo" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalSet">

        </div>
    </div>
</div>
<script>
    $('#medDetails').on('click', (e) => {
        let request = $.ajax({
            url: "ajax/info.php",
            type: "POST",
            dataType: "html",
            data: {
                query: e.currentTarget.attributes['data-med'].nodeValue
            }
        });
        request.done(function(msg) {
            $("#modalSet").html(msg);
        });
        request.fail(function(jqXHR, textStatus) {
            Toast.fire({
                icon: 'error',
                title: 'Request failed: ' + textStatus
            })
        });
    })
</script>
</body>
</html>