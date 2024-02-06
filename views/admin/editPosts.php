<?php
view("admin/inc/header");
?>
<script src="<?= asset('js/ckeditor/ckeditor.js') ?>"></script>
<div class="conteiner">
    <?php flash('NotAccessEditPost'); ?>
</div>
<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">

        <div class="card mx-auto m-5" style="width: 40rem;">
            <img src="<?=  asset("img/posts/" . $data['postData']->image) ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"> ویرایش پست </h5>
                <p> پست را ویرایش کنید </p>
                <form method="post" action='<?= url_view_builder('admin/editPosts/' . $data['postData']->id) ?>'>

                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label"> عنوان </label>
                        <input name="title" type="text" class="form-control <?= add_class_error($data['errors']['title']); ?>" id="exampleInputUsername" value="<?= $data['postData']->title ?>">
                        <span class="invalid-feedback"><?= view_error($data['errors']['title'] , ' عنوان وارد شده نباید بیشتر از ۵۰ کاراکتر و کمتر از ۳ کاراکتر باشد! '); ?></span>
                    </div>
                    <div class="mb-3">
                
                        <div class="mb-4">
                            <textarea class="form-control  <?= add_class_error($data['errors']['text']); ?>" id="editor1" rows="4" name="body" ><?= htmlspecialchars_decode(html_entity_decode($data['postData']->body)) ?></textarea>
                            <span class="invalid-feedback"><?= view_error($data['errors']['text'] , ' متن وارد شده نباید بیشتر از 3000 کاراکتر و کمتر از ۲۰۰ کاراکتر باشد! '); ?></span>
                            <label class="form-label" for="form4Example3">متن پست را بنویسید </label>
                        </div>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </div>

                    <div class="mb-3 mb-5">
                        <label for="cate" class="form-label"> دسته بندی مورد نظر خود را انتخاب کنید </label>
                        <select class="form-select <?= add_class_error($data['errors']['category']); ?>" aria-label="Default select example" id="cate" name="category">
                            
                                    <option value="<?=  $data['postData']->category_id ?>"> <?= $data['postData']->category_name ?> </option>
                                    <?php
                                     if(isset($data['category'])){
                                        foreach($data['category'] as $key => $category){
                                    ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                    <?php }} ?>
                        </select>
                        <span class="invalid-feedback"><?= view_error($data['errors']['category'] , ' از گزینه های موجود یکی را انتخاب کنید! '); ?></span>
                    </div>

                    <button name="edit" type="submit" class="btn btn-primary"> ویرایش پست </button>
                </form>

            </div>
            <div class="card-footer">
                <small class="text-muted"> <?= $data['postData']->published_at ?>:تاریخ انتشار پست </small>
            </div>
        </div>

    </div>
</div>


<?php
view("inc/footer");
?>