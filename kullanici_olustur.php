<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Kullanıcı Oluştur</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('mesaj.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kullanıcı Ekle
                            <a href="liste.php" class="btn btn-danger float-end">GERİ</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <div class="mb-3">
                                <label>Kullanıcı İsim</label>
                                <input type="text" name="ad" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Kullanıcı Soyisim</label>
                                <input type="text" name="soyad" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Kullanıcı Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Şifre</label>
                                <input type="text" name="sifre" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>