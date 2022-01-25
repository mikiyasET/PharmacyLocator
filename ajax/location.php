<?php
include_once '../mvc/connect.php';

$data = $_GET['func'] ?? '';
$id = $_GET['id'] ?? '';

if ($data == 'add') {
    ?>
    <p id="main-title">Add Location</p>
    <div id="main-content">
        <div class="mb-3">
            <label for="LocationInput" class="form-label">Location</label>
            <input type="text" name="name" class="form-control" id="LocationInput" tabindex="1" placeholder="Name">
        </div>
        <div class="d-grid gap-2">
            <button class="btn ca-btn mt-3" type="button" onclick="add('location')">Add</button>
        </div>
    </div>
    <?php
} else if ($data == 'edit') {
    $locations = new LocationView();
    $locations->id = $id;
    $name = '';
    $link = '';
    $status = '';
    if ($locations->checkID()) {
        $exe = $locations->one();
        $name = $exe->name ?? '';
    }else {
        $status = 'disabled';
    }
    ?>
    <p id="main-title">Modify Location</p>
    <div id="main-content">
        <div class="mb-3">
            <label for="LocationInput" class="form-label">Location</label>
            <input type="text" name="name" class="form-control" id="LocationInput" tabindex="1" placeholder="Name" <?php echo $status; ?> value="<?php echo $name; ?>">
        </div>
        <div class="d-grid gap-2">
            <button class="btn ca-btn mt-3" type="button" onclick="modify('location','<?php echo $id; ?>')">Edit</button>
        </div>

        <div class="mt-5">
            <table id="pharmacyTable" class="table table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $locations = new LocationView();
                $counter = 0;
                foreach ($locations->all() as $location) {
                    $counter++;

                    echo "
                <tr onclick=\"loadPage('location','edit','".$location['lid']."')\">
                    <th scope=\"row\">$counter</th>
                    <td>".ucwords($location['name'])."</td>
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
    <div class="mt-5">
        <table id="pharmacyTable" class="table table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $locations = new LocationView();
            $counter = 0;
            foreach ($locations->all() as $location) {
                $counter++;

                echo "
                <tr onclick='remove(\"location\",\"{$location['lid']}\")'>
                    <th scope=\"row\">$counter</th>
                    <td>".ucwords($location['name'])."</td>
                </tr>
                ";

            }
            ?>

            </tbody>
        </table>
    </div>
    <?php
} else {
    ?>
    <div class="mt-5">
        <table id="pharmacyTable" class="table table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $locations = new LocationView();
            $counter = 0;
            foreach ($locations->all() as $location) {
                $counter++;

                echo "
                <tr>
                    <th scope=\"row\">$counter</th>
                    <td>".ucwords($location['name'])."</td>
                </tr>
                ";

            }
            ?>

            </tbody>
        </table>
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
