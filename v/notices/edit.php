<?php

// Load dependencies via Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controllers\Notice;

// Redirect if notice ID is not provided or user is not logged in
if (empty($_GET['notice']) || !isset($_SESSION['id'])) {
    header("Location: /");
    exit;
}

// Initialize Notice controller and fetch the requested notice
$Notice = new Notice();
$noticeData = $Notice->select(["id" => $_GET['notice']]);
$notice = is_array($noticeData) && count($noticeData) > 0 ? $noticeData[0] : null;

// Redirect if notice is not found
if (!$notice) {
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notice Edit</title>

  <!-- Load Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="/api/notices/edit.php" class="w-50 mt-5 m-auto" method="post">
      <input type="hidden" name="notice" value="<?= htmlspecialchars($notice['id']) ?>">
      <h3 class="text-center">Edit Notice</h3>
      
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($notice['title']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="text" class="form-control" id="link" name="link" value="<?= htmlspecialchars($notice['link']) ?>">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" required><?= htmlspecialchars($notice['description']) ?></textarea>
      </div>

      <div class="mb-3">
        <input type="submit" class="btn w-100 btn-primary" value="Edit">
      </div>
    </form>
  </div>

  <!-- Load Bootstrap JavaScript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
