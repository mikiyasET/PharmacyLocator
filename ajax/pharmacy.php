<?php
include_once '../mvc/connect.php';

$data = $_GET['func'] ?? '';
$id = $_GET['id'] ?? '';

if ($data == 'add') {
    ?>
    <p id="main-title">Add Pharmacy</p>
    <div id="main-content">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Pharmacy Name</label>
                    <input type="text" name="name" class="form-control" id="LocationInput" tabindex="1" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Map Link</label>
                    <input type="url" name="mapLink" class="form-control" id="LocationInput" tabindex="2" placeholder="Google Map Link">
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
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="LocationInput" tabindex="4" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="LocationInput" tabindex="5" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="LocationInput" tabindex="6" placeholder="Re-Type Password">
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button class="btn ca-btn mt-3" type="button" onclick="add('pharmacy')">Add</button>
        </div>
    </div>
    <?php
} else if ($data == 'edit') {
    $pharmacies = new PharmacyView();
    $pharmacies->id = $id;
    $name = '';
    $link = '';
    $location = '';
    $email = '';
    $status = '';
    if ($pharmacies->checkID()) {
        $pharmacy = $pharmacies->one();
        $name = $pharmacy->name ?? '';
        $link = $pharmacy->mapLink ?? '';
        $locationID = $pharmacy->lid ?? '';
        $email = $pharmacy->email ?? '';
    }else {
        $status = 'disabled';
    }
    ?>
    <p id="main-title">Modify Pharmacy</p>
    <div id="main-content">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Pharmacy Name</label>
                    <input type="text" name="name" class="form-control" id="LocationInput" tabindex="1" placeholder="Name" value="<?php echo $name ?>" <?php echo $status; ?> >
                </div>
                <div class="mb-3">
                    <label for="LocationInput" class="form-label">Map Link</label>
                    <input type="url" name="mapLink" class="form-control" id="LocationInput" tabindex="2" placeholder="Google Map Link" value="<?php echo $link ?>" <?php echo $status; ?>>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="LocationSelectInput" class="form-label">Location</label>
                    <select class="form-select" name="location" id="LocationSelectInput" tabindex="3" <?php echo $status; ?>>
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
                    <label for="LocationInput" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="LocationInput" tabindex="4" placeholder="Email" value="<?php echo $email ?>" <?php echo $status; ?>>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button class="btn ca-btn mt-3" type="button" onclick="modify('pharmacy','<?php echo $id; ?>')">Edit</button>
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
    <?php
} else if ($data == 'remove') {
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
} else {
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
        $("input:checkbox").on('change',function() {
            let from = $(this).attr("data-type");
            let id = $(this).attr("data-id");
            if ($(this).is(':checked')) {
                toggleDisable(from,id,1)
            }else {
                toggleDisable(from,id,0)
            }
        })
    })
</script>
