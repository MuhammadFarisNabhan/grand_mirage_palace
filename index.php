<?php 
    require 'koneksi.php';
    include 'router.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Grand Mirage Palace</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Grand Mirage Palace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?page=produk">Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=daftar_harga">Daftar Harga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=tentang_kami">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=pesan_kamar">Pesan Kamar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=data">Data Pemesan</a>
            </li>            
        </ul>
        </div>
    </div>
    </nav>

    <div class="main">
        <div>
            <?php include $content ?>
        </div>
    </div>
    <img src="./img/background.jpg" alt="" 
        style="
            z-index: -1;
            object-fit:cover;
            object-position:center;
            position:absolute;
            top:5%;
            width:100%;
            filter:brightness(70%)
        "
    >    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>