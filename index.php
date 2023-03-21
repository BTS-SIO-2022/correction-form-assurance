<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire assurance</title>
</head>
<body>

<?php 

//var_dump($_POST);

include 'functions_utiles.php';

$age = getCleanNumericPostParam('age');
$nbreAccident = getCleanNumericPostParam('accident');
$anciennetePermis = getCleanNumericPostParam('anciennete');
$ancienneteAssurance = getCleanNumericPostParam('anciennete-assurance');

//var_dump($age, $nbreAccident, $anciennetePermis, $ancienneteAssurance);

$tarif = getTarif($age, $anciennetePermis, $ancienneteAssurance,  $nbreAccident);

$message = getColorandMessage($tarif);

//var_dump($tarif, $message);

?>
<?php
if(!empty($_POST) && !empty($message)):?>
<div>
    <p>Vous avez le droit au tarif : <strong class="<?=$message['class'];?>"><?=$message['message'];?></strong> </p>
</div>
<?php endif;?>



<form action="" method="POST">
  <div class="mb-3">
    <label for="exampleInputAge" class="form-label">Renseignez votre âge</label>
    <input type="number" name="age" class="form-control" id="exampleInputAge" required min="18" max="100">
  </div>
  <div class="mb-3">
    <label for="exampleInputAnciennete" class="form-label">Renseignez l'ancienneté de votre permis</label>
    <input type="number" name="anciennete" class="form-control" id="exampleInputAnciennete" required min="0" max="100">
  </div>
  <div class="mb-3">
    <label for="exampleInputAncienneteAssurance" class="form-label">Renseignez l'ancienneté de votre assurance</label>
    <input type="number" name="anciennete-assurance" class="form-control" id="exampleInputAncienneteAssurance" required min="0" max="100">
  </div>
  <div class="mb-3">
    <label for="exampleInputAccident" class="form-label">Renseignez le nombre d'accidents responsables</label>
    <input type="number" name="accident" class="form-control" id="exampleInputAccident" required min="0" max="100">
  </div>

  <button type="submit" class="btn btn-primary">Calculer mon tarif</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>