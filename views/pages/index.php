<?php

if(isset($_GET['page']) != true || !is_int((int)$_GET['page'])){
    redirect('pages/index' , ['page' => 1]);
}

view("inc/header");

echo('<div class="container">');
flash('deleteUser');
flash('invalidTokenVerifyAccount');
flash('VerifyTokenAccount');
flash('NotVerifyTokenAccount');
echo('</div>');  

?>

<!-- start slider  -->

<div id="carouselExampleIndicators" class="carousel slide d-none d-md-flex" data-bs-ride="true">
    <div class="carousel-indicators">
<?php

    for ($i=0; $i < count($data['sliders']); $i++) { 
       
            ?>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="<?= ($data['sliders'][$i]->activeSlider == 1) ? add_class('active') : ''; ?>" aria-current="true"></button>
            <?php
   
    }
?>
    </div>
    <div class="carousel-inner">
        <?php

        if (count($data['sliders']) > 0) {
            foreach ($data['sliders'] as $slider) {
                if($slider->activeSlider == 1) {
        ?>
                <div class="carousel-item active">
                    <img src="<?= asset("img/sliders/" . $slider->nameImage) ?>" class="w-100">
                </div>

        <?php
            }
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
        <div class="row row-cols-1 row-cols-md-3 g-4 main_content">
            <?php
            $count = 0;
            if(isset($data['posts'][0])){
            foreach ($data['posts'][0] as $post) {
                $count++;
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= asset("img/posts/" . $post->image) ?>" width="350" height="250" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" id="title-post-<?= $count ?>"><?= $post->title ?></h5>
                            <p class="card-text"> <?= str_replace('&nbsp;', '', substr(stripslashes(htmlspecialchars_decode(html_entity_decode($post->body , ENT_QUOTES))), 0, 255)) . "...." ?> </p>
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

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= ((int)$_GET['page'] == 1) ? add_class('disabled') : '' ?>">
      <a class="page-link" href="<?= url_view_builder('pages/index?page=' . (int)$_GET['page'] - 1) ?>">صفحه قبل</a>
    </li>
    <?php
        for($i = 1 ; $i <= (int)$data['posts'][1] ; $i++){
    ?>
    <li class="page-item"><a class="page-link" href="<?= url_view_builder('pages/index?page=' . $i); ?>"><?= $i ?></a></li>
    <?php
        }
    ?>
    <li class="page-item <?= ((int)$_GET['page'] == (int)$data['posts'][1]) ? add_class('disabled') : '' ?>">
      <a class="page-link" href="<?= url_view_builder('pages/index?page=' . (int)$_GET['page'] + 1) ?>">صفحه بعد</a>
    </li>
  </ul>
</nav>

<?php
view("inc/footer");
?>