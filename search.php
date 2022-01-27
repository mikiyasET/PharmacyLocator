<?php
include_once 'mvc/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="d-flex searchTab">
            <input class="" list="medicinesHint" type="search" placeholder="Search ..." aria-label="Search" onkeyup="showHint(this.value)">
            <datalist id="medicinesHint">
            </datalist>
            <button class="" type="submit" onclick="search()"><span class="material-icons-outlined">search</span> Search</button>
        </div>
        <div class="search-field mt-5" id="mainpage">
        </div>
    </div>
</div>
</body>
</html>