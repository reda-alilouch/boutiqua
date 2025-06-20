<!DOCTYPE html>
<html lang="en">
 <?php include 'includes/head.php'; ?>

  <body class="font-poppins">
    <!-- ***** Preloader Start ***** -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
      <div class="flex space-x-2 jumper">
        <div class="w-3 h-3 rounded-full bg-accent animate-bounce"></div>
        <div class="w-3 h-3 delay-75 rounded-full bg-accent animate-bounce"></div>
        <div class="w-3 h-3 delay-150 rounded-full bg-accent animate-bounce"></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php include 'includes/header.php'; ?>
<main id="main" class="py-20">
    <!-- ***** Main Banner Area Start ***** -->
    
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Product Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
          <!-- Product Images -->
          <div class="space-y-6">
            <!-- Main Image -->
            <div class="relative overflow-hidden rounded-lg aspect-w-4 aspect-h-3">
              <img id="main-image" src="assets/images/single-product-01.jpg" alt="Product" class="object-cover w-full h-full" />
            </div>
            <!-- Thumbnail Images -->
            <div class="grid grid-cols-4 gap-4">
              <div class="overflow-hidden transition-opacity rounded-lg cursor-pointer hover:opacity-75">
                <img src="assets/images/single-product-01.jpg" alt="Thumbnail" class="object-cover w-full h-full" onclick="changeMainImage('assets/images/single-product-01.jpg')" />
              </div>
              <div class="overflow-hidden transition-opacity rounded-lg cursor-pointer hover:opacity-75">
                <img src="assets/images/single-product-02.jpg" alt="Thumbnail" class="object-cover w-full h-full" onclick="changeMainImage('assets/images/single-product-02.jpg')" />
              </div>
              <div class="overflow-hidden transition-opacity rounded-lg cursor-pointer hover:opacity-75">
                <img src="assets/images/single-product-03.jpg" alt="Thumbnail" class="object-cover w-full h-full" onclick="changeMainImage('assets/images/single-product-03.jpg')" />
              </div>
              <div class="overflow-hidden transition-opacity rounded-lg cursor-pointer hover:opacity-75">
                <img src="assets/images/single-product-04.jpg" alt="Thumbnail" class="object-cover w-full h-full" onclick="changeMainImage('assets/images/single-product-04.jpg')" />
              </div>
            </div>
          </div>

          <!-- Product Details -->
          <div class="space-y-8">
            <div>
              <h1 class="mb-4 text-3xl font-bold text-gray-900">New Green Jacket</h1>
              <div class="flex items-center mb-4 space-x-4">
                <span class="text-2xl font-semibold text-accent">$75.00</span>
                <span class="text-lg text-gray-500 line-through">$90.00</span>
              </div>
              <div class="flex items-center mb-4 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <span class="ml-2 text-gray-600">(24 Reviews)</span>
              </div>
              <p class="leading-relaxed text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.
              </p>
            </div>

            <!-- Size Selection -->
            <div>
              <h3 class="mb-3 text-lg font-semibold">Choose Size</h3>
              <div class="flex space-x-4">
                <button class="px-4 py-2 transition-colors border-2 border-gray-300 rounded-lg hover:border-accent focus:border-accent focus:outline-none">XS</button>
                <button class="px-4 py-2 transition-colors border-2 border-gray-300 rounded-lg hover:border-accent focus:border-accent focus:outline-none">S</button>
                <button class="px-4 py-2 transition-colors border-2 rounded-lg border-accent hover:border-accent focus:border-accent focus:outline-none">M</button>
                <button class="px-4 py-2 transition-colors border-2 border-gray-300 rounded-lg hover:border-accent focus:border-accent focus:outline-none">L</button>
                <button class="px-4 py-2 transition-colors border-2 border-gray-300 rounded-lg hover:border-accent focus:border-accent focus:outline-none">XL</button>
              </div>
            </div>

            <!-- Quantity and Add to Cart -->
            <div class="flex items-center space-x-6">
              <div class="flex items-center border-2 border-gray-300 rounded-lg">
                <button class="px-4 py-2 text-gray-600 hover:text-accent focus:outline-none" onclick="decrementQuantity()">-</button>
                <input type="number" id="quantity" class="w-16 text-center border-0 focus:outline-none" value="1" min="1" />
                <button class="px-4 py-2 text-gray-600 hover:text-accent focus:outline-none" onclick="incrementQuantity()">+</button>
              </div>
              <button class="flex-1 px-6 py-3 text-white transition-colors rounded-lg bg-accent hover:bg-accent-dark">
                Add to Cart
              </button>
            </div>

            <!-- Additional Information -->
            <div class="pt-8 space-y-6 border-t border-gray-200">
              <div>
                <h3 class="mb-2 text-lg font-semibold">Product Details</h3>
                <p class="text-gray-600">
    
    

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="inner-content">
              <h2>Single Product Page</h2>
              <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="left-images">
              <img src="assets/images/single-product-01.jpg" alt="" />
              <img src="assets/images/single-product-02.jpg" alt="" />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="right-content">
              <h4>New Green Jacket</h4>
              <span class="price">$75.00</span>
              <ul class="stars">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
              </ul>
              <span
                >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod kon tempor incididunt ut labore.</span
              >
              <div class="quote">
                <i class="fa fa-quote-left"></i>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiuski smod.
                </p>
              </div>
              <div class="quantity-content">
                <div class="left-content">
                  <h6>No. of Orders</h6>
                </div>
                <div class="right-content">
                  <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus" /><input
                      type="number"
                      step="1"
                      min="1"
                      max=""
                      name="quantity"
                      value="1"
                      title="Qty"
                      class="input-text qty text"
                      size="4"
                      pattern=""
                      inputmode=""
                    /><input type="button" value="+" class="plus" />
                  </div>
                </div>
              </div>
              <div class="total">
                <h4>Total: $210.00</h4>
                <div class="main-border-button">
                  <a href="#">Add To Cart</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
</main>
    <!-- ***** Footer Start ***** -->
    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/quantity.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>
      $(function () {
        var selectedClass = "";
        $("p").click(function () {
          selectedClass = $(this).attr("data-rel");
          $("#portfolio").fadeTo(50, 0.1);
          $("#portfolio div")
            .not("." + selectedClass)
            .fadeOut();
          setTimeout(function () {
            $("." + selectedClass).fadeIn();
            $("#portfolio").fadeTo(50, 1);
          }, 500);
        });
      });
    </script>
  </body>
</html>
