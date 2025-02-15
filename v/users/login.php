<?php

// Load dependencies via Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controllers\User;

$user = new User();
$userExists = (bool)$user->select();

// Redirect to user registration if no users exist
if (!$userExists) {
    header("Location: /v/users/register.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Load Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXbH0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="/api/users/login.php" class="mt-5 m-auto w-50" method="post">
      <h3 class="text-center">Login</h3>
      
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" name="login" id="login" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3">
        <input type="submit" class="btn w-100 btn-primary" value="Login">
      </div>
    </form>
  </div>

  <!-- Load Bootstrap JavaScript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
