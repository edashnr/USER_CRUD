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

    <title>Lisans Görüntüle</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lisans Detayları
                            <a href="liste.php" class="btn btn-danger float-end">GERİ</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $user_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM lisans WHERE user_id='$user_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $kullanici = mysqli_fetch_array($query_run);
                                $now = date_create()->format('Y-m-d H:i:s');
                                $remaining_days = ceil((strtotime($kullanici['bitis']) - strtotime($now)) / (60 * 60 * 24));
                                ?>

                                    <div class="mb-3">
                                        <label>Lisans Türü</label>
                                        <p class="form-control">
                                            <?=$kullanici['lisans_turu'];?>
                                        </p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label>Lisans Süresi</label>
                                        <p class="form-control">
                                            <?=$kullanici['süre'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Lisans Başlangıç Tarihi</label>
                                        <p class="form-control">
                                            <?=$kullanici['baslangic'];?>
                                        </p>
                                    </div>
                                   <div class="mb-3">
                                    <label>Lisans Bitiş Tarihi</label>
                                    <p class="form-control">
                                    <?php
                                    // Convert the date string to a different format
                                    $formatted_date = date('d.m.Y', strtotime($kullanici['bitis']));
                                    echo $formatted_date;
                                    ?>
                                    </p>
                                    </div>

                                    <label>kalan Süre</label>
                                        <p class="form-control">
                                            <?=$remaining_days;?>
                                        </p>

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