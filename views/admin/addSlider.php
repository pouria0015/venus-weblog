<?php
view('admin/inc/header');


?>
<section class="m-5">
    <div class="container">
        <?php
            flash('NotAddSlider');
        ?>
    </div>
</section>
<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5">
            <div class="card-body">

<form class="form-inline" action="<?= url_view_builder('admin/addSlider'); ?>" method="POST" enctype="multipart/form-data">


<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">نام اسلاید را وارد کنید</label>
    <input type="text" name="name" class="form-control <?= add_class_error($data , 'name'); ?>" placeholder="نام اسلاید را وارد کنید" value="<?= isset($data['requests']['text']) ? $data['requests']['text'] : '' ?>"  required>
    <span class="invalid-feedback"><?= view_error($data , 'name' , ' نام وارد شده نباید بیشتر از 250 کاراکتر و کمتر از 3 کاراکتر باشد! '); ?></span>
</div>

<div class="form-group mx-sm-3 mb-2">
    <label for="formFileMultiple" class="form-label"> تصویر اسلاید </label>
    <input class="form-control <?= add_class_error($data, 'image'); ?>" type="file" name="image" id="formFileMultiple" multiple required>
    <span class="invalid-feedback"><?= view_error($data, 'image' , ' نام تصویر باید بین 5 تا 25 کاراکتر باشد و اندازه هم کمتر از 5 مگابایت و بیشتر از 0.5 کیلوبایت باشد! '); ?></span>                           
</div>


  <button type="submit" class="btn btn-primary mb-2"> ثبت اسلاید </button>
</form>

</div>
</div>
</div>
</div>