<?php
include_once '../mvc/connect.php';

$data = $_GET['func'] ?? '';
$id = $_GET['id'] ?? '';

if ($data == 'add') {
    ?>
    <p id="main-title">Add Medicine</p>
    <form method="post" id="imageUploadForm" enctype="multipart/form-data">
        <input type="hidden" name="submit" value="addMedicine">
        <input type="hidden" name="id" value="">
        <div id="main-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="MedicineInput" class="form-label">Medicine Name</label>
                        <input type="text" name="name" class="form-control" id="MedicineInput" tabindex="1" placeholder="Name">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imgInput" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="imgInput" tabindex="2">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="decInput" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="decInput" rows="10" tabindex="3" placeholder="Medicine descriptions ..."></textarea>
            </div>
            <div class="d-grid gap-2">
                <button class="btn ca-btn mt-3" type="submit" name="add">Add</button>
            </div>
        </div>
    </form>
    <?php
    }
else if ($data == 'edit') {
        $medicines = new MedicineView();
        $medicines->id = $id;
        $name = '';
        $img = 'picture.png';
        $desc = '';
        $status = '';
        if ($medicines->checkID()) {
            $medicine = $medicines->one();
            $name = $medicine->name;
            $img = $medicine->img;
            $desc = $medicine->description;
        }else {
            $status = 'disabled';
        }
    ?>
    <p id="main-title">Modify Medicine</p>
    <form method="post" id="imageUploadForm" enctype="multipart/form-data">
        <input type="hidden" name="submit" value="editMedicine">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div id="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="MedicineInput" class="form-label">Medicine Name</label>
                        <input type="text" name="name" class="form-control" id="MedicineInput" tabindex="1" placeholder="Name" value="<?php echo $name; ?>" <?php echo $status; ?> >
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="decInput" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="decInput" rows="10" tabindex="3" placeholder="Medicine descriptions ..." <?php echo $status; ?>><?php echo $desc; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <img src="./assets/images/medicines/<?php echo $img; ?>" alt="<?php echo $name." Image"; ?>" style="width: auto;height: 15.5rem;">
                        <input type="file" name="image" class="form-control" id="imgInput" tabindex="2">
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button class="btn ca-btn mt-3" type="submit" name="edit" <?php echo $status; ?>>Edit</button>
            </div>

            <div class="mt-5">
                <table id="pharmacyTable" class="table table-borderless table-hover">
                    <thead>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Added By</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $medicines = new MedicineView();
                    $counter = 0;
                    foreach ($medicines->all() as $medicine) {
                        $counter++;
                        $admin = new AdminView();
                        $admin->id = $medicine['aid'];
                        $adminName = $admin->one()->username;
                        echo "
                    <tr onclick=\"loadPage('medicine','edit','".$medicine['mid']."')\">
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicine['name'])."</td>
                        <td>".substr($medicine['description'],0, 30)."</td>
                        <td>".ucwords($adminName)."</td>
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
                    <th scope="col">Description</th>
                    <th scope="col">Added By</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $medicines = new MedicineView();
                $counter = 0;
                foreach ($medicines->all() as $medicine) {
                    $counter++;
                    $admin = new AdminView();
                    $admin->id = $medicine['aid'];
                    $adminName = $admin->one()->username;
                    echo "
                    <tr onclick=\"remove('medicine','".$medicine['mid']."')\">
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicine['name'])."</td>
                        <td>".substr($medicine['description'],0, 30)."</td>
                        <td>".ucwords($adminName)."</td>
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
                    <th scope="col">Description</th>
                    <th scope="col">Added By</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $medicines = new MedicineView();
                $counter = 0;
                foreach ($medicines->all() as $medicine) {
                    $counter++;
                    $admin = new AdminView();
                    $admin->id = $medicine['aid'];
                    $adminName = $admin->one()->username;
                    echo "
                    <tr>
                        <th scope=\"row\">$counter</th>
                        <td>".ucwords($medicine['name'])."</td>
                        <td>".substr($medicine['description'],0, 30)."</td>
                        <td>".ucwords($adminName)."</td>
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
                                title: 'Medicine added successfully'
                            })
                            $("#imageUploadForm")[0].reset();
                            loadPage('medicine', 'add')
                            break;
                        case 'editsuccess':
                            Toast.fire({
                                icon: 'success',
                                title: 'Medicine modified successfully'
                            })
                            $("#imageUploadForm")[0].reset();
                            loadPage('medicine', 'edit')
                            break;
                        case 'nameExist':
                            Toast.fire({
                                icon: 'error',
                                title: 'Name already exists'
                            })
                            break;
                        case 'imageError':
                            Toast.fire({
                                icon: 'error',
                                title: 'Image not uploaded, try again with another image.'
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
