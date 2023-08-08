<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Kullanıcı Düzenle</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('mesaj.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kullanıcı Düzenle 
                            <a href="liste.php" class="btn btn-danger float-end">GERİ</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM tablo3 WHERE id='$id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $kullanici = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $kullanici['id']; ?>">

                                    <div class="mb-3">
                                        <label>Kullanıcı İsim</label>
                                        <input type="text" name="ad" value="<?=$kullanici['ad'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Kullanıcı Soyisim</label>
                                        <input type="text" name="soyad" value="<?=$kullanici['soyad'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Kullanıcı Email</label>
                                        <input type="email" name="email" value="<?=$kullanici['email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Şifre</label>
                                        <input type="text" name="sifre" value="<?=$kullanici['sifre'];?>" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="submit" name="güncelle" class="btn btn-primary">
                                           Kullanıcı Güncelle
                                        </button>
                                    </div>
                                    

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>