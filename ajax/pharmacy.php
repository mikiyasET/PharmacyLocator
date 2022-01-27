<?php
include_once '../mvc/connect.php';

$data = $_GET['func'] ?? '';
$id = $_GET['id'] ?? '';

if ($data == 'add') {
    ?>
    <p id="main-title">Add Pharmacy</p>
    <form method="post" id="imageUploadForm" enctype="multipart/form-data">
        <input type="hidden" name="submit" value="addPharmacy">
        <input type="hidden" name="id" value="">
        <div id="main-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Pharmacy Name</label>
                        <input type="text" name="name" class="form-control" id="nameInput" tabindex="1" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="MapInput" class="form-label">Map Link</label>
                        <input type="url" name="mapLink" class="form-control" id="MapInput" tabindex="2" placeholder="Google Map Link">
                    </div>
                    <div class="mb-3">
                        <label for="LocationSelectInput" class="form-label">Location</label>
                        <select class="form-select" name="location" id="LocationSelectInput" tabindex="3">
                            <option selected disabled>Choose ...</option>
                            <?php
                            $locations = new LocationView();
                            foreach ($locations->all() as $location) {
                                echo "<option value='{$location['lid']}'>".ucwords($location['name'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="decInput" class="form-label">Pharmacy Description</label>
                        <textarea name="description" class="form-control" id="decInput" rows="10" tabindex="4" placeholder="About the pharmacy and address ..." ></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="EmailInput" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="EmailInput" tabindex="5" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="passInput" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passInput" tabindex="6" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassInput" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassInput" tabindex="7" placeholder="Re-Type Password">
                    </div>
                    <div class="mb-3">
                        <label for="imgInput" class="form-label">Pharmacy Image</label>
                        <input type="file" name="image" class="form-control" id="imgInput" tabindex="8">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn ca-btn mt-3" type="submit">Add</button>
            </div>
        </div>
    </form>
    <?php
}
else if ($data == 'edit') {
    $pharmacies = new PharmacyView();
    $pharmacies->id = $id;
    $name = '';
    $link = '';
    $location = '';
    $email = '';
    $description = '';
    $image = 'picture.png';
    $status = '';
    if ($pharmacies->checkID()) {
        $pharmacy = $pharmacies->one();
        $name = $pharmacy->name ?? '';
        $link = $pharmacy->mapLink ?? '';
        $locationID = $pharmacy->lid ?? '';
        $email = $pharmacy->email ?? '';
        $description = $pharmacy->description ?? '';
        $image = $pharmacy->img ?? 'picture.png';
    }
    else {
        $status = 'disabled';
    }
    ?>
    <p id="main-title">Modify Pharmacy</p>
    <form method="post" id="imageUploadForm" enctype="multipart/form-data">
        <input type="hidden" name="submit" value="editPharmacy">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div id="main-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="LocationInput" class="form-label">Pharmacy Name</label>
                        <input type="text" name="name" class="form-control" id="LocationInput" tabindex="1" placeholder="Name" value="<?php echo $name ?>" <?php echo $status; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="MapInput" class="form-label">Map Link</label>
                        <input type="url" name="mapLink" class="form-control" id="MapInput" tabindex="2" placeholder="Google Map Link" value="<?php echo $link ?>" <?php echo $status; ?>>
                    </div>
                    <div class="mb-3">
                        <label for="decInput" class="form-label">Pharmacy Description</label>
                        <textarea name="description" class="form-control" id="decInput" rows="10" tabindex="3" placeholder="About the pharmacy and address ..." <?php echo $status; ?>><?php echo $description ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="LocationSelectInput" class="form-label">Location</label>
                        <select class="form-select" name="location" id="LocationSelectInput" tabindex="4" <?php echo $status; ?>>
                            <option selected disabled>Choose ...</option>
                            <?php
                            $locations = new LocationView();
                            foreach ($locations->all() as $location) {
                                $stat = $locationID == $location['lid'] ? 'selected' : '';
                                echo "<option value='{$location['lid']}' $stat>".ucwords($location['name'])."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="EmailInput" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="EmailInput" tabindex="5" placeholder="Email" value="<?php echo $email ?>" <?php echo $status; ?>>
                    </div>
                    <div class="mb-3">
                        <img src="./assets/images/pharmacies/<?php echo $image; ?>" alt="<?php echo $name." Image"; ?>" style="width: auto;height: 15.5rem;">
                        <input type="file" name="image" class="form-control" id="imgInput" tabindex="6">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn ca-btn mt-3" type="submit">Edit</button>
            </div>
            <div class="mt-5">
                <table id="pharmacyTable" class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Location</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $pharmacies = new PharmacyView();
                    $counter = 0;
                    foreach ($pharmacies->all() as $pharmacy) {
                        $counter++;
                        $location = new LocationView();
                        $location->id = $pharmacy['lid'];
                        $locationName = $location->one()->name;
                        echo "
                        <tr onclick=\"loadPage('pharmacy','edit','".$pharmacy['pid']."')\">
                            <th scope=\"row\">$counter</th>
                            <td>".ucwords($pharmacy['name'])."</td>
                            <td>{$pharmacy['email']}</td>
                            <td>".ucwords($locationName)."</td>
                        </tr>
                        ";

                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <?php
}
else if ($data == 'remove') {
    ?>
    <div id="main-content">
        <div class="mt-5">
            <table id="pharmacyTable" class="table table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Location</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $pharmacies = new PharmacyView();
                $counter = 0;
                foreach ($pharmacies->all() as $pharmacy) {
                    $counter++;
                    $location = new LocationView();
                    $location->id = $pharmacy['lid'];
                    $locationName = $location->one()->name;
                    echo "
                    <tr onclick=\"remove('pharmacy','".$pharmacy['pid']."')\">
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($pharmacy['name'])."</td>
                        <td>{$pharmacy['email']}</td>
                        <td>".ucwords($locationName)."</td>
                    </tr>
                    ";

                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php
}
else {
    ?>
    <div id="main-content">
        <div class="mt-5">
            <table id="pharmacyTable" class="table table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Location</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $pharmacies = new PharmacyView();
                $counter = 0;
                foreach ($pharmacies->all() as $pharmacy) {
                    $counter++;
                    $location = new LocationView();
                    $location->id = $pharmacy['lid'];
                    $locationName = $location->one()->name;
                    echo "
                    <tr>
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($pharmacy['name'])."</td>
                        <td>{$pharmacy['email']}</td>
                        <td>".ucwords($locationName)."</td>
                    </tr>
                    ";

                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php
}

?>
<script>
    $(document).ready(function() {
        $('#pharmacyTable').DataTable();
        $("#imageUploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "ajax/index.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    showLoading()
                    $('button[type="submit"]').prop('disabled', true);
                },
                success: function (data) {
                    hideLoading()
                    $('button[type="submit"]').prop('disabled', false);
                    console.log(data)
                    switch (data) {
                        case 'success':
                            Toast.fire({
                                icon: 'success',
                                title: 'Pharmacy added successfully'
                            })
                            $("#imageUploadForm")[0].reset();
                            loadPage('pharmacy', 'add')
                            break;
                        case 'editsuccess':
                            Toast.fire({
                                icon: 'success',
                                title: 'Pharmacy modified successfully'
                            })
                            $("#imageUploadForm")[0].reset();
                            loadPage('pharmacy', 'edit')
                            break;
                        case 'nameExist':
                            Toast.fire({
                                icon: 'error',
                                title: 'Name already exists'
                            })
                            break;
                        case 'emailError':
                            Toast.fire({
                                icon: 'error',
                                title: 'Invalid email address'
                            })
                            break;
                        case 'passwordLength':
                            Toast.fire({
                                icon: 'error',
                                title: 'Password length must be 8 or greater in length'
                            })
                            break;

                        case 'imageError':
                            Toast.fire({
                                icon: 'error',
                                title: 'Image not uploaded, try again with another image.'
                            })
                            break;
                        case 'unknownID':
                            Toast.fire({
                                icon: 'error',
                                title: 'Id unknown, Please refresh the page'
                            })
                            break;

                        default:
                            Toast.fire({
                                icon: 'error',
                                title: 'Internal Error'
                            })
                    }
                },
                error: function (e) {
                    hideLoading()
                    Toast.fire({
                        icon: 'error',
                        title: 'Internal Error'
                    })
                }
            });
        }));

    })
</script>
