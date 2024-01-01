<?php
view("inc/header");
?>

<!-- start slider  -->

<div id="carouselExampleIndicators" class="carousel slide d-none d-md-flex" data-bs-ride="true">
    <div class="carousel-indicators">
<?php

    for ($i=0; $i < count($data['sliders']); $i++) { 
       
            ?>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="<?= ($data['sliders'][$i]->active == 1) ? add_class('active') : ''; ?>" aria-current="true"></button>
            <?php
   
    }
?>
    </div>
    <div class="carousel-inner">
        <?php
        if (count($data['sliders']) > 0) {
            foreach ($data['sliders'] as $slider) {

        ?>
                <div class="carousel-item <?= ($slider->active == 1) ? add_class('active') : ''; ?>">
                    <img src="<?= asset("img/sliders/" . $slider->images) ?>" class="w-100">
                </div>

        <?php

            }
        }
        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- end slider  -->
</header>

<section class="mb-5">
    <!-- start post`s -->
    <h4 class="p-5">-مقالات وبلاگ ونوس</h4>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $count = 0;
            if(isset($data['posts'])){
            foreach ($data['posts'] as $post) {
                $count++;
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= asset("img/posts/" . $post->image) ?>" width="350" height="250" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" id="title-post-<?= $count ?>"><?= $post->title ?></h5>
                            <p class="card-text"> <?= substr(htmlspecialchars_decode($post->body , ENT_QUOTES), 0, 255) . "...." ?> </p>
                            <a href="<?= url('pages/single/' . $post->id) ?>">ادامه مطلب</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">نویسنده:<?= $post->writer ?></small>
                        </div>
                    </div>
                </div>
            <?php }} ?>
        </div>
    </div>
    <!-- end post`s -->

</section>

<?php
view("inc/footer");
?>