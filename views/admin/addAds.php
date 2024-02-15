<?php
view('admin/inc/header');


?>
<section class="m-5">
    <div class="container">
        <?php
            flash('ErrorAddAds');
        ?>
    </div>
</section>
<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5">
            <div class="card-body">

<form class="form-inline" action="<?= url_view_builder('admin/addAds'); ?>" method="POST" enctype="multipart/form-data">

<div class="form-group mx-sm-3 mb-2">
    <label for="nameAds" class="sr-only">نام تبلیغ را وارد کنید</label>
    <input type="text" name="name" class="form-control <?= add_class_error($data , 'name'); ?>" id="nameAds" placeholder=" نام تبلیغ " value="<?= isset($data['requests']['name']) ? $data['requests']['name'] : '' ?>" required>
    <span class="invalid-feedback"><?= view_error($data , 'name', ' نام وارد شده نباید بیشتر از ۵۰ کاراکتر و کمتر از 3 کاراکتر باشد! '); ?></span>
</div>

<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">متن تبلیغ را وارد کنید</label>
    <input type="text" name="text" class="form-control <?= add_class_error($data , 'text'); ?>" placeholder=" متن تبلیغ " value="<?= isset($data['requests']['text']) ? $data['requests']['text'] : '' ?>" maxlength="100" minlength="10"  required>
    <span class="invalid-feedback"><?= view_error($data , 'text' , ' متن وارد شده نباید بیشتر از 100 کاراکتر و کمتر از 10 کاراکتر باشد! '); ?></span>
</div>

<div class="form-group mx-sm-3 mb-2">
    <label for="formFileMultiple" class="form-label"> تصویر تبلیغ </label>
    <input class="form-control <?= add_class_error($data, 'image'); ?>" type="file" name="image" id="formFileMultiple" multiple required>
    <span class="invalid-feedback"><?= view_error($data, 'image' , ' نام تصویر باید بین 5 تا 25 کاراکتر باشد و اندازه هم کمتر از 1 مگابایت و بیشتر از 0.5 کیلوبایت باشد! '); ?></span>                           
</div>


  <button type="submit" class="btn btn-primary mb-2">ثبت تبلیغ</button>
</form>

</div>
</div>
</div>
</div>