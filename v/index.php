<?php

// Load dependencies via Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controllers\User;
use App\Controllers\Notice;

// Initialize User and Notice controllers
$User = new User();
$Notice = new Notice();

// Check if there is any registered user in the system
$userExists = (bool) $User->select();

// Fetch all notices from the database
$notices = $Notice->select();
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notice Board</title>

  <!-- Load Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <!-- Header Section -->
  <header class="text-center border-bottom p-1 d-flex justify-content-between align-items-center px-3">
    <h1 class="fs-4">Notice Board</h1>

    <?php
      // Define authentication-related links
      $href = !$userExists ? "/v/users/register.php" : "/v/users/login.php";
      $text = !$userExists ? "Sign-up" : "Login";
    ?>

    <div>
      <?php if (!isset($_SESSION['id'])): ?>
        <a href="<?= $href ?>"><?= $text ?></a>
      <?php else: ?>
        <a href="/v/users/edit.php" class="ms-2">Edit Profile</a>
        <a href="/v/notices/register.php" class="ms-2">Register</a>
        <a href="/api/users/exit.php" class="ms-2">Exit</a>
      <?php endif; ?>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <?php if (is_array($notices) && count($notices) > 0): ?>
      <?php foreach ($notices as $notice): ?>
        <div class="card w-100 mt-2 shadow">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($notice['title']) ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
              <?= date('d/m/Y H:i', strtotime($notice['creation_date'])) ?>
            </h6>
            <p class="card-text"><?= htmlspecialchars($notice['description']) ?></p>
            
            <?php if (!empty($notice['link'])): ?>
              <a href="<?= $notice['link'] ?>" target="_blank" class="card-link">Access</a>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['id'])): ?>
              <a href="/v/notices/edit.php?notice=<?= $notice['id'] ?>" class="ms-2">Edit</a>
              <a href="/api/notices/delete.php?notice=<?= $notice['id'] ?>" class="ms-2">Delete</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">Nothing to show here.</p>
    <?php endif; ?>
  </div>

  <!-- Load Bootstrap JavaScript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
