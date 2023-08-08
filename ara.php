<?php

session_start();
require 'dbcon.php';

$query = "SELECT * FROM tablo3";
$query_run = mysqli_query($con, $query);

if (isset($_GET['ara'])) {
    $search_keyword = $_GET['search_keyword'] ?? '';

    if (!empty($search_keyword)) {
        // Modify the query to search for records based on the keyword
        $query = "SELECT * FROM tablo3 WHERE ad LIKE '%$search_keyword%' OR soyad LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%'";
        $query_run = mysqli_query($con, $query);
    } else {
        // If no search keyword is provided, retrieve all records
        $query = "SELECT * FROM tablo3";
        $query_run = mysqli_query($con, $query);
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Kullanıcı CRUD</title>
</head>
<body>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Kullanıcı Ara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="ara.php" method="GET">
                        <div class="mb-3">
                            <input type="text" name="search_keyword" class="form-control" placeholder="Arama kelimesini girin...">
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="ara" class="btn btn-primary">Ara</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <div class="container mt-4">

        <?php include('mesaj.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>KULLANICILAR
                            <a href="kullanici_olustur.php" class="btn btn-primary float-end">Kullanıcı Ekle</a>
                            <button type="button" class="btn btn-secondary float-end mx-2" data-bs-toggle="modal" data-bs-target="#searchModal">Ara</button>
                            <a href="liste.php" class="btn btn-danger float-end">GERİ</a>
                        </h4>
                    </div>
    
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>İsim</th>
                                    <th>Soyisim</th>
                                    <th>Email</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($query_run && mysqli_num_rows($query_run) > 0) {
                                    $count = 1;
                                    foreach ($query_run as $kullanici) {
                                        ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= $kullanici['ad']; ?></td>
                                            <td><?= $kullanici['soyad']; ?></td>
                                            <td><?= $kullanici['email']; ?></td>
                                            <td>
                                                <a href="goruntule.php?id=<?= $kullanici['id']; ?>" class="btn btn-info btn-sm">Görüntüle</a>
                                                <a href="duzenle.php?id=<?= $kullanici['id']; ?>" class="btn btn-success btn-sm">Düzenle</a>
                                                <form action="code.php" method="POST" class="d-inline">
                                                    <button type="submit" name="sil" value="<?= $kullanici['id']; ?>" class="btn btn-danger btn-sm">Sil</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No Record Found</td></tr>";
                                }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>