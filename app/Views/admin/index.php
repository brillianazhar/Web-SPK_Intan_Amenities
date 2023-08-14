<?= $this->extend('layout/sidebar-navbar'); ?>

<?= $this->section('content2'); ?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1><?= $title; ?></h1>
        </div>
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
    </ul> -->


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
            <table class="user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1 + (5 * ($currentPage - 1));
                    ?>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <p><?= $u['name']; ?></p>
                            </td>
                            <td><?= $u['email'] ?></td>
                            <td>
                                <?php if ($u['is_active'] == 1) : ?>
                                    <span>Active</span>
                                <?php else : ?>
                                    <span>Not Active</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($u['is_active'] == 1) : ?>
                                    <form method="post" action="/deleteUser/<?= $u['id']; ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="status pending" onclick="return confirm('Are you sure you want to delete this user ?')">Delete</button>
                                    </form>
                                <?php else : ?>
                                    <form method="post" action="/confirmUser/<?= $u['id']; ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="CONFIRM">
                                        <button type="submit" class="status completed" onclick="return confirm('Are you sure you want to activate this user ?')">Confirm</button>
                                    </form>
                                    <form method="post" action="/deleteUser/<?= $u['id']; ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="status pending" onclick="return confirm('Are you sure you want to delete this user ?')">Delete</button>
                                    </form>
                                <?php endif ?>
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
            <?= $pager->links('user', 'alternatif_pagination') ?>
        </div>
    </div>
</main>
<!-- MAIN -->

<?= $this->endSection(); ?>