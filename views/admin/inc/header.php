<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/icon/fav-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.rtl.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/main.css"); ?>">
    <title><?= SITENAME ?> | پنل ادمین</title>
</head>

<body>

    <header>
        <!-- start navbar  -->

        <div class="container">
            <nav class="navbar navbar-expand-lg bg-light m-2">
                <div class="container-fluid">
                    <h3 class="navbar-brand">پنل ادمین</h3>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= (empty(active_header("admin/index"))) ? active_header("admin") : active_header("admin/index") ?>" aria-current="page" href="<?= url_view_builder("admin/index"); ?>">خانه</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= active_header("admin/addPost") ?>" href="<?= url_view_builder("admin/addPost"); ?>"> اضافه کردن پست </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= active_header("admin/addCategory") ?>" href="<?= url_view_builder("admin/addCategory"); ?>"> اضافه کردن دسته بندی </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= active_header("admin/addAds") ?>" href="<?= url_view_builder("admin/addAds"); ?>"> اضافه کردن تبلیغات </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= active_header("admin/addSlider") ?>" href="<?= url_view_builder("admin/addSlider"); ?>"> اضافه کردن اسلاید </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url_view_builder(""); ?>"> مشاهده وبسایت </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- end navbar  -->