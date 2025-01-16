<?php

include_once __DIR__ . "/classes/Tour.php";
use classes\Tour;

include_once __DIR__ . "/classes/City.php";
use classes\City;

$tour= new Tour();
$city = new City();
$cities = $city->getCities();

if(isset($_POST['submit'])) {
    $uploadDir = __DIR__ . '/img/';
    $imgName = basename($_FILES['img']['name']); // Získajte názov súboru
    $imgPath = $uploadDir . $imgName; // Cesta, kde bude súbor uložený
    move_uploaded_file($_FILES['img']['tmp_name'], $imgPath);
    $dbImgPath = 'img/' . $imgName;
    $_POST['img'] = $dbImgPath;
    $insert = $tour->insertTour($_POST);
    if($insert) {
        header("Location: adminhome.php");
        exit;

    } else {
        echo '<p style="color: red">Fail</p>';
    }


}
include_once "parts/head.php";

?>
<div class="container my-5">
    <h1 class="text-center mb-4">New Package Tour</h1>
    <div class="card shadow-sm p-4">
        <form action="tourinsert.php" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description" required></textarea>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="img" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
            </div>

            <!-- Duration -->
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 5 days" required>
            </div>

            <!-- Number of Persons -->
            <div class="mb-3">
                <label for="person" class="form-label">Number of Persons</label>
                <input type="number" class="form-control" id="person" name="person" placeholder="Enter number of persons" min="1" required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" min="0" step="0.01" required>
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="idcity" class="form-label">City</label>
                <select class="form-select" id="idcity" name="idcity" required>
                    <option value="" disabled selected>Select City</option>
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?= htmlspecialchars($city['id']) ?>">
                            <?= htmlspecialchars($city['city']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Submit and Return -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="adminhome.php" class="btn btn-secondary">Return</a>

            </div>
        </form>
    </div>
</div>
