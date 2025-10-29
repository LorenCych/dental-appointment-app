<!DOCTYPE html>
<html data-bs-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Account Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css?h=603e8133128ec3586bcc20713be67e15">
</head>

<body>
    <section class="d-flex">@include('partials.dentist-sidebar')
        <div class="bg-body flex-grow-1 p-3" id="main-content">
            <section class="mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 ms-0">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="bs-icon-lg bs-icon-circle bs-icon" style="background: #23272a;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-person">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z">
                                        </path>
                                    </svg></div>
                                <h2 class="ms-3 mb-0">Manage Account Information</h2>
                            </div>
                            <hr class="mt-2 mb-2">
                            <p class="text-black-50">Modify your current account details and credentials.</p>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card">
                                <div
                                    class="text-center text-white d-xxl-flex justify-content-xxl-center align-items-xxl-center"
                                    style="background: linear-gradient(-160deg, #daa400 31%, var(--bs-warning) 91%), var(--bs-dark);">
                                    <h6 class="my-2">Account Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-xl-12">
                                        <form method="POST" action="{{ route('dentist.account.update') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="username">Username</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="text" id="username" name="username" value="{{ $admin->username }}" required="">
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="email">E-mail Address</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="email" id="email" name="email" value="{{ $admin->email }}" inputmode="email" required="">
                                                </div>
                                                
                                                <div class="col-12 col-md-4">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="first_name">First Name</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="text" id="first_name" name="first_name" value="{{ $admin->first_name }}" required="">
                                                </div>
                                                
                                                <div class="col-12 col-md-4">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="middle_name">Middle Name</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="text" id="middle_name" name="middle_name" value="{{ $admin->middle_name }}">
                                                </div>
                                                
                                                <div class="col-12 col-md-4">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="last_name">Last Name</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="text" id="last_name" name="last_name" value="{{ $admin->last_name }}" required="">
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="contact_number">Contact Number</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="text" id="contact_number" name="contact_number" value="{{ $admin->contact_number }}" required="">
                                                </div>
                                                
                                                <hr class="mt-2 mb-4">
                                                
                                                <h2 class="mb-3">Change Password</h2>
                                                <p class="mb-md-4 mb-3 mx-auto text-start text-black-50">Leave blank to keep your current password.</p>

                                                <div class="col-12 col-md-6">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="password">New Password</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="password" id="password" name="password" placeholder="Leave blank to keep current password" minlength="12" maxlength="18">
                                                </div>
                                                
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label d-flex d-sm-flex justify-content-start justify-content-sm-start" for="password_confirmation">Confirm New Password</label>
                                                    <input class="border border-dark-subtle mb-4 form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" minlength="12" maxlength="18">
                                                </div>
                                            </div>

                                            <hr>

                                            <p class="text-start text-black-50 mb-md-4 mb-lg-4 mb-xl-4 mb-xxl-3">Please double-check your personal details before submitting to avoid any processing delays. You’ll still be able to edit them later if needed.</p>
                                            <div class="row">
                                                <div class="col d-flex flex-column-reverse justify-content-start mt-0">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 mt-sm-4 mt-lg-2 mt-xl-0 mt-xxl-1">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.min.js?h=54f9ea67a2f2b565925a52e00bfadc6c"></script>
</body>

</html>