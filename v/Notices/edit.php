<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
  
  if(empty($_GET['aviso']) || !isset($_SESSION['id'])){
    header("Location: /");
  }

  use App\Controllers\Aviso;
  $Aviso = new Aviso();
  $aviso = $Aviso->selecionar(["id"=>$_GET['aviso']]);
  if(is_array($aviso) && count($aviso) > 0){
    $aviso = $aviso[0];
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edição de Avisos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="/api/avisos/editar.php" class="w-50 mt-5 m-auto" method="post">
      <input type="hidden" name="aviso" value="<?= $aviso['id'] ?>">
      <h3 class="text-center">Editar Aviso</h3>
      <div class="mb-3">
        <label for="titulo" class="form-title">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $aviso['titulo'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="link" class="form-title">Link</label>
        <input type="text" class="form-control" id="link" name="link" value="<?= $aviso['link'] ?>">
      </div>

      <div class="mb-3">
        <label for="descricao" class="form-title">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" required><?= $aviso['descricao'] ?></textarea>
      </div>

      <div class="mb-3">
        <input type="submit" class="btn w-100 btn-primary" value="Editar">
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
