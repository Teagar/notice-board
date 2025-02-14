<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . 'src/process/config.php';

try {
  $stmt = $pdo->query("SELECT 'Connecticion success' AS message");
  $result = $stmt->fetch();
  echo $result['message'];

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
