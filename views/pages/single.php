<?php 
    view("inc/header");
    
    flash('notAddComment');
    flash('ErrorAddComment');
    
?>

<script src="<?= asset('js/ckeditor/ckeditor.js') ?>"></script> 

<!--Main Navigation-->
<header>
    <!-- Intro settings -->
    <style>
        #intro {
            /* Margin to fix overlapping fixed navbar */
            margin-top: 58px;
        }

        @media (max-width: 991px) {
            #intro {
                /* Margin to fix overlapping fixed navbar */
                margin-top: 45px;
            }
        }
    </style>


    <!-- Jumbotron -->
    <div id="intro" class="p-5 text-center bg-light">
        <h1 class="mb-0 h4"><?= $data['posts']->title ?></h1>
    </div>
    <!-- Jumbotron -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="mt-4 mb-5">
    <div class="container">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-8 mb-4">
                <!--Section: Post data-mdb-->
                <section class="border-bottom mb-4">
                    <img src="<?= asset("img/posts/" . $data['posts']->image) ?>" class="img-fluid shadow-2-strong rounded-5 mb-4" alt="" width="100%" />

                    <div class="row align-items-center mb-4">
                        <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                            <img src="" class="rounded-5 shadow-1-strong me-2" height="35" alt="" loading="lazy" />
                            <span> درتاریخ <u><?= $data['posts']->published_at ?></u> توسط</span>
                            <a href="" class="text-dark"><?= $data['posts']->writer ?></a>
                        </div>

                    </div>
                </section>
                <!--Section: Post data-mdb-->

                <!--Section: Text-->
                <section>
                    <p>
                        <?= htmlspecialchars_decode(html_entity_decode($data['posts']->body)) ?>  
                    </p>
                </section>
                <!--Section: Text-->

                <!--Section: Share buttons-->
                <section class="text-center border-top border-bottom py-4 mb-4">
                    <p><strong>ایا این مقاله برای شما مفید بود؟</strong></p>

                    <button type="button" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd" d="M12.596 21.957c-1.301.092-2.303-.986-2.303-2.206v-1.053c0-2.666-1.813-3.785-2.774-4.2a1.864 1.864 0 00-.523-.13A1.75 1.75 0 015.25 16h-1.5A1.75 1.75 0 012 14.25V3.75C2 2.784 2.784 2 3.75 2h1.5a1.75 1.75 0 011.742 1.58c.838-.06 1.667-.296 2.69-.586l.602-.17C11.748 2.419 13.497 2 15.828 2c2.188 0 3.693.204 4.583 1.372.422.554.65 1.255.816 2.05.148.708.262 1.57.396 2.58l.051.39c.319 2.386.328 4.18-.223 5.394-.293.644-.743 1.125-1.355 1.431-.59.296-1.284.404-2.036.404h-2.05l.056.429c.025.18.05.372.076.572.06.483.117 1.006.117 1.438 0 1.245-.222 2.253-.92 2.942-.684.674-1.668.879-2.743.955zM7 5.082c1.059-.064 2.079-.355 3.118-.651.188-.054.377-.108.568-.16 1.406-.392 3.006-.771 5.142-.771 2.277 0 3.004.274 3.39.781.216.283.388.718.54 1.448.136.65.242 1.45.379 2.477l.05.385c.32 2.398.253 3.794-.102 4.574-.16.352-.375.569-.66.711-.305.153-.74.245-1.365.245h-2.37c-.681 0-1.293.57-1.211 1.328.026.244.065.537.105.834l.07.527c.06.482.105.922.105 1.25 0 1.125-.213 1.617-.473 1.873-.275.27-.774.456-1.795.528-.351.024-.698-.274-.698-.71v-1.053c0-3.55-2.488-5.063-3.68-5.577A3.485 3.485 0 007 12.861V5.08zM3.75 3.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h1.5a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25h-1.5z"></path>
                        </svg>
                    </button>
                    <button type="button" class="btn btn-primary me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd" d="M12.596 2.043c-1.301-.092-2.303.986-2.303 2.206v1.053c0 2.666-1.813 3.785-2.774 4.2a1.866 1.866 0 01-.523.131A1.75 1.75 0 005.25 8h-1.5A1.75 1.75 0 002 9.75v10.5c0 .967.784 1.75 1.75 1.75h1.5a1.75 1.75 0 001.742-1.58c.838.06 1.667.296 2.69.586l.602.17c1.464.406 3.213.824 5.544.824 2.188 0 3.693-.204 4.583-1.372.422-.554.65-1.255.816-2.05.148-.708.262-1.57.396-2.58l.051-.39c.319-2.386.328-4.18-.223-5.394-.293-.644-.743-1.125-1.355-1.431-.59-.296-1.284-.404-2.036-.404h-2.05l.056-.429c.025-.18.05-.372.076-.572.06-.483.117-1.006.117-1.438 0-1.245-.222-2.253-.92-2.941-.684-.675-1.668-.88-2.743-.956zM7 18.918c1.059.064 2.079.355 3.118.652l.568.16c1.406.39 3.006.77 5.142.77 2.277 0 3.004-.274 3.39-.781.216-.283.388-.718.54-1.448.136-.65.242-1.45.379-2.477l.05-.384c.32-2.4.253-3.795-.102-4.575-.16-.352-.375-.568-.66-.711-.305-.153-.74-.245-1.365-.245h-2.37c-.681 0-1.293-.57-1.211-1.328.026-.243.065-.537.105-.834l.07-.527c.06-.482.105-.921.105-1.25 0-1.125-.213-1.617-.473-1.873-.275-.27-.774-.455-1.795-.528-.351-.024-.698.274-.698.71v1.053c0 3.55-2.488 5.063-3.68 5.577-.372.16-.754.232-1.113.26v7.78zM3.75 20.5a.25.25 0 01-.25-.25V9.75a.25.25 0 01.25-.25h1.5a.25.25 0 01.25.25v10.5a.25.25 0 01-.25.25h-1.5z"></path>
                        </svg>
                    </button>
                </section>
                <!--Section: Share buttons-->

                <!--Section: Author-->
                <section class="border-bottom mb-4 pb-4">
                    <div class="row">
                        <div class="col-3">
                            <img src="./img/user.png" class="img-fluid shadow-1-strong rounded-5" alt="" />
                        </div>

                    </div>
                </section>
                <!--Section: Author-->

                <!--Section: Comments-->
                <section class="border-bottom mb-3">
                    <p class="text-center"><strong>نظرات‌‌ : <?= isset($data['comments']) && $data['comments'] !== false ? count($data['comments']) : '' ?></strong></p>

                    <!-- start Comment -->
                    <?php

                    if(isset($data['comments']) && $data['comments'] !== false){
                        if(count($data['comments'])){
                     foreach($data['comments'] as $comment){

                        ?>
                    <div class="row mb-4">

                        <div class="col-10">
                            <p class="mb-2"><strong><?= $comment->first_name ?></strong></p>
                            <p>
                                <?= htmlspecialchars_decode(html_entity_decode($comment->body)) ?>
                            </p>
                        </div>
                    </div>

<?php
 }
}
}
 ?>
                    <!-- end Comment -->

                </section>
                <!--Section: Comments-->

                <!--Section: Reply-->
                <section>
                  
                    <p class="text-center"><strong>افزودن نظر</strong></p>

                    <form action="<?= url_view_builder('pages/addComment/' . $data['posts']->id) ?>" method="post">

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="editor" rows="4" name="body" required></textarea>
                            <label class="form-label" for="form4Example3">*متن نظر</label>
                        </div>
                        <script>
                             CKEDITOR.replace( 'editor' );
                        </script>
        

                        <!-- Submit button -->
                        <input type="submit" class="btn btn-primary btn-block mb-4" value="ارسال نظر">
                            
                    </form>
                </section>
                <!--Section: Reply-->
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-4">
                <!--Section: Sidebar-->
                <section class="sticky-top" style="top: 80px;">
                    <!--Section: Ad-->
                    <section class="text-center border-bottom pb-4 mb-4">
                        <div class="bg-image hover-overlay ripple mb-4">
                            <img src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/content/en/_mdb5/standard/about/assets/mdb5-about.webp" class="img-fluid" />
                        </div>
                        <h5>تبلیغات وبسایت ما</h5>

                        <p>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.

                        </p>
                    </section>
                    <!--Section: Ad-->


                    <section class="text-center">
                        <div class="bg-image hover-overlay ripple mb-4">
                            <img src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/content/en/_mdb5/standard/about/assets/mdb5-about.webp" class="img-fluid" />
                        </div>
                        <h5 class="mb-4">تبلیغات وبسایت ما</h5>
                        <p>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.

                        </p>
                    </section>

                </section>
                <!--Section: Sidebar-->
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
</main>
<!--Main layout-->


<?php 
    view("inc/footer");
?>