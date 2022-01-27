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
$u = $users->one();
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

if (isset($_POST['change'])) {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];
    $users->password = $current;
    if ($users->isPassword()) {
        if ($new == $confirm) {
            if (strlen($confirm) >= 8) {
                $user = new UsersController();
                $user->id = $users->id;
                $user->password = $confirm;
                if ($user->changePassword()) {
                    ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Password changed successfully'
                        })
                    </script>
                <?php
                }
                else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'There was an error changing your password'
                    })
                </script>
            <?php
            }
            }else {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Password length must be 8 or more'
                        })
                    </script>
                <?php
            }
        }else {
        ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Password doesn\'t match'
                })
            </script>
        <?php
        }
    }else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Current password not corrected'
            })
        </script>
        <?php
    }
}
?>

<div class="body">
    <div class="user-content">
        <div class="searchTab">
            <div class="d-flex">
                <div class="logo">
                    PharmacyLocator
                </div>
                <ul class="navTab">
                    <li style="font-size: 14px;padding: 2px;">Welcome <b><?php echo ucfirst($u->username); ?></b></li>
                    <li><a href="user.php"><span class="material-icons-outlined">home</span></a></li>
                    <li><a href="logout.php?logout=1"><span class="material-icons-outlined">logout </span></a></li>
                </ul>
            </div>
            <div id="logbox">
                <form method="post">
                    <div class="mb-3">
                        <label for="currentPass" class="form-label">Current Password</label>
                        <input type="password" name="current" class="form-control" tabindex="1" placeholder="Your current password">
                    </div>
                    <div class="mb-3">
                        <label for="newPass" class="form-label">New Password</label>
                        <input type="password" name="new" class="form-control" tabindex="2" placeholder="Your new password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPass" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm" class="form-control" tabindex="3" placeholder="Re-type your new password">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn ca-btn mt-3" type="submit" name="change">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>