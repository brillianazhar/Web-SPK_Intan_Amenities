<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1><?= $title ?></h1>
        </div>
    </div>
    <a href="tambah_sub_kriteria" class="btn-download">
        <span class="text">Tambah Sub Kriteria</span>
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
            <table class="subKriteria">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1 + (8 * ($currentPage - 1));
                    ?>
                    <?php
                    foreach ($subKriteria as $sk) :  ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $sk['nama_kriteria']; ?></td>
                            <td><?= $sk['nama_sub_kriteria']; ?></td>
                            <td><?= $sk['value']; ?></td>
                            <td class="action_form">
                                <form method="post" action="/edit_sub_kriteria/<?= $sk['id']; ?>">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="status process">Edit</button>
                                </form>
                                <form method="post" action="/deleteSubKriteria/<?= $sk['id']; ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="status pending" onclick="return confirm('Are you sure you want to delete this sub kriteria ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                    <?php
                    endforeach;  ?>
                </tbody>
            </table>
        </div>
        <div class="custom_pagination">
            <?= $pager->links('subKriteria', 'alternatif_pagination') ?>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>