<?php
view("admin/inc/header");
flash('ErrorAddPost');
?>
<script src="<?= asset('js/ckeditor/ckeditor.js') ?>"></script>

<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5" style="width: 40rem;">
            <div class="card-body">
                <h5 class="card-title"> اضافه کردن پست </h5>
                <form method="POST" action="<?= url_view_builder('admin/addPost') ?>" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label"> عنوان </label>
                        <input name="title" type="text" class="form-control <?= add_class_error($data , 'title'); ?>" id="title" value="<?= isset($data['requests']['title']) ? $data['requests']['title'] : '' ?>" required>
                        <span class="invalid-feedback"><?= view_error($data, 'title' , ' عنوان وارد شده نباید بیشتر از ۵۰ کاراکتر و کمتر از ۳ کاراکتر باشد! '); ?></span>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="textPost" class="form-label"> متن پست را بنویسید </label>
                            <textarea class="form-control <?= add_class_error($data , 'text'); ?>" id="textPost" rows="4" name="text" value="<?= isset($data['requests']['text']) ? $data['requests']['text'] : '' ?>" required></textarea>
                            <span class="invalid-feedback"><?= view_error($data , 'text' , ' متن وارد شده نباید بیشتر از 3000 کاراکتر و کمتر از ۲۰۰ کاراکتر باشد! '); ?></span>
                        </div>
                        <script>
                            CKEDITOR.replace('textPost');
                        </script>
                    </div>

                    <div class="mb-3 mb-5">
                        <label for="cate" class="form-label"> دسته بندی مورد نظر خود را انتخاب کنید </label>
                        <select class="form-select <?= add_class_error($data, 'category'); ?>" aria-label="Default select example" id="cate" name="category">
                        <span class="invalid-feedback"><?= view_error($data , 'category' , ' از گزینه های موجود یکی را انتخاب کنید! '); ?></span>
                            <?php

                            if (isset($data['category'])) {
                                foreach ($data['category'] as $key => $category) {
                            ?>
                                    <option value="<?= $category->id ?>"> <?= $category->name ?> </option>
                            <?php }
                            } ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"> تصویر پست </label>
                        <input class="form-control <?= add_class_error($data , 'image'); ?>" type="file" name="image" id="formFileMultiple" multiple>
                        <span class="invalid-feedback"><?= view_error($data , 'image' , ' نام تصویر باید بین 5 تا 25 کاراکتر باشد و اندازه هم کمتر از 100 کیلوبایت و بیشتر از 0.5 کیلوبایت باشد! '); ?></span>                           
                    </div>

                    <button name="send" type="submit" class="btn btn-primary"> اضافه کردن پست </button>
                </form>
            </div>
        </div>

    </div>
</div>


<?php
view("inc/footer");
?>