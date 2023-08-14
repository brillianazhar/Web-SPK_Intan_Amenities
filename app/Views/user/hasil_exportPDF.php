<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            width: 100%;
            height: auto;
        }

        .table-data {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;
        }

        .title-table {
            text-align: center;
            font-weight: 800;
        }

        .order {}

        .head {
            text-align: center;
            margin-bottom: 10px;
        }

        .table-top td {
            padding-right: 10px;
        }

        .table-top2 {
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 50%;
        }

        .table-top2 th {
            border: 1px solid black;
            text-align: center;
            padding: 20px;
        }

        .table-top2 td {
            text-align: center;
            border: 1px solid black;
        }

        .asd {
            padding: 2%;
        }

        .asd hr {
            margin-bottom: 2px;
        }

        .kesimpulan {
            padding: 2%;
        }
    </style>

    <title><?= $title; ?></title>
</head>

<body>
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Laporan SPK Pemilihan Pemasok Spon</h3>
                <strong>
                    <h1>Intan Amenities</h1>
                </strong>
            </div>
            <div class="asd">
                <hr>
                <hr><br>
                <table class="table-top">
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?= date("d/m/Y") ?></td>
                    </tr>
                    <tr>
                        <td>Jenis</td>
                        <td>:</td>
                        <td>Daftar Pemasok Spon</td>
                    </tr>
                </table>
            </div>
            <div class="title-table">
                <h3>Rangking Pemasok</h3>
            </div>
            <table class="table-top2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th>Vektor V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($rangking as $r) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $r['nama_alternatif'] ?></td>
                            <td><strong><?= $r['vektor_v'] ?></strong></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
            <div class="kesimpulan">
                <span>Berdasarkan table di atas, maka pemasok spon dengan nilai tertinggi adalah <strong><?= $top['nama_alternatif'] ?></strong>, dengan nilai Vektor V sebesar <strong><?= $top['vektor_v'] ?></strong></span>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/custom2.js') ?>"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>