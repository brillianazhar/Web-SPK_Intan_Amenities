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
            <form action="/addKriteria" method="post" class="tambah_kriteria" id="tambah_kriteria">
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nama Kriteria</span>
                        <input type="text" id="namakr" name="namakr" autocomplete="off">
                        <label for="namakr" generated="true" class="error"></label>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Jenis Kriteria</span>
                        <select name="jeniskr" id="jeniskr">
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Bobot Kriteria</span>
                        <select name="bobotkr" id="bobotkr">
                            <option value=1>1 ( Tidak Penting )</option>
                            <option value=2>2 ( Kurang Penting )</option>
                            <option value=3>3 ( Cukup Penting )</option>
                            <option value=4>4 ( Penting )</option>
                            <option value=5>5 ( Sangat Penting )</option>
                        </select>
                    </div>
                </div>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>