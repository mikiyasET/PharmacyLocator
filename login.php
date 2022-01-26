<?php
include_once 'mvc/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './structure/meta.php' ?>
    <title>Document</title>
    <?php include_once './structure/links.php' ?>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <?php include_once './structure/script.php' ?>

</head>
<body>
<?php
//echo uniqid()."<br />";
//echo password_hash('Password', PASSWORD_BCRYPT);
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    if ($role == 'admin') {
        $admin = new AdminView();
        $admin->username = $username;
        $admin->password = $password;
        if (!isset($username) || !isset($password)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'There is an empty field!'
                })
            </script>
        <?php
        }
        else {
            if ($admin->verify()) {
                $_SESSION['role'] = 'admin';
                $_SESSION['id'] = $admin->getID();
                General::go('index.php');
            }
            else {
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
    }else if ($role == 'pharmacy') {
        $email = $username;
        $pharmacy = new PharmacyView();
        $pharmacy->email = $email;
        $pharmacy->password = $password;
        if (!isset($email) || !isset($password)) {
        ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'There is an empty field!'
                })
            </script>
        <?php
        }
        else {
            if ($pharmacy->verify()) {
                $_SESSION['role'] = 'pharmacy';
                $_SESSION['id'] = $pharmacy->getID();
                General::go('index.php');
            }
            else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Email or password invalid'
                    })
                </script>
                <?php
            }
        }
    }else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Please choose a role first'
            })
        </script>
        <?php
    }
}
?>
<style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active{
        -webkit-box-shadow: 0 0 0 30px var(--aside-darkMode) inset !important;
    }
    input:-webkit-autofill{
        -webkit-text-fill-color: var(--text-darkMode) !important;
    }
    .content {
        height: 100vh;
    }
</style>
<div class="body">
    <div class="content">
        <div id="login-box">
            <form method="post">
                <h2 class="text-center">Login</h2>
                <div class="mb-3">
                    <label for="RoleSelectInput" class="form-label">Role</label>
                    <select class="form-select" name="role" id="RoleSelectInput" tabindex="3">
                        <option selected disabled>Choose ...</option>
                        <option value="admin">Admin</option>
                        <option value="pharmacy">Pharmacy</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="usernameInput" class="form-label">Username/Email</label>
                    <input type="text" name="username" class="form-control" id="usernameInput" tabindex="1">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="passwordInput" tabindex="2">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn ca-btn mt-3" type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>