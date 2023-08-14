<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= base_url('css/custom2.css') ?>" type="text/css">

    <title><?= $title; ?></title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bx-registered'></i>
            <span class="text">Intan Amenities</span>
        </a>

        <?php

        $db = Config\Database::connect();
        $role_id = session()->get('role_id');
        $queryMenu = "  SELECT `user_menu`.`id`, `menu`
                        FROM `user_menu` JOIN `user_access_menu`
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id` = $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC";

        $menu = $db->query($queryMenu)->getResultArray();
        ?>

        <ul class="side-menu top">
            <!-- <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li> -->
            <?php
            $i = 1;
            $j = count($menu);
            ?>
            <?php foreach ($menu as $m) : ?>
                <?php
                $menuId = $m["id"];
                $querySubMenu = "   SELECT * FROM `user_sub_menu`
                                    WHERE `menu_id` = $menuId
                                    AND `is_active`= 1
                                    ORDER BY `num_order` ASC";

                $subMenu = $db->query($querySubMenu)->getResultArray();
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                    <?php
                    if ($sm['title'] == $title) :
                    ?>
                        <li class="active">
                            <a href="<?= base_url($sm['url']) ?>">
                                <i class='<?= $sm['icon'] ?>'></i>
                                <span class="text"><?= $sm['title'] ?></span>
                            </a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?= base_url($sm['url']) ?>">
                                <i class='<?= $sm['icon'] ?>'></i>
                                <span class="text"><?= $sm['title'] ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($i != $j) : ?>
                    <hr>
                <?php endif ?>
                <?php
                $i++;
                ?>

            <?php endforeach; ?>
        </ul>

        <ul class="side-menu bottom">
            <!-- <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li> -->
            <li>
                <a href="/logout" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <div class="right-nav-menu">
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
            </div>
        </nav>
        <!-- NAVBAR -->

        <?= $this->renderSection("content2"); ?>

    </section>
    <!-- CONTENT -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/custom2.js') ?>"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>