<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Register | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/') }}backend/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ asset('/') }}backend/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('/') }}backend/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/') }}backend/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}backend/toastr/toastr.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <meta name="rh_token" content="{{ csrf_token() }}">

    </head>

    <body>
        
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Free Register</h5>
                                            <p>Get your free Skote account now.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('/') }}backend/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('/') }}backend/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                {{-- @if($errors->any())
                                    @foreach($errors->all() as $error)
                                             <p class="text text-success alert alert-success text-center">{{ $error }}</p>
                                    @endforeach
                                @endif --}}
                                <div class="p-2">
                                    {!! Form::open(['route'=>'auth.setup','class'=>'needs-validation','novalidate']) !!}
            
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input name="username" type="text" class="form-control" id="username" placeholder="Enter username" required>
                                            <div class="invalid-feedback">
                                                Please Enter Username
                                            </div>  
                                        </div>


                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="useremail" placeholder="Enter email" required>  
                                            <div class="invalid-feedback">
                                                Please Enter Email
                                            </div>      
                                        </div>
                
                
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password</label>
                                            <input name="password" type="password" class="form-control" id="userpassword" placeholder="Enter password" required>
                                            <div class="invalid-feedback">
                                                Please Enter Password
                                            </div>       
                                        </div>
                    
                                        <div class="mt-4 d-grid">
                                            <button id="register" class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <h5 class="font-size-14 mb-3">Sign up using</h5>
            
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Already have an account ? <a href="auth-login.html" class="fw-medium text-primary"> Login</a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('/') }}backend/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('/') }}backend/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}backend/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ asset('/') }}backend/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('/') }}backend/libs/node-waves/waves.min.js"></script>
        <script src="{{ asset('/') }}backend/toastr/toastr.min.js"></script>
        

        <!-- validation init -->
        <script src="{{ asset('/') }}backend/js/pages/validation.init.js"></script>
        
        <!-- App js -->
        <script src="{{ asset('/') }}backend/js/app.js"></script>

        <script>


            let email = document.getElementById('useremail');
            let username = document.getElementById('username');
            let password = document.getElementById('userpassword');


            document.getElementById('register').addEventListener('click',function(e){
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="rh_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ Route("auth.setup") }}',
                    data: {
                        email: email.value,
                        username: username.value,
                        password: password.value
                    },
                    success: function(response){
                        // console.log(response)
                        toastr.options = {
                            'positionClass': 'toast-bottom-right',
                            'debug': false,
                            'progressBar': true
                        }
                        if($.isEmptyObject(response.failed)){
                            if($.isEmptyObject(response.error)){
                                toastr.success(response.success)

                                setTimeout(function(){
                                    window.location = '{{ Route("auth.login") }}'
                                },1000)
                            }else{
                                toastr.error(response.error)
                            }
                        }else{
                            response.failed.forEach(function(value){
                                toastr.error(value)
                            });
                        }
                    }
                });
            })

            
        </script>

    </body>
</html>
