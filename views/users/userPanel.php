<?php
view("inc/header");

?>

<div class="d-flex justify-content-center">
    <div class="row row-cols-1 row-cols-md-1 g-1">
<?php
 flash('update_data');
 flash('deleteUser');

?>
        <div class="card mx-auto m-5">
            <!-- <img src="https://fakeimg.pl/250x200/?text=slide1&font=lobster" class="card-img-top" alt="..." width="250px" height="200px"> -->
            <div class="card-body">
                <h5 class="card-title"> اطلاعات کاربری </h5>
                <p> اطلاعات خود را ویرایش کنید یا مشاهده کنید </p>
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">آدرس ایمیل</label>
                        <input name="email" type="email" id="email" class="form-control <?= add_class_error($data['errors']['email']); ?>" value="<?= (isset($data['userData']['email'])) ? $data['userData']['email'] : '' ?>" required>
                        <span class="invalid-feedback"><?= view_error($data['errors']['email'], "ایمیل خود را به صورت کاملا صحیح وارد کنید و ایمیل باید بین 5 تا 50 ککاراکتر باشد") ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="user_name" class="form-label"> نام کاربری </label>
                        <input name="user_name" type="text" id="user_name" class="form-control <?= add_class_error($data['errors']['user_name']); ?>" value="<?= (isset($data['userData']['user_name'])) ? $data['userData']['user_name'] : '' ?>" required>
                        <span class="invalid-feedback"><?= view_error($data['errors']['user_name'], " نام کاربری باید بین 4 تا 50 کاراکتر باشد ") ?></span>
                    </div>

                    <div class="mb-4">
                        <label for="first_name" class="form-label"> نام </label>
                        <input name="first_name" type="text" id="first_name" class="form-control <?= add_class_error($data['errors']['first_name']); ?>" value="<?= (isset($data['userData']['first_name'])) ? $data['userData']['first_name'] : '' ?>" required>
                        <span class="invalid-feedback"><?= view_error($data['errors']['first_name'], " نام خود را به درستی وارد کنید نام باید  بین 3 تا15 کاراکتر باشد ") ?></span>
                    </div>

                    <button name="login" type="submit" class="btn btn-primary"> ویرایش اطلاعات </button>
                    <a class="btn btn-danger m-1" href="<?= url_view_builder((isset($data['userData']['id'])) ? "users/deleteUser/" . $data['userData']['id'] : '') ?>"> حذف حساب کاربری </a>

                </form>

            </div>
            <div class="card-footer">
                <small class="text-muted"> تاریخ ایجاد حساب کاربری : <?= (isset($data['userData']['created_at'])) ? $data['userData']['created_at'] : '' ?></small>
            </div>
        </div>

    </div>
</div>

<?php
view("inc/footer");
?>