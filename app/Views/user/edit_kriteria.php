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
            <form action="/editKriteria/<?= $kriteria['id'] ?>" method="post" class="edit_kriteria" id="edit_kriteria">
                <div class="container-input-field">
                    <input type="hidden" name="idkr" id="idkr" value="<?= $kriteria['id'] ?>">
                    <div class="input-field form-control">
                        <span>Nama Kriteria</span>
                        <input type="text" id="namakr" name="namakr" value="<?= $kriteria['nama_kriteria'] ?>" autocomplete="off">
                    </div>
                    <label for="namakr" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Jenis Kriteria</span>
                        <select name="jeniskr" id="jeniskr">
                            <option <?php if ($kriteria['jenis_kriteria'] == 'benefit') echo 'selected = "selected"' ?> value="benefit">Benefit</option>
                            <option <?php if ($kriteria['jenis_kriteria'] == 'cost') echo 'selected = "selected"' ?> value="cost">Cost</option>
                        </select>
                    </div>
                    <label for="jeniskr" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Bobot Kriteria</span>
                        <select name="bobotkr" id="bobotkr">
                            <option <?php if ($kriteria['bobot'] == 1) echo 'selected = "selected"' ?> value=1>1 ( Tidak Penting )</option>
                            <option <?php if ($kriteria['bobot'] == 2) echo 'selected = "selected"' ?> value=2>2 ( Kurang Penting )</option>
                            <option <?php if ($kriteria['bobot'] == 3) echo 'selected = "selected"' ?> value=3>3 ( Cukup Penting )</option>
                            <option <?php if ($kriteria['bobot'] == 4) echo 'selected = "selected"' ?> value=4>4 ( Penting )</option>
                            <option <?php if ($kriteria['bobot'] == 5) echo 'selected = "selected"' ?> value=5>5 ( Sangat Penting )</option>
                        </select>
                    </div>
                    <label for="bobotkr" generated="true" class="error"></label>
                </div>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Edit</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>