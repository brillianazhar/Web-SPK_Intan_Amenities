<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1><?= $title ?></h1>
        </div>
        <a target="_blank" href="export_pdf" class="btn-download">
            <i class='bx bxs-cloud-download'></i>
            <span class="text">Download PDF</span>
        </a>
        <!-- <a href="#" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Download PDF</span>
                </a> -->
    </div>
    <div class="topVektor">
        <span>Berdasarkan hasil perhitungan, maka pemasok spon dengan nilai tertinggi adalah <strong><?= $top['nama_alternatif'] ?></strong></span>
    </div>
    <div class="table-data">
        <?php /*
        <div class="order">
            <div class="head">
                <h3>Nilai Kriteria tiap Alternatif</h3>
            </div>
            <table class="nilaiKriteria">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Kode Alternatif</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k['nama_kriteria'] ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatif as $a) : ?>
                        <tr>
                            <td><?= $a['nama_alternatif'] ?></td>
                            <td><?= $a['kode_alternatif'] ?></td>
                            <?php
                            $db = Config\Database::connect();
                            $queryKriteria = "  SELECT * FROM hasil
                            WHERE id_alternatif = '" . $a['id'] . "'";

                            $nilaiKriteria = $db->query($queryKriteria)->getResultArray();
                            ?>
                            <?php foreach ($nilaiKriteria as $nk) : ?>
                                <td><?= $nk['nilai'] ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        */ ?>
        <?php /*
        <div class="order">
            <div class="head">
                <h3>Nilai Vektor</h3>
            </div>
            <table class="nilaiVektor">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Kode Alternatif</th>
                        <th>Vektor S</th>
                        <th>Vektor V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatif as $alt) : ?>
                        <tr>
                            <td><?= $alt['nama_alternatif'] ?></td>
                            <td><?= $alt['kode_alternatif'] ?></td>
                            <td><?= $alt['vektor_s'] ?></td>
                            <td><?= $alt['vektor_v'] ?></td>
                        </tr>
                    <?php endforeach  ?>
                </tbody>
            </table>
        </div>
        */ ?>

        <div class="order">
            <div class="head">
                <h3>Rangking</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th>Vektor S</th>
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
                            <td><?= $r['vektor_s'] ?></td>
                            <td><strong><?= $r['vektor_v'] ?></strong></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3>1020</h3>
                <p>New Order</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3>2834</h3>
                <p>Visitors</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>$2543</h3>
                <p>Total Sales</p>
            </span>
        </li>
    </ul>
        <div class="todo">
            <div class="head">
                <h3>Todos</h3>
                <i class='bx bx-plus'></i>
                <i class='bx bx-filter'></i>
            </div>
            <ul class="todo-list">
                <li class="completed">
                    <p>Todo List</p>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="completed">
                    <p>Todo List</p>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="not-completed">
                    <p>Todo List</p>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="completed">
                    <p>Todo List</p>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
                <li class="not-completed">
                    <p>Todo List</p>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </li>
            </ul>
        </div>
    </div> -->
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>