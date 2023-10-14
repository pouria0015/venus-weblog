<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/icon/fav-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.rtl.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/main.css"); ?>">
    <title><?= SITENAME ?></title>
</head>

<body>

    <header>
        <!-- start navbar  -->

        <div class="container">
            <nav class="navbar navbar-expand-lg bg-light m-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= url_view_builder(""); ?>">ونوس</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= (empty(active_header(""))) ? active_header("pages/index") : active_header("") ?>" aria-current="page" href="<?= url_view_builder(""); ?>">خانه</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= active_header("pages/about"); ?>" href="<?= url_view_builder("pages/about"); ?>">درباره ما</a>
                            </li>
                            <?php if (has('user')) {

                                if (get('user')['user_type'] === "admin" || get('user')['user_type'] ===  "writer") { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= active_header("admin"); ?>" href="<?= url_view_builder("admin"); ?>">پنل ادمین</a>
                                    </li>
                                <?php

                                }
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= active_header("users/userPanel"); ?>" href="<?= url_view_builder("users/userPanel"); ?>">پروفایل</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= url_view_builder("users/logout"); ?>">خروج</a>
                                </li>
                            <?php } ?>

                            <?php if (!has('user')) {  ?>

                                <li class="nav-item">
                                    <a class="nav-link <?= active_header("users/login"); ?>" href="<?= url_view_builder("users/login"); ?>">ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= active_header("users/register"); ?>" href="<?= url_view_builder("users/register"); ?>">ثبت نام</a>
                                </li>

                            <?php } ?>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" id="search" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">جستجو</button>
                        
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <!-- end navbar  -->