<?php
include_once '../mvc/connect.php';

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $admin = new AdminView();
    $admin->id = $_SESSION['id'];
    if ($admin->checkID()) {
            ?>
            <p id="main-title">Change Password</p>
            <div id="main-content">
                    <div class="mb-3">
                        <label for="currentPass" class="form-label">Current Password</label>
                        <input type="password" name="current" class="form-control" id="currentPass" tabindex="1" placeholder="Your current password">
                    </div>
                    <div class="mb-3">
                        <label for="newPass" class="form-label">New Password</label>
                        <input type="password" name="new" class="form-control" id="newPass" tabindex="1" placeholder="Your new password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPass" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm" class="form-control" id="confirmPass" tabindex="1" placeholder="Re-type your new password">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn ca-btn mt-3" type="button" onclick="add('password')">Change</button>
                    </div>

            </div>
            <?php
    }else {
        General::go("404");
    }
}
else if (isset($_SESSION['role']) && $_SESSION['role'] == 'pharmacy') {
    $pharmacy = new PharmacyView();
    $pharmacy->id = $_SESSION['id'];
    if ($pharmacy->checkID()) {
        ?>
        <p id="main-title">Change Password</p>
        <div id="main-content">
            <div class="mb-3">
                <label for="currentPass" class="form-label">Current Password</label>
                <input type="password" name="current" class="form-control" id="currentPass" tabindex="1" placeholder="Your current password">
            </div>
            <div class="mb-3">
                <label for="newPass" class="form-label">New Password</label>
                <input type="password" name="new" class="form-control" id="newPass" tabindex="1" placeholder="Your new password">
            </div>
            <div class="mb-3">
                <label for="confirmPass" class="form-label">Confirm Password</label>
                <input type="password" name="confirm" class="form-control" id="confirmPass" tabindex="1" placeholder="Re-type your new password">
            </div>
            <div class="d-grid gap-2">
                <button class="btn ca-btn mt-3" type="button" onclick="add('passwordP')">Change</button>
            </div>

        </div>
        <?php
    }else {
        General::go("404");
    }
}
