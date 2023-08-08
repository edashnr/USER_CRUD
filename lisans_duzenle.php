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

    <title>Lisans Düzenle</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('mesaj.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lisans Düzenle 
                            <a href="liste.php" class="btn btn-danger float-end">GERİ</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM lisans WHERE user_id='$id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $kullanici = mysqli_fetch_array($query_run);
                                $now = date_create()->format('Y-m-d H:i:s');
                                $remaining_days = ceil((strtotime($kullanici['bitis']) - strtotime($now)) / (60 * 60 * 24));
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $kullanici['id']; ?>">

                                    <div class="mb-3">
                                        <label>Lisans Türü</label>
                                        
                                        <select name="lisans_turu" class="form-select">
                                            <option value="Microsoft Office">Microsoft Office</option>
                                            <option value="AutoCAD">AutoCAD</option>
                                            <option value="Oracle Database">Oracle Database</option>
                                            <option value="Sketch">Sketch</option>
                                            <option value="Autodesk Revit">Autodesk Revit</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Lisans Süresi</label>
                                        <div class="input-group">
                                        <input type="text" name="süre" value="<?=$kullanici['süre'];?>" class="form-control">
                                        <select name="time_unit" class="form-select">
                                            <option value="days">Gün</option>
                                            <option value="months">Ay</option>
                                            <option value="years">Yıl</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Lisans Başlangıç Tarihi</label>
                                        <input type="date" name="baslangic" value="<?=$kullanici['baslangic'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Lisans Bitiş Tarihi</label>
                                        <input type="date" name="bitis" value="<?=$kullanici['bitis'];?>" class="form-control">
                                    </div>
                                    
                                    
                                    
                                    <div class="mb-3">
                                        <button type="submit" name="lisans_güncelle" class="btn btn-primary">
                                           Lisans Güncelle
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