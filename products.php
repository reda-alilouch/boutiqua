<!DOCTYPE html>
<html lang="en">
  <?php include 'includes/head.php'; ?>

  <body class="font-poppins">
    <!-- ***** Preloader Start ***** -->
    <div
      id="preloader"
      class="fixed inset-0 z-50 flex items-center justify-center bg-white"
    >
      <div class="flex space-x-2 jumper">
        <div class="w-3 h-3 rounded-full bg-accent animate-bounce"></div>
        <div
          class="w-3 h-3 delay-75 rounded-full bg-accent animate-bounce"
        ></div>
        <div
          class="w-3 h-3 delay-150 rounded-full bg-accent animate-bounce"
        ></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

   <?php include 'includes/header.php'; ?>
<main id="main"  class="py-20">
    

    <!-- ***** Products Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <!-- Product Categories -->
        <div class="mb-12">
          <ul class="flex flex-wrap justify-center gap-4">
            <li>
              <a
                href="#"
                data-filter="*"
                class="px-3 py-3 text-white bg-black transition-colors rounded-full "
                >All Products</a
              >
            </li>
            <li>
              <a
                href="#"
                data-filter=".new"
                class="px-3 py-3 transition-colors border rounded-full border-black text-black "
                >New Arrivals</a
              >
            </li>
            <li>
              <a
                href="#"
                data-filter=".special"
                class="px-3 py-3 transition-colors border rounded-full border-black text-black "
                >Special Offers</a
              >
            </li>
            <li>
              <a
                href="#"
                data-filter=".featured"
                class="px-3 py-3 transition-colors border rounded-full border-black text-black"
                >Featured</a
              >
            </li>
          </ul>
        </div>

        <!-- Products Grid -->
        <div
          class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
          id="products"
        >
          <!-- Product Item 1 -->
          <div class="relative overflow-hidden rounded-lg shadow-lg group new">
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-01.jpg"
                alt="Product"
                class="object-cover w-full h-full"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Classic Spring</h4>
              <span class="text-lg font-medium text-accent">$120.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product Item 2 -->
          <div
            class="relative overflow-hidden rounded-lg shadow-lg group special"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-02.jpg"
                alt="Product"
                class="object-cover w-full h-full"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Air Force 1 X</h4>
              <span class="text-lg font-medium text-accent">$90.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product Item 3 -->
          <div
            class="relative overflow-hidden rounded-lg shadow-lg group featured"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-03.jpg"
                alt="Product"
                class="object-cover w-full h-full"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="#"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Love Nana '20</h4>
              <span class="text-lg font-medium text-accent">$150.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- More Product Items... -->
          <!-- Add more product items following the same structure -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12 space-x-2">
          <a
            href="#"
            class="px-4 py-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary-dark"
            >1</a
          >
          <a
            href="#"
            class="px-4 py-2 transition-colors border rounded-lg border-primary text-primary hover:bg-primary hover:text-white"
            >2</a
          >
          <a
            href="#"
            class="px-4 py-2 transition-colors border rounded-lg border-primary text-primary hover:bg-primary hover:text-white"
            >3</a
          >
          <a
            href="#"
            class="px-4 py-2 transition-colors border rounded-lg border-primary text-primary hover:bg-primary hover:text-white"
            >4</a
          >
        </div>
      </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
</main>
    <!-- ***** Footer Start ***** -->
    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Alpine.js -->
    <script
      src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
      defer
    ></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>

    <!-- Custom JavaScript -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

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
