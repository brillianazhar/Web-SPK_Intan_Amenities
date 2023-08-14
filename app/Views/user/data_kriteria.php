<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1><?= $title ?></h1>
        </div>
    </div>
    <a href="tambah_kriteria" class="btn-download">
        <span class="text">Tambah Kriteria</span>
    </a>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <form action="" method="post">
                    <div class="form-input">
                        <input name="keyword" type="search" placeholder="Search..." autocomplete="off">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>
            </div>
            <table class="kriteria">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Jenis Kriteria</th>
                        <th>Bobot</th>
                        <th>Bobot Ternormalisasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1 + (5 * ($currentPage - 1));
                    ?>
                    <?php foreach ($kriteria as $k) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <?= $k['nama_kriteria'] ?>
                            </td>
                            <td>
                                <?= $k['jenis_kriteria'] ?>
                            </td>
                            <td>
                                <?= $k['bobot'] ?>
                            </td>
                            <td>
                                <?= $k['bobot_ternormalisasi'] ?>
                            </td>
                            <td class="action_form">
                                <form method="post" action="/edit_kriteria/<?= $k['id']; ?>">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="status process">Edit</button>
                                </form>
                                <form method="post" action="/deleteKriteria/<?= $k['id']; ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="status pending" onclick="return confirm('Are you sure you want to delete this kriteria ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="custom_pagination">
            <?= $pager->links('kriteria', 'alternatif_pagination') ?>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>