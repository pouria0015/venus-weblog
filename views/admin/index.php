<?php
view("admin/inc/header");
?>
</header>

<section class="m-5">
    <div class="container">
        <?php
        flash('activeUser');
        flash('deleteUser');
        flash('deleteComment');
        flash('verifyComment');
        flash('deletePost');
        flash('accessAddCategory');
        ?>

        <h2>نمایش کاربران</h2>
        <table class="table  table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">نام کاربری</th>
                    <th scope="col"> ایمیل </th>
                    <th scope="col"> حذف </th>
                    <th scope="col"> تاییدیه حساب </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if (isset($data['users'])) {
                    $count = 0;
                    foreach ($data['users'] as $user) {
                        $count++;
                ?>
                        <tr>
                            <th scope="row"><?= $count ?></th>
                            <td><?= $user->first_name ?></td>
                            <td><?= $user->user_name ?></td>
                            <td><?= $user->email ?></td>

                            <?php
                            if ($user->deleted_at === NULL) {
                            ?>
                                <td>
                                    <a type="button" class="btn btn-danger" href="<?= url_view_builder("admin/deleteUser/$user->id") ?>"> حذف </a>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td>
                                    <a type="button" class="btn btn-danger disabled" href=""> حذف شده </a>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                                <?php
                                if ($user->is_active == 0) {
                                    if($user->deleted_at == NULL){
                                ?>
                                    <a type="button" class="btn btn-warning" href="<?= url_view_builder("admin/activeUser/$user->id"); ?>"> تایید </a>
                                <?php
                                }else{
                                    ?>
                                    <a type="button" class="btn btn-warning disabled" href="" > تایید </a>
                                     <?php
                                }
                                } else {
                                ?>
                                    <span class="btn btn-warning verify-user" style="cursor:default;"> تایید شده </span>
                                <?php
                                }
                                ?>
                            </td>
                            </td>
                        </tr>

                <?php }
                } ?>


            </tbody>
        </table>

    </div>
</section>

<section class="m-5">
    <div class="container">

        <h2>نمایش نظرات</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام کاربری</th>
                    <th scope="col"> نام پست </th>
                    <th scope="col"> پیام </th>
                    <th scope="col"> حذف </th>
                    <th scope="col"> تاییدیه نظر </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php
                if (isset($data['comments'])) {
                    $count = 0;
                    foreach ($data['comments'] as $comment) {
                        $count++;
                ?>
                        <tr>
                            <th scope="row"><?= $count ?></th>
                            <td><?= $comment->user_name ?></td>
                            <td><?= $comment->post_title ?></td>
                            <td><?= substr($comment->body, 0, 100) ?></td>

                            <td>
                                <a type="button" class="btn btn-danger" href="<?= url_view_builder("admin/deleteComment/$comment->id") ?>"> حذف </a>
                            </td>

                            <td>
                                <?php
                                if ($comment->verify_comment == 0) {
                                ?>
                                    <a type="button" class="btn btn-warning" href="<?= url_view_builder("admin/verifyComment/$comment->id"); ?>"> تایید </a>
                                <?php
                                } else {
                                ?>
                                    <span class="btn btn-warning" style="cursor:default;"> تایید شده </span>
                                <?php
                                }
                                ?>
                            </td>
                            </td>
                        </tr>

                <?php }
                } ?>

            </tbody>
        </table>

    </div>
</section>

<section class="m-5">
    <div class="container">

        <h2>نمایش پست ها</h2>
        <a href="<?= url_view_builder('admin/addPost') ?>" class="btn btn-primary m-1"> اضافه کردن پست </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> تصویر </th>
                    <th scope="col"> عنوان </th>
                    <th scope="col"> متن </th>
                    <th scope="col"> نویسنده </th>
                    <th scope="col"> زمان انتشار </th>
                    <th scope="col"> ویرایش </th>
                    <th scope="col"> حذف </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if (isset($data['posts'])) {
                    $count = 0;
                    foreach ($data['posts'] as $post) {
                        $count++;
                ?>
                        <tr>
                            <th scope="row"><?= $count ?></th>
                            <td><img src="<?= asset("img/$post->image") ?>" style="max-width: 50px;" alt=""></td>
                            <td> <?= $post->title ?> </td>
                            <td> <?= htmlspecialchars_decode(html_entity_decode(substr($post->body, 0, 50))) ?> </td>
                            <td> <?= $post->writer ?> </td>
                            <td> <?= $post->published_at ?> </td>
                            <td>
                                <a type="button" class="btn btn-warning" href="<?= url_view_builder('admin/editPosts/' . $post->id) ?>">ویرایش</a>
                            </td>
                            <td>
                                <a type="button" class="btn btn-danger" href="<?= url_view_builder('admin/deletePost/' . $post->id) ?>">حذف</a>
                            </td>
                        </tr>

                <?php }
                } ?>
            </tbody>
        </table>

    </div>
</section>


<?php
view("inc/footer");
?>