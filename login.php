<?php
session_start();

require_once __DIR__ . '/classes/User.php';
use classes\User;

$error = '';

//spracovanie prihlasovacieho formulara
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            $user = new User();
            $user->login($email, $password);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php
include_once "parts/head.php";
include_once "parts/topbar.php";
include_once "parts/navbar.php";
?>
<body>
<div class="login-container text-center pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h1>Login</h1>
    </div>

    <form action="login.php" method="post" style="max-width: 400px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div style="text-align: center; margin-top: 20px;">
             <button type="submit">Login</button>
            <a href="index.php" >Return</a>
        </div>
    </form>

</div>

</body>
</html>


