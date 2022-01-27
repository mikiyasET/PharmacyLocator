<?php
include_once '../mvc/connect.php';

$searchKey = trim($_GET['query']);
$medicines = new StoreView();
$medicines->medicine = $searchKey;
$result = $medicines->search();
if (count($result) > 0) {
    echo '<div class="row">';
    foreach ($result as $medicine) {
        echo "<div class=\"col-md-4\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">{$medicine['pharmacy']}</h5>
                            <h6 class=\"card-subtitle mb-2 text-muted\">{$medicine['location']}</h6>
                            <p class=\"card-text\">This pharmacy have the medicine you're looking for.</p>
                            <a class='showmap card-link text-decoration-none' data-bs-toggle='modal' data-bs-target='#info' data-link='".$medicine['mapLink']."'>Google Map</a>
                        </div>
                    </div>
                </div>";
    }
    echo '</div>';
}
else {
    echo '<p class="text-center">Medicine is not found</p>';
}
?>
<div class="modal fade" id="info" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="detailsModalLabel">Pharmacy Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="map-link" src="" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.showmap').on('click', (e) => {
        $("#map-link").attr('src',e.currentTarget.attributes['data-link'].nodeValue)
    })
</script>
