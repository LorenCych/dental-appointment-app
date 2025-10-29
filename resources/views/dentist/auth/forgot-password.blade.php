<!DOCTYPE html>
<html data-bs-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Forgot Password - Dental Clinic</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/styles.min.css?h=603e8133128ec3586bcc20713be67e15">
</head>

<body style="background: linear-gradient(to bottom right, #ecb306, #f3edd7); min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="border border-primary rounded-2 card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-flex">
                <div class="rounded flex-grow-1" style="background: url('{{ asset('assets/img/password-recover.png') }}') no-repeat center center; background-size: cover;"></div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-2">Forgot Your Password?</h4>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>

                  <!-- Flash Messages -->
                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                  @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                  @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      @foreach($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                      @endforeach
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                  <form class="user" method="POST" action="{{ route('dentist.password.email') }}">
                    @csrf
                    <div class="mb-3">
                      <input class="form-control form-control-user @error('email') is-invalid @enderror" 
                             type="email" 
                             id="email" 
                             name="email"
                             placeholder="Enter Email Address..." 
                             value="{{ old('email') }}"
                             required 
                             autofocus>
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <button class="btn btn-primary d-block btn-user w-100" type="submit">
                      <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                    </button>
                  </form>
                  
                  <hr>
                  
                  <div class="text-center">
                    <a class="small" href="{{ route('home.admin-login') }}">
                      <i class="fas fa-arrow-left me-1"></i>Back to Login
                    </a>
                  </div>
                  
                  <div class="text-center mt-3">
                    <small class="text-black-50">
                      <i class="fas fa-info-circle me-1"></i>
                      Reset link will be sent to your registered email address and will expire in 2 hours.
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>

</html>