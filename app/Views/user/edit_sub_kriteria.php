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
            <form action="/editSubKriteria/<?= $subKriteria['id'] ?>" method="post" class="edit_sub_kriteria" id="edit_sub_kriteria">
                <input type="hidden" name="idskr" id="idskr" value="<?= $subKriteria['id'] ?>">
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Main Kriteria</span>
                        <select name="namakr" id="namakr">
                            <?php foreach ($kriteria as $k) : ?>
                                <option <?php if ($subKriteria['id_kriteria'] == $k['id']) echo 'selected = "selected"' ?> value="<?= $k['id'] ?>"><?= $k['nama_kriteria'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nama Sub Kriteria</span>
                        <input type="text" id="namaskr" name="namaskr" value="<?= $subKriteria['nama_sub_kriteria'] ?>" autocomplete="off">
                        <label for="namaskr" generated="true" class="error"></label>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nilai</span>
                        <input type="text" id="nilaiskr" name="nilaiskr" value="<?= $subKriteria['value'] ?>" autocomplete="off">
                        <label for="nilaiskr" generated="true" class="error"></label>
                    </div>
                </div>

                <button id="btn-solid-signup" class="btn-solid" type="submit">Edit</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>