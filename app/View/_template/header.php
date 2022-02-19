<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= $this->getCSS() ?>
    <?= $this->getScripts() ?>

    <title><?= APP_NAME ?></title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="/site/"><?= APP_NAME ?></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/site/Trip/">Trip</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/site/Station/">Station</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/site/Info/">Info</a>
            </li>
        </ul>
    </nav>

    <div class="jumbotron">
        <div class="container">
            <h1><?= $this->title ?></h1>

            <p><?= $this->text ?></p>
        </div>
    </div>