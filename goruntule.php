<?php
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

    <title>Kullanıcı Görüntüle</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kullanıcı Detayları
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
                                
                                    <div class="mb-3">
                                        <label>Kullanıcı İsim</label>
                                        <p class="form-control">
                                            <?=$kullanici['ad'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kullanıcı Soyisim</label>
                                        <p class="form-control">
                                            <?=$kullanici['soyad'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kullanıcı Email</label>
                                        <p class="form-control">
                                            <?=$kullanici['email'];?>
                                        </p>
                                    </div>
                                    <div>
                                    <label>Kullanıcı Şifre</label>
                                        <p class="form-control">
                                            <?=$kullanici['sifre'];?>
                                        </p>
                                    </div>
                                   

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