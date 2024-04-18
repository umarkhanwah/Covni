<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body class="container bg-dark p-5">
    <sections class="container bg-dark p-5">
        <style>
            .loginAS_head {
                color: white;
                font-size: 1.5rem;
            }   
            
            .P_btn_login {
                border-radius: 10px;
                /* padding: 0px 10px; */
                border: 2px solid #FF6969;
                font-weight: 900;
                color: white;
                transform: skew(10deg);
                transition: 0.5s;
            }            
            .P_btn_login:hover {
                border-radius: 10px;
                background: #FF6969;
                /* border: 20px solid #ffffff; */
                box-shadow: 0px 0px 50px 1px #FF6969;
                transform: scale(1.05) skew(0deg);
            }
            
            .P_btn_login_active {
                border-radius: 10px;
                /* padding: 0px 10px; */
                border: 2px solid #FF6969;
                font-weight: 900;
                color: white;
                transform: skew(10deg);
                transition: 0.5s;
                background: #FF6969;
            }
            
            .P_btn_FI {
                border: 2px solid #FF6969;
                border-radius: 40px;
                width: 20vw;
            }
        </style>
        <div class="row">
            <div class="col-lg-6">
                <h6 class="loginAS_head mb-3">Admin - Sign In</h6>
            </div>
            <div class="col-lg-6 mb-3 d-flex justify-content-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" class="btn P_btn_login P_btn_login_active">Sign In</a>
                    <a href="" class="btn disabled text-light P_btn_login">Sign Up</a>
                </div>
            </div>
            <hr style="color: white;">
            <div class="col-12 mt-5 pt-5 d-flex justify-content-center">
                        
            <form action="a_login" method="Post">
                @csrf
            
                <!-- <form action="u_login" method="Post">
                    @csrf -->
                    <div class="mb-3 text-light">
                        <label for="exampleInputEmail1" class="form-label ">Enter Phone no.</label>
                        <!-- <input type="tel" class="form-control P_btn_FI" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone no."> -->
                        <input type="text" class="form-control  P_btn_FI" name="phone" id="phone" aria-describedby="emailHelpId" placeholder="abc@mail.com">
                        @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @else
                        <small id="emailHelpId" class="form-text text-muted">Enter Your Phone Number Here</small>
                        @endif
              
                    </div>
                    <div class="mb-3 text-light">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control  P_btn_FI" name="password" id="password"  placeholder="Your Password Here">
                        @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @else
                        <small id="emailHelpId" class="form-text text-muted">Enter Your Password</small>
                        @endif
              
                    </div>
                    @if($message = Session::get('warning'))

                        <div class="alert alert-warning">
                        {{ $message }}
                        </div>
                        
                    @endif
                    <button name="submit" type="submit" class="btn float-end P_btn_login">Sign In</button>
                </form>
            </div>

        </div>
    </section>
</body>

</html>