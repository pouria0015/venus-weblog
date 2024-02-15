<?php 
    view("inc/header");

?>

<section class="m-5">
    <div class="container">
<?php
    flash('notAddComment');
    flash('ErrorAddComment');
    flash('InsertComment');
    flash('AddComment');
    
?>
    </div>
</section>
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
                    <img src="<?= asset("img/posts/" . $data['posts']->image) ?>" class="img-fluid shadow-2-strong rounded-5 mb-4" alt="" width="100%" loading="lazy" />

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

                    <?php foreach($data['ads'] as $ad) { ?> 
                    <section class="text-center border-bottom pb-4 mb-4">
                        <div class="bg-image hover-overlay ripple mb-4">
                            <img src="<?= asset("img/Ads/" . $ad->image) ?>" class="img-fluid" loading="lazy" />
                        </div>
                        <h5> <?= $ad->name ?> </h5>

                        <p>
                            <?= $ad->text ?>
                        </p>
                    </section>
                        <?php } ?>

                    <!--Section: Ad-->
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