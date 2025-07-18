<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include '../includes/head.php'; ?>
  <link rel="stylesheet" href="../src/css/tailwind.css">
  <link rel="stylesheet" href="../src/css/menu.css">
  <link rel="stylesheet" href="../src/css/responsive.css">   
  <link rel="stylesheet" href="../src/css/style.css">
  <link rel="stylesheet" href="../src/css/modals.css">
</head>
<body class="font-poppins">
  <?php include '../includes/header.php'; ?>
  
  <main id="main"  class="py-20">
    <!-- ***** About Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
          <div class="relative overflow-hidden rounded-xl">
            <img
              src="/boutiqua/assets/images/about-left-image.jpg"
              alt=""
              class="object-cover w-full h-full"
            />
          </div>
          <div class="space-y-6">
            <h4 class="text-3xl font-semibold text-gray-900">
              About Us &amp; Our Skills
            </h4>
            <p class="text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod kon tempor incididunt ut labore.
            </p>
            <div class="p-6 bg-gray-100 rounded-lg">
              <div class="flex items-start gap-4">
                <i class="text-2xl fa fa-quote-left text-accent"></i>
                <p class="italic text-gray-700">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiuski smod kon tempor incididunt ut labore.
                </p>
              </div>
            </div>
            <p class="text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod kon tempor incididunt ut labore et dolore magna aliqua ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip.
            </p>
            <div class="flex space-x-4">
              <a
                href="#"
                class="text-gray-600 transition-colors hover:text-accent"
                ><i class="fa fa-facebook"></i
              ></a>
              <a
                href="#"
                class="text-gray-600 transition-colors hover:text-accent"
                ><i class="fa fa-twitter"></i
              ></a>
              <a
                href="#"
                class="text-gray-600 transition-colors hover:text-accent"
                ><i class="fa fa-linkedin"></i
              ></a>
              <a
                href="#"
                class="text-gray-600 transition-colors hover:text-accent"
                ><i class="fa fa-behance"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** About Area Ends ***** -->

    <!-- ***** Our Team Area Starts ***** -->
    <section class="py-16 bg-gray-50">
      <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-gray-900">
            Our Amazing Team
          </h2>
          <p class="text-gray-600">
            Details to details is what makes boutiqua different from the other
            themes.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          <!-- Team Member 1 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg group">
            <div class="relative">
              <img
                src="/boutiqua/assets/images/team-member-01.jpg"
                class="w-full"
                alt="Team Member"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-facebook"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-twitter"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-linkedin"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-behance"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="p-6">
              <h4 class="mb-2 text-xl font-semibold">Ragnar Lodbrok</h4>
              <span class="text-gray-600">Product Caretaker</span>
            </div>
          </div>

          <!-- Team Member 2 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg group">
            <div class="relative">
              <img
                src="/boutiqua/assets/images/team-member-02.jpg"
                class="w-full"
                alt="Team Member"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-facebook"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-twitter"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-linkedin"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-behance"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="p-6">
              <h4 class="mb-2 text-xl font-semibold">Ragnar Lodbrok</h4>
              <span class="text-gray-600">Product Caretaker</span>
            </div>
          </div>

          <!-- Team Member 3 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg group">
            <div class="relative">
              <img
                src="/boutiqua/assets/images/team-member-03.jpg"
                class="w-full"
                alt="Team Member"
              />
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-facebook"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-twitter"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-linkedin"></i
                  ></a>
                  <a
                    href="#"
                    class="text-white transition-colors hover:text-accent"
                    ><i class="fa fa-behance"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="p-6">
              <h4 class="mb-2 text-xl font-semibold">Ragnar Lodbrok</h4>
              <span class="text-gray-600">Product Caretaker</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Our Team Area Ends ***** -->

    <!-- ***** Services Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-gray-900">
            Our Services
          </h2>
          <p class="text-gray-600">
            Details to details is what makes boutiqua different from the other
            themes.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          <!-- Service 1 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="p-6">
              <h4 class="mb-4 text-xl font-semibold">Synther Vaporware</h4>
              <p class="mb-6 text-gray-600">
                Lorem ipsum dolor sit amet, consecteturti adipiscing elit, sed
                do eiusmod temp incididunt ut labore, et dolore quis ipsum
                suspend.
              </p>
            </div>
            <img src="assets/images/service-01.jpg" alt="" class="w-full" />
          </div>

          <!-- Service 2 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="p-6">
              <h4 class="mb-4 text-xl font-semibold">Locavore Squidward</h4>
              <p class="mb-6 text-gray-600">
                Lorem ipsum dolor sit amet, consecteturti adipiscing elit, sed
                do eiusmod temp incididunt ut labore, et dolore quis ipsum
                suspend.
              </p>
            </div>
            <img src="assets/images/service-02.jpg" alt="" class="w-full" />
          </div>

          <!-- Service 3 -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="p-6">
              <h4 class="mb-4 text-xl font-semibold">Health Gothfam</h4>
              <p class="mb-6 text-gray-600">
                Lorem ipsum dolor sit amet, consecteturti adipiscing elit, sed
                do eiusmod temp incididunt ut labore, et dolore quis ipsum
                suspend.
              </p>
            </div>
            <img src="assets/images/service-03.jpg" alt="" class="w-full" />
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Services Area Ends ***** -->
  </main>
  <!-- ***** Footer Start ***** -->
  <?php include '../includes/footer.php'; ?>
  
  <!-- Scripts -->
  <?php include '../includes/scripts.php'; ?>
</body>
</html>
