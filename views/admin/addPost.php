<?php
view("admin/inc/header");

?>
<script src="<?= asset('js/ckeditor/ckeditor.js') ?>"></script>

<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5">
            <div class="card-body">
                <h5 class="card-title"> اضافه کردن پست </h5>
                <form method="POST" action="<?= url_view_builder('admin/addPost') ?>" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label"> عنوان </label>
                        <input name="title" type="text" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="textPost" class="form-label"> متن پست را بنویسید </label>
                            <textarea class="form-control" id="textPost" rows="4" name="text" required></textarea>

                        </div>
                        <script>
                            CKEDITOR.replace('textPost');
                        </script>
                    </div>

                    <div class="mb-3 mb-5">
                        <label for="cate" class="form-label"> دسته بندی مورد نظر خود را انتخاب کنید </label>
                        <select class="form-select" aria-label="Default select example" id="cate" name="category">
                            <?php

                            if (isset($data['category'])) {
                                foreach ($data['category'] as $key => $category) {
                            ?>
                                    <option value="<?= $category->name ?>"> <?= $category->name ?> </option>
                            <?php }
                            } ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"> تصویر پست </label>
                        <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
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