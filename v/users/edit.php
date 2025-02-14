<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controllers\User;
$User = new User();

$userExists = (bool)$User->select();

if(!$userExists){
  header("Location: /v/users/register.php");
}

$where = [
  ['id', $_SESSION['id']]
];

$user = $User->select($where)[0];
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register User</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="/api/users/edit.php" class="w-50 mt-5 m-auto" method="post">
      <h3 class="text-center">Register User</h3>
      <div class="mb-3">
        <label for="login" class="form-title">Login</label>
        <input type="text" class="form-control" name="login" id="login" value="<?= $user['login'] ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-title">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
        <div id="passwordHelp" class="form-text">To change the password, type the new value.<br> Case dont want edit, leave in blank</div>
      </div>

      <div class="mb-3">
        <input type="submit" class="btn w-100 btn-primary" value="Save">
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
