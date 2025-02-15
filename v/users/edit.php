<?php

// Load dependencies via Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controllers\User;
$User = new User();

// Check if any user exists
$userExists = (bool) $User->select();

// Redirect to registration page if no user exists
if (!$userExists) {
    header("Location: /v/users/register.php");
    exit;
}

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit;
}

// Fetch user data
$where = [['id', $_SESSION['id']]];
$userData = $User->select($where);
$user = is_array($userData) && count($userData) > 0 ? $userData[0] : null;

// Redirect if user data is not found
if (!$user) {
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register User</title>

  <!-- Load Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="/api/users/edit.php" class="w-50 mt-5 m-auto" method="post">
      <h3 class="text-center">Register User</h3>
      
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" name="login" id="login" value="<?= htmlspecialchars($user['login']) ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
        <div id="passwordHelp" class="form-text">To change the password, type the new value.<br>If you don’t want to edit, leave it blank.</div>
      </div>

      <div class="mb-3">
        <input type="submit" class="btn w-100 btn-primary" value="Save">
      </div>
    </form>
  </div>

  <!-- Load Bootstrap JavaScript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
