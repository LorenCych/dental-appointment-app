<!DOCTYPE html>
<html data-bs-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Reset Password - Dental Clinic</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/styles.min.css?h=603e8133128ec3586bcc20713be67e15">
</head>

<body style="background: linear-gradient(to bottom right, #ecb306, #f3edd7); min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
          <div class="bg-white rounded col-lg-6 d-none d-lg-flex">
           <img src="{{ asset('assets/img/password-recover.png') }}" 
            alt="Password Recovery Image" 
            class="img-fluid object-fit-contain w-100 h-100" 
            style="object-position: center;">
          </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-2">Reset Your Password</h4>
                    <p class="mb-4">Enter your new password below. Make sure it's secure and easy to remember!</p>
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

                  <form class="user" method="POST" action="{{ route('dentist.password.update', request()->query()) }}">
                    @csrf
                    
                    <!-- Hidden email field -->
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-3">
                      <label for="email_display" class="form-label">Email Address</label>
                      <input class="form-control form-control-user" 
                             type="email" 
                             id="email_display"
                             value="{{ $email }}" 
                             disabled>
                      <small class="text-black-50">Password will be reset for this account</small>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">New Password</label>
                      <input class="form-control form-control-user @error('password') is-invalid @enderror" 
                             type="password" 
                             id="password" 
                             name="password"
                             placeholder="Enter new password (12-18 characters)"
                             minlength="12"
                             maxlength="18"
                             required>
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <small class="text-black-50">Must be 12-18 characters long</small>
                    </div>

                    <div class="mb-3">
                      <label for="password_confirmation" class="form-label">Confirm New Password</label>
                      <input class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" 
                             type="password" 
                             id="password_confirmation" 
                             name="password_confirmation"
                             placeholder="Confirm your new password"
                             minlength="12"
                             maxlength="18"
                             required>
                      @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Password strength indicator -->
                    <div class="mb-3">
                      <div class="password-strength">
                        <small class="text-black-50">Password Requirements:</small>
                        <ul class="list-unstyled small text-black-50">
                          <li><i class="fas fa-check text-success me-1" id="length-check" style="display:none;"></i>
                              <i class="fas fa-times text-danger me-1" id="length-x"></i>12-18 characters</li>
                        </ul>
                      </div>
                    </div>

                    <button class="btn btn-primary d-block btn-user w-100" type="submit" id="resetBtn">
                      <i class="fas fa-key me-2"></i>Reset Password
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
                      <i class="fas fa-shield-alt me-1"></i>
                      For your security, this reset link will expire after use.
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
  
  <script>
    // Password validation
    document.addEventListener('DOMContentLoaded', function() {
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('password_confirmation');
      const resetBtn = document.getElementById('resetBtn');
      const lengthCheck = document.getElementById('length-check');
      const lengthX = document.getElementById('length-x');

      function validatePassword() {
        const pwd = password.value;
        const isValidLength = pwd.length >= 12 && pwd.length <= 18;
        
        // Update length indicator
        if (isValidLength) {
          lengthCheck.style.display = 'inline';
          lengthX.style.display = 'none';
        } else {
          lengthCheck.style.display = 'none';
          lengthX.style.display = 'inline';
        }
        
        // Check if passwords match
        const passwordsMatch = pwd === confirmPassword.value && pwd.length > 0;
        
        // Enable/disable button
        resetBtn.disabled = !isValidLength || !passwordsMatch;
      }

      password.addEventListener('input', validatePassword);
      confirmPassword.addEventListener('input', validatePassword);
      
      // Initial validation
      validatePassword();
    });
  </script>
</body>

</html>