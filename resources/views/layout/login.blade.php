<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/NiceAdmin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="{{ asset('/NiceAdmin/assets/img/favicon.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('/NiceAdmin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/NiceAdmin/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Login</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Silahkan Login Ke Akun Anda</h5>
                    <p class="text-center small">Masukan email dan password untuk Login</p>
                  </div>

                  @if(session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
                  @endif

                  <form class="row g-3 needs-validation" method="POST" action="{{ url('prosesLogin') }}" novalidate>
                    @csrf
                    <div class="col-12">
                        <label for="yourEmail" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                            <div class="invalid-feedback">Masukan Email</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Masukan Password</div>
                    </div>
                    
                  
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

              

              <div class="credits">
                Designed by <a>Tim Magang ADR</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('/NiceAdmin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/NiceAdmin/assets/js/main.js')}}"></script>

</body>

<script>
    // document.querySelector("form").addEventListener("submit", function(event) {
    //     event.preventDefault();

    //     const email = document.querySelector("#yourEmail").value;
    //     const password = document.querySelector("#yourPassword").value;

    //     if (!email || !password) {
    //         alert("Mohon isi semua field terlebih dahulu.");
    //         return;
    //     }

    //     this.submit();
    // });
</script>


</html>
