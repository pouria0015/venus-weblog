<?php 
    view("admin/inc/header");
?>

        <div class="d-flex justify-content-center">
            <div class="row row-cols-1 row-cols-md-1 g-1">

                <div class="card mx-auto m-5">
                    <img src="https://fakeimg.pl/250x200/?text=slide1&font=lobster" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> ویرایش پست </h5>
                        <p> پست را ویرایش کنید </p>
                        <form method="POST">

                            <div class="mb-3">
                                <label for="exampleInputUsername" class="form-label"> عنوان </label>
                                <input name="username" type="text" class="form-control" id="exampleInputUsername"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label"> متن پست را بنویسید </label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                            </div> 

                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label"> تصویر پست </label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                              </div>
                            
                            <button name="login" type="submit" class="btn btn-primary"> ویرایش پست </button>
                        </form>
                        <button type="button" class="btn btn-danger m-1"> حذف پست </button>

                    </div>
                    <div class="card-footer">
                        <small class="text-muted"> تاریخ ایجاد پست  </small>
                    </div>
                </div>

            </div>
        </div>


<?php 
    view("inc/footer");
?>