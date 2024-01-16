<?php
view('admin/inc/header');
?>
<section class="m-5">
    <div class="container">
        <?php
            flash('NotaccessAddCategory');
        ?>
    </div>
</section>
<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5">
            <div class="card-body">

<form class="form-inline" action="<?= url_view_builder('admin/addCategory'); ?>" method="POST">

  <div class="form-group mx-sm-3 mb-2">
    <label for="cat" class="sr-only">نام دسته بندی را انتخاب کنید</label>
    <input type="text" name="category" class="form-control <?= add_class_error($data['errors']['category']); ?>" id="cat" placeholder="دسته بندی" required>
    <span class="invalid-feedback"><?= view_error($data['errors']['category'] , ' نام وارد شده نباید بیشتر از ۵۰ کاراکتر و کمتر از ۲ کاراکتر باشد! '); ?></span>
</div>
  <button type="submit" class="btn btn-primary mb-2">ثبت دسته بندی</button>
</form>

</div>
</div>
</div>
</div>