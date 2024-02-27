<!-- start footer --> 

<footer class="bg-light text-lg-start">

    <hr class="m-0" />
    

        <div class="footer">
            <p>تمامی حقوق این وبسایت متعلق به تیم ونوس است</p>
        </div>
    </footer>
    <!-- end footer --> 
    
    <!-- add javascript bundle for bootstrap --> 
    <script src="<?= asset("js/bootstrap.bundle.min.js"); ?>"></script>
    <script>
document.querySelector(".search input").addEventListener("keyup", function() {
  let input = document.querySelector(".search input");
  const filter = input.value.toLowerCase();

  const posts = document.querySelectorAll(".main_content");
  for(post of posts) {
    
    let title = post.querySelector('.card-title');

    let found = title.innerText.toLowerCase().search(filter);
    console.log(post);
    post.style.display = (found === -1) ? "block" : "none";
  }
});
    </script>
   
 </body>
    
    </html>
