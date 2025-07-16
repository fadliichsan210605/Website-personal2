<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Fadli Phone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .product-card {
      cursor: pointer;
    }
  </style>
</head>
<body>

<section id="billboard" class="bg-light py-5">
  <div class="container">
    <div class="row justify-content-center">
      <h1 class="section-title text-center mt-4" data-aos="fade-up">Fadli Phone</h1>
      <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
        <p>Kami adalah toko handphone terpercaya yang menyediakan berbagai merek dan tipe HP terbaru, 
          mulai dari kelas entry-level hingga flagship. Kami menawarkan harga kompetitif, garansi resmi, 
          dan pelayanan ramah untuk semua pelanggan. Belanja langsung di toko atau online, 
          semuanya praktis dan aman!</p>
      </div>
    </div>
    <div class="row">
      <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
        <div class="swiper-wrapper d-flex border-animation-left">
          <div class="swiper-slide">
            <div class="banner-item image-zoom-effect">
              <div class="image-holder">
              </div>
              <div class="banner-content py-4">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="categories overflow-hidden">
  <div class="container">
    <div class="open-up" data-aos="zoom-out">
      <div class="row">
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="images/android.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a href="index.php" class="btn btn-common text-uppercase">android</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="index.php">
                <img src="images/ios.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a href="index.php" class="btn btn-common text-uppercase">iphone</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="images/henset.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a href="index.html" class="btn btn-common text-uppercase">aksesoris</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="new-arrival" class="new-arrival py-5 position-relative overflow-hidden">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
      <h4 class="text-uppercase">produk toko kami</h4>
      <a href="?page=shop/index" class="btn-link">lihat semua produk</a>
    </div>

    <!-- SEARCH BOX -->
    <div class="row mb-4">
      <div class="col-12">
        <input type="text" id="searchProduct" class="form-control" placeholder="Cari produk...">
      </div>
    </div>

    <div class="row">
      <?php
      $produk = mysqli_query($koneksi, "SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY id_produk");
      while ($item = mysqli_fetch_array($produk)) :
      ?>
        <div 
          class="col-md-3 col-sm-6 mb-4 product-card"
          data-id="<?= $item['id_produk'] ?>"
          data-name="<?= htmlspecialchars($item['nama_produk']) ?>"
          data-price="<?= $item['harga'] ?>"
          data-image="admin/assets/images/produk/<?= $item['foto_produk'] ?>"
        >
          <div class="product-item image-zoom-effect link-effect border rounded p-2 h-100">
            <div class="image-holder position-relative text-center">
                <img src="admin/assets/images/produk/<?= $item['foto_produk'] ?>" 
                     alt="<?= $item['nama_produk'] ?>" 
                     class="product-image img-fluid" 
                     style="width: 100%; height: 250px; object-fit: cover;">
              <a href="#" class="btn-icon btn-wishlist position-absolute top-0 end-0 m-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#heart"></use>
                </svg>
              </a>
            </div>
            <div class="product-content text-center mt-3">
              <h5 class="element-title text-uppercase fs-6">
                <?= $item['nama_produk'] ?>
              </h5>
              <div class="text-decoration-none fw-bold text-dark">
                Rp. <?= number_format($item['harga'], 0, ',', '.') ?>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<!-- MODAL CHECKOUT -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="checkoutForm">
        <div class="modal-header">
          <h5 class="modal-title">Checkout Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="checkoutImage" src="" class="img-fluid mb-3" style="max-height:200px;">
          </div>
          <h5 id="checkoutName"></h5>
          <p class="fw-bold text-danger" id="checkoutPrice"></p>
          <div class="mb-3">
            <label for="checkoutQty" class="form-label">Jumlah</label>
            <input type="number" id="checkoutQty" name="qty" value="1" min="1" class="form-control" required>
          </div>
          <input type="hidden" id="checkoutId" name="id_produk">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Lanjutkan Checkout</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  
  // Search produk
  $("#searchProduct").on("keyup", function() {
    let value = $(this).val().toLowerCase();
    $(".product-card").filter(function() {
      $(this).toggle($(this).data("name").toLowerCase().indexOf(value) > -1);
    });
  });
  
  // Klik produk → buka modal
  $(".product-card").on("click", function(){
    let id = $(this).data("id");
    let name = $(this).data("name");
    let price = $(this).data("price");
    let image = $(this).data("image");
    
    $("#checkoutImage").attr("src", image);
    $("#checkoutName").text(name);
    $("#checkoutPrice").text("Rp. " + new Intl.NumberFormat('id-ID').format(price));
    $("#checkoutId").val(id);
    $("#checkoutQty").val(1);
    
    $("#checkoutModal").modal("show");
  });
  
  // Submit checkout
  $("#checkoutForm").on("submit", function(e){
    e.preventDefault();
    
    let formData = $(this).serialize();
    
    $.ajax({
      url: "proses_checkout.php",
      method: "POST",
      data: formData,
      success: function(response){
        $("#checkoutModal").modal("hide");
        alert("Produk berhasil masuk ke keranjang:\n" + response);
      },
      error: function(){
        alert("Terjadi kesalahan saat checkout.");
      }
    });
    
  });
  
});
</script>

</body>
</html>
