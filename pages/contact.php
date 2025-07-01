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

<?php include '../includes/header.php'; ?>
<main id="main"  class="py-20">
    <!-- ***** Main Banner Area Start ***** -->
    <div class="py-20 bg-gray-50" id="top">
      <div class="container px-4 mx-auto">
        <div class="text-center">
          <h2 class="mb-4 text-4xl font-bold text-gray-900">Contact Us</h2>
          <p class="text-xl text-gray-600">Get in touch with us</p>
        </div>
      </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Contact Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
          <!-- Contact Form -->
          <div class="p-8 bg-white rounded-lg shadow-lg">
            <h4 class="mb-6 text-2xl font-semibold">Send us a message</h4>
            <form id="contact" action="" method="post">
              <div class="space-y-6">
                <div>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Your Name"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"
                  />
                </div>
                <div>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    pattern="[^ @]*@[^ @]*"
                    placeholder="Your Email"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"
                  />
                </div>
                <div>
                  <input
                    type="text"
                    name="subject"
                    id="subject"
                    placeholder="Subject"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"
                  />
                </div>
                <div>
                  <textarea
                    name="message"
                    id="message"
                    placeholder="Your Message"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-accent focus:border-transparent h-36"
                  ></textarea>
                </div>
                <div>
                  <button
                    type="submit"
                    id="form-submit"
                    class="w-full px-6 py-3 text-white transition-colors rounded-lg bg-primary hover:bg-primary-dark"
                  >
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Map -->
          <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="h-96">
              <iframe
                src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                class="w-full h-full border-0"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Contact Area Ends ***** -->
</main>
    <!-- ***** Footer Start ***** -->
    <?php include '../includes/footer.php'; ?>
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
    <!-- Scripts -->
    <?php include '../includes/scripts.php'; ?>
  </body>
</html>
