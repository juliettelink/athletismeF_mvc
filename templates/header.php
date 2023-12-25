<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <title>Athlétime</title>

</head>
<body>
  <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
          <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img width="150" src="assets/images/logo.jpg">
          </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php?controller=page&action=home" class="nav-link px-2 link-secondary">Acceuil</a></li>
          <li><a href="index.php?controller=page&action=about" class="nav-link px-2">A propos</a></li>
        </ul>

        <div class="col-md-3 text-end">
          <?php

use App\Entity\User;

        if (User::isAuthenticated()): ?>
            <a href="index.php?controller=auth&action=logout" type="button" class="btn btn-outline-danger me-2">Déconnexion</a>
          <?php else: ?>
            <a href="index.php?controller=auth&action=login" type="button" class="btn btn-outline-primary me-2">Connexion</a>
          <?php endif; ?>
          <a href="index.php?controller=user&action=register" type="button" class="btn btn-secondary">Inscription</a>
          
        </div>
      </header>
  

  <main>