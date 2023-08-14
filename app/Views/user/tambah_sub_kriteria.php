<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1><?= $title ?></h1>
        </div>
    </div>
    <div class="table-data">
        <div class="order">
            <form action="/addSubKriteria" method="post" class="tambah_sub_kriteria" id="tambah_sub_kriteria">
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Main Kriteria</span>
                        <select name="namakr" id="namakr">
                            <?php foreach ($kriteria as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama_kriteria'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nama Sub Kriteria</span>
                        <input type="text" id="namaskr" name="namaskr" autocomplete="off">
                        <label for="namaskr" generated="true" class="error"></label>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nilai</span>
                        <input type="number" id="nilaiskr" name="nilaiskr" autocomplete="off">
                        <label for="nilaiskr" generated="true" class="error"></label>
                    </div>
                </div>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>