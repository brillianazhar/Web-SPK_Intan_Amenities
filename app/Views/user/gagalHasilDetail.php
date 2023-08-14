<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="pesan-error">
        <div class="head-title">
            <h1><?= $title ?></h1>
        </div>
        <div class="message">
            <p>Berikut penyebab error : <br></p>
            <span>Terdapat nilai kriteria <strong>&nbsp<?= $nama_kriteria ?>&nbsp</strong> yang belum terisi pada alternatif <strong>&nbsp<?= $nama_alternatif ?>&nbsp</strong></span>
        </div>
    </div>

    <!-- <div class="table-data">
        <div class="order">
            <div class="head">
                <form action="" method="post">
                    <div class="form-input">
                        <input name="keyword" type="search" placeholder="Search..." autocomplete="off">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>