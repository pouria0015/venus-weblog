<?php 
    view("admin/inc/header");
?>

    </header>

    <section class="m-5">
        <div class="container">

            <h2>نمایش کاربران</h2>
            <table class="table  table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام کاربری</th>
                        <th scope="col"> ایمیل </th>
                        <th scope="col"> حذف </th>
                        <th scope="col"> ویرایش </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if(isset($data['users'])){
                        $count = 0;
                        foreach($data['users'] as $user){
                            $count++;
                    ?>
                    <tr>
                        <th scope="row"><?= $count ?></th>
                        <td><?= $user->first_name ?></td>
                        <td><?= $user->user_name ?></td>
                        <td><?= $user->email ?></td>
                        
                        <td>
                            <button type="button" class="btn btn-danger"> حذف </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning"> تایید </button>
                        </td>
                        </td>
                    </tr>

                    <?php }} ?>


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
                        <th scope="col"> تایید </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                   
                <?php
                    if(isset($data['comments'])){
                        $count = 0;
                        foreach($data['comments'] as $comment){
                            $count++;
                    ?>
                    <tr>
                        <th scope="row"><?= $count ?></th>
                        <td><?= $comment->user_name ?></td>
                        <td><?= $comment->post_title ?></td>
                        <td><?= substr($comment->body , 0 , 100) ?></td>
                        
                        <td>
                            <button type="button" class="btn btn-danger"> حذف </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning"> تایید </button>
                        </td>
                        </td>
                    </tr>

                    <?php }} ?>

                </tbody>
            </table>

        </div>
    </section>

    <section class="m-5">
        <div class="container">

            <h2>نمایش پست ها</h2>
            <a href="./addPosts.html" class="btn btn-primary m-1"> اضافه کردن پست </a>
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
                    if(isset($data['posts'])){
                        $count = 0;
                        foreach($data['posts'] as $post){
                            $count++;
                    ?>
                    <tr>
                        <th scope="row"><?= $count ?></th>
                        <td><img src="<?= asset("img/$post->image") ?>" style="max-width: 50px;" alt=""></td>
                        <td> <?= $post->title ?> </td>
                        <td> <?= substr($post->body , 0 , 100) ?> </td>
                        <td> <?= $post->writer ?> </td>
                        <td> <?= $post->published_at ?> </td>
                            <td>
                                <button type="button" class="btn btn-warning">ویرایش</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger">حذف</button>
                            </td>
                        </tr>

                        <?php }} ?>
                </tbody>
            </table>

        </div>
    </section>


<?php
    view("inc/footer");
?>