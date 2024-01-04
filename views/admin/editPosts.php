<?php
view("admin/inc/header");
?>
<script src="<?= asset('js/ckeditor/ckeditor.js') ?>"></script>

<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5">
            <img src="<?= APPROOT . "/public/img/posts/$data->image" ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"> ویرایش پست </h5>
                <p> پست را ویرایش کنید </p>
                <form method="POST" action='<?= url_view_builder('admin/editPost/' . $data->id) ?>'>

                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label"> عنوان </label>
                        <input name="username" type="text" class="form-control" id="exampleInputUsername" value="<?= $data->title ?>">
                    </div>
                    <div class="mb-3">
                
                        <div class="mb-4">
                            <textarea class="form-control" id="editor1" rows="4" name="body" value="<?= htmlspecialchars_decode(html_entity_decode($data->body)); ?>" ></textarea>
                            <label class="form-label" for="form4Example3">متن پست را بنویسید </label>
                        </div>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"> تصویر پست </label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>

                    <button name="edit" type="submit" class="btn btn-primary"> ویرایش پست </button>
                </form>

            </div>
            <div class="card-footer">
                <small class="text-muted"> <?= $data->published_at ?>:تاریخ انتشار پست </small>
            </div>
        </div>

    </div>
</div>


<?php
view("inc/footer");
?>