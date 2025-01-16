<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include_once __DIR__ . '/classes/Tour.php';
use classes\Tour;

$package = new Tour();
$packages = $package->getPackages();
?>

<!doctype html>
<html  lang="en">
<?php
include_once __DIR__ . '/parts/head.php';
include_once __DIR__ . '/parts/topbar.php';
include_once __DIR__ . '/parts/navbaradmin.php';

?>

<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Tour Packages Admin</h1>
    <div class="mb-4 d-flex justify-content-end">
        <a href="tourinsert.php" class="btn btn-success btn-sm">
            <span class="me-1">+</span> New
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center custom-table">
            <thead class="thead-dark">
            <tr>
                <th style="width: 40px;">ID</th>
                <th style="width: 100px;">Image</th>
                <th style="width: 300px;">Title</th>
                <th style="width: 90px;">Duration</th>
                <th style="width: 80px;">Persons</th>
                <th style="width: 100px;">Price</th>
                <th style="width: 100px;">City</th>
                <th style="width: 100px;">Country</th>
                <th style="width: 100px;">Update</th>
                <th style="width: 90px;">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($packages)): ?>
                <?php foreach ($packages as $package): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($package['id']); ?></td>
                        <td><img class="img-fluid" src="<?php echo htmlspecialchars($package['img']) ?>" alt="Package Image"></td>
                        <td><?php echo htmlspecialchars($package['title']); ?></td>
                        <td><?php echo htmlspecialchars($package['duration']); ?></td>
                        <td><?php echo htmlspecialchars($package['person']); ?></td>
                        <td><?php echo htmlspecialchars($package['price']); ?></td>
                        <td><?php echo htmlspecialchars($package['city']); ?></td>
                        <td><?php echo htmlspecialchars($package['country']); ?></td>
                        <td>
                            <a href="tourupdate.php?id=<?php echo htmlspecialchars($package['id']); ?>" class="btn btn-warning btn-sm">
                                Update
                            </a>
                        </td>
                        <td>
                            <a href="tourdelete.php?id=<?php echo htmlspecialchars($package['id']); ?>" class="btn btn-danger btn-sm">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No packages found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
