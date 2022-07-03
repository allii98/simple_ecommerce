 <!-- All Products -->
 <section class="section all-products" id="products">
     <div class="top container">
         <h1>All Products </h1>

     </div>
     <div class="product-center container">
         <?php foreach ($isi as $d) {
            ?>
         <div class="product-item">
             <div class="overlay">
                 <a href="productDetails.html" class="product-thumb">
                     <img src="<?= $d['image'] ?>" alt="" />
                 </a>
             </div>
             <div class="product-info">
                 <span><?= $d['category'] ?></span>
                 <a href="#"><?= $d['title'] ?></a>
                 <h4>$<?= $d['price'] ?></h4>
             </div>
             <ul class="icons">
                 <li onclick="cekLogin(<?= $d['id'] ?>)"><i class="bx bx-cart"></i></li>
             </ul>
         </div>
         <?php } ?>
     </div>
 </section>