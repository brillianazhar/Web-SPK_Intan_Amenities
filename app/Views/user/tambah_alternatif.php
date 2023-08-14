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
        <div class="order_editData">
            <form action="/addAlternatif" method="post" class="tambah_alternatif" id="tambah_alternatif">
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nama Alternatif</span>
                        <input type="text" id="namaalt" name="namaalt" autocomplete="off">
                        <label for="namaalt" generated="true" class="error"></label>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Kode Alternatif</span>
                        <input type="text" id="kodealt" name="kodealt" autocomplete="off">
                        <label for="kodealt" generated="true" class="error"></label>
                    </div>
                </div>
                <?php
                foreach ($kriteria as $kr) :
                ?>
                    <div class="container-input-field">
                        <div class="input-field form-control">
                            <span>Nilai <?= $kr['nama_kriteria'] ?></span>
                            <?php
                            $db = \Config\Database::connect();
                            $query   = $db->query("SELECT * FROM sub_kriteria WHERE id_kriteria = '" . $kr['id'] . "'");
                            $results = $query->getResultArray();
                            ?>
                            <?php if ($results) : ?>
                                <select name="<?= $kr['id'] ?>" id="nilaiskr">
                                    <?php foreach ($results as $r) : ?>
                                        <option value="<?= $r['value'] ?>"><?= $r['nama_sub_kriteria'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            <?php else : ?>
                                <input type="number" id="<?= $kr['id'] ?>" name="<?= $kr['id'] ?>" autocomplete="off">
                                <label for="nilaiskr" generated="true" class="error"></label>
                            <?php endif ?>
                        </div>
                    </div>
                <?php
                endforeach
                ?>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>