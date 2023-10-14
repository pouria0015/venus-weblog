<?php
view("inc/header");
?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">

            <div class="row m-5">
                <div class="col-md-10  card p-4">
                <?php flash('ErrorRegisterInUser'); ?>
                    <form method="POST" class="row" id="register-form" action="<?= url_view_builder('users/register') ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">*نام</label>
                            <input name="first_name" type="text" class="form-control <?= add_class_error($data['errors']['first_name']); ?>" id="first_name" value="<?= (isset($data['requests']['first_name']) ? $data['requests']['first_name'] : '') ?>" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['first_name'] , "نام باید بیشتر از ۳ کاراکتر و کمتر از ۲۵ کاراکتر باشد") ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="user_name" class="form-label">* نام کاربری</label>
                            <input name="user_name" type="text" class="form-control <?= add_class_error($data['errors']['user_name']) ?>" id="user_name" value="<?= (isset($data['requests']['user_name']) ? $data['requests']['user_name'] : '') ?>" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['user_name'] , " نام کاربری باید بیشتر از ۳ کاراکتر و کمتر از ۲۵ کاراکتر باشد ") ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">*رمز عبور</label>
                            <input name="password" type="password" class="form-control <?= add_class_error($data['errors']['password']) ?>" id="password" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['password'] , " رمز عبور باید بیشتر از 8 کاراکتر و کمتر از 30 کاراکتر باشد ") ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">*رمز عبور را مجددا وارد کنید</label>
                            <input name="password_confirm" type="password" class="form-control" id="password_confirm" value="" required>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">*آدرس ایمیل</label>
                            <input name="email" type="email" class="form-control <?= add_class_error($data['errors']['email']) ?>" id="email" value="<?= (isset($data['requests']['email'])) ? $data['requests']['email'] : '' ?>" required>
                            <span class="invalid-feedback"><?= view_error($data['errors']['email'] , " ایمیل باید بیشتر از 5 کاراکتر و کمتر از 50 کاراکتر باشد  ") ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">پروفایل خود را انتخاب کنیم..</label>
                            <input name="profile" class="form-control <?= add_class_error($data['errors']['size']) ?> <?= add_class_error($data['errors']['name']) ?>" type="file" id="formFile">
                            <span class="invalid-feedback"><?= isset($data['errors']['name']) ? view_error($data['errors']['name'], " پسوند پروفایل باید png باشد ") : "" ?></span>
                            <span class="invalid-feedback"><?= isset($data['errors']['size']) ? view_error($data['errors']['size'] , " حجم فایل باید کمتر از ۹ کیلوبایت و بیشتر از نیم کیلوبایت باشد ") : "" ?></span>
                        </div>

                            <button class="btn btn-primary" type="submit">ثبت نام</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
view("inc/footer");

?>