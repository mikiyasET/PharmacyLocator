<?php
include_once 'mvc/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
<body style="background-color: #F0F4F3">
<?php

if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userv = new UsersView();
    $userv->username = $username;
    if (!$userv->checkUsername()) {
        if ($password > 8) {
            $user = new UsersController();
            $user->username = $username;
            $user->password = $password;
            if ($user->add()) {
                $_SESSION['user'] = $userv->getID();
                General::go('user.php');
            }else {
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'There was an error registering your account'
                        })
                    </script>
                <?php
            }
        }else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Password length not correct'
                })
            </script>
            <?php
        }
    }else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Username Already exists'
            })
        </script>
        <?php
    }
}else if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userv = new UsersView();
    $userv->username = $username;
    $userv->password = $password;
    if ($userv->validate()) {
        $_SESSION['user'] = $userv->getID();
        General::go('user.php');
    }else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Username or password invalid'
            })
        </script>
        <?php
    }
}

?>
    <div class="loginPage">
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="post" class="loginform">
                    <h1>Create Account</h1>
                    <input type="text" name="username" placeholder="username" />
                    <input type="password" name="password" placeholder="Password" />
                    <button type="submit" name="signUp">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="post" class="loginform">
                    <h1>Sign in</h1>
                    <input type="text" name="username" placeholder="username" />
                    <input type="password" name="password" placeholder="Password" />
                    <button type="submit" name="login">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Look who is back!</h1>
                        <p>See new pharmacies that are added</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, There!</h1>
                        <p>No more wasting your time finding medicine</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>
</html>