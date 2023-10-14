<?php 
    view("inc/header");
?>
        
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
        <h1 class="mb-0 h4">درباره ما</h1>
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
                <!--Section: Text-->
                <section>
                    <p>
                        <?= $data->about_us ?>    
                    </p>
                </section>
                <!--Section: Text-->

                
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