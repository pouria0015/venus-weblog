<?php
view("inc/header");
?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="row m-5">
             
                <div class="col-md-10 card p-4">
                <?php flash('ErrorLoggedInUser'); ?>
                    <form method="POST" id="login-form" class="row" action="<?= url_view_builder("users/login"); ?>">
                        <div class="mb-4">
                            <label for="email" class="form-label">*آدرس ایمیل</label>
                            <input name="email" type="text" id="email" class="form-control <?= add_class_error($data['errors']['email']); ?>" value="<?= (isset($data['requests']['email'])) ? $data['requests']['email'] : '' ?>" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['password'] , "ایمیل خود را به صورت کاملا صحیح وارد کنید") ?></span>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">*رمز عبور</label>
                            <input name="password" type="password" id="password" class="form-control  <?= add_class_error($data['errors']['password']); ?>" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['password'] , "رمز عبور باید بین 6 تا 25 کاراکتر باشد و وارد کردن آن اجباریست") ?></span>
                        </div>
                        <div class="mb-4 form-check">
                            <input name="remember" type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">مرا بخاطر بسپار</label>
                            <span class="invalid-feedback"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">ورود</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
view("inc/footer");
?>