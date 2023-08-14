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
            <form action="/editAlternatif/<?= $alternatif['id'] ?>" method="post" class="edit_alternatif" id="edit_alternatif">
                <input type="hidden" name="idalt" id="idalt" value="<?= $alternatif['id'] ?>">
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Nama Alternatif</span>
                        <input type="text" id="namaalt" name="namaalt" value="<?= $alternatif['nama_alternatif'] ?>" autocomplete="off">
                        <label for="namaalt" generated="true" class="error"></label>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <span>Kode Alternatif</span>
                        <input type="text" id="kodealt" value="<?= $alternatif['kode_alternatif'] ?>" name="kodealt" autocomplete="off">
                        <label for="kodealt" generated="true" class="error"></label>
                    </div>
                </div>
                <?php /*
                foreach ($kriteria as $kr) :
                    $db = \Config\Database::connect();
                    $id_kr = $kr['id'];
                    $id_alt = $alternatif['id'];
                    $query   = $db->query("SELECT nilai FROM hasil WHERE id_kriteria = $id_kr AND  id_alternatif = $id_alt");
                    $results = $query->getRowArray();
                ?>
                    <div class="container-input-field">
                        <div class="input-field form-control">
                            <span>Nilai <?= $kr['nama_kriteria'] ?></span>
                            <input type="number" id="nilaialt" <?php if ($results == null) : ?> value="0" <?php else : ?> value="<?= $results['nilai']; ?>" <?php endif ?> name="<?= $kr['id'] ?>" autocomplete="off">
                            <label for="nilaialt" generated="true" class="error"></label>
                        </div>
                    </div>
                <?php
                endforeach
                */ ?>
                <?php
                foreach ($kriteria as $kr) :
                ?>
                    <div class="container-input-field">
                        <div class="input-field form-control">
                            <span>Nilai <?= $kr['nama_kriteria'] ?></span>
                            <?php
                            $db = \Config\Database::connect();
                            $id_kr = $kr['id'];
                            $id_alt = $alternatif['id'];

                            $query2   = $db->query("SELECT nilai FROM hasil WHERE id_kriteria = $id_kr AND  id_alternatif = $id_alt");
                            $results2 = $query2->getRowArray();

                            $query   = $db->query("SELECT * FROM sub_kriteria WHERE id_kriteria = '" . $kr['id'] . "'");
                            $results = $query->getResultArray();
                            ?>
                            <?php if ($results) : ?>
                                <select name="<?= $kr['id'] ?>" id="nilaiskr">
                                    <?php foreach ($results as $r) : ?>
                                        <option <?php if ($r['value'] == $results2['nilai']) echo 'selected = "selected"' ?> value="<?= $r['value'] ?>"><?= $r['nama_sub_kriteria'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            <?php else : ?>
                                <input type="number" id="<?= $kr['id'] ?>" name="<?= $kr['id'] ?>" <?php if ($results2 == null) : ?> value="0" <?php else : ?> value="<?= $results2['nilai']; ?>" <?php endif ?> autocomplete="off">
                                <label for="nilaiskr" generated="true" class="error"></label>
                            <?php endif ?>
                        </div>
                    </div>
                <?php
                endforeach
                ?>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Edit</button>
            </form>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>