<?php

include_once __DIR__ . "/classes/Tour.php";
use classes\Tour;

include_once __DIR__ . "/classes/City.php";
use classes\City;

$tour= new Tour();
$toursdata=$tour->getPackagesId(intval($_GET['id']));
$tourdata = $toursdata[0];

$city = new City();
$cities = $city->getCities();

if(isset($_POST['submit'])) {
    // Spracovanie obrázka
    if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Nahranie nového obrázka
        $uploadDir = __DIR__ . '/img/';
        $imgName = uniqid() . '_' . basename($_FILES['img']['name']);
        $imgPath = $uploadDir . $imgName;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
            $img = 'img/' . $imgName; // Nový obrázok
        } else {
            $tourDataN = $tour->getPackagesId($_POST['id']);
            $img = $tourDataN[0]['img']; // Použitie pôvodného obrázka pri chybe
        }
    } else {
        $tourDataN = $tour->getPackagesId($_POST['id']);
        $img =  $tourDataN[0]['img'];  // Použitie pôvodného obrázka, ak nový nebol nahraný
    }

    $data = [
        'id' => $_POST['id'],
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'img' => $img,
        'duration' => $_POST['duration'] ?? '',
        'person' => $_POST['person'] ?? '',
        'price' => $_POST['price'] ?? '',
        'idcity' => $_POST['idcity'] ?? ''
    ];

    $update = $tour->updateTour($data['id'], $data);

   if ($update) {
        header("Location: adminhome.php");
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}

include_once "parts/head.php";
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Update Package Tour</h1>
    <div class="card shadow-sm p-4">
        <form action="tourupdate.php" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($tourdata['title'])?>" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($tourdata['description']); ?></textarea>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="img" class="form-label">Upload Image</label>
                <!-- Zobrazenie aktuálneho obrázka -->
                <?php if (!empty($tourdata['img'])): ?>
                    <div class="mb-2">
                        <img src="<?php echo htmlspecialchars($tourdata['img']); ?>" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                        <p class="mt-2">New Image</p>
                    </div>
                <?php endif; ?>
                <!-- Vstup na nahranie nového obrázka -->
                <input type="file" class="form-control" id="img" name="img" accept="image/*">
            </div>

            <!-- Duration -->
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" value="<?php echo htmlspecialchars($tourdata['duration']) ?>" placeholder="e.g., 5 days" required>
            </div>

            <!-- Number of Persons -->
            <div class="mb-3">
                <label for="person" class="form-label">Number of Persons</label>
                <input type="number" class="form-control" id="person" name="person" value="<?php echo htmlspecialchars($tourdata['person']) ?>" placeholder="Enter number of persons" min="1" required>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($tourdata['price']) ?>" placeholder="Enter price" min="0" step="0.01" required>
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="idcity" class="form-label">City</label>
                <select class="form-select" id="idcity" name="idcity" required>
                    <option value="" disabled>Select City</option>
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?= htmlspecialchars($city['id']); ?>"
                            <?php echo $city['id'] == $tourdata['idcity'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($city['city']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <!-- Submit and Return -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                <a href="adminhome.php" class="btn btn-secondary">Return</a>

            </div>
            <!-- id -->
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        </form>
    </div>
</div>
