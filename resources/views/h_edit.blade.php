<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body class="container bg-dark p-5">

    <section style="height: 90vh;" class="container bg-dark p-5">
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
                border: 1.5px solid #FF6969;
                border-radius: 40px;
                /* width: 20vw; */
            }
        </style>
        <div class="row">
            <div class="col-lg-6">
                <h6 class="loginAS_head mb-3">Hospital - Sign Up</h6>
            </div>
            <div class="col-lg-6 mb-3 d-flex justify-content-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="/h_login" class="btn P_btn_login ">Sign In</a>
                    <a href="" class="btn P_btn_login P_btn_login_active">Sign Up</a>
                </div>
            </div>
            <hr style="color: white;">
            <div class="col-12 mt-5 pt- d-flexjustify-content-center">
            <form action="{{route('h_update')}}" method="POST">
      @csrf
      <div class="container">

          <div class="row">
            <input type="hidden" class="form-control P_btn_FI" name="id" id="id" value="{{ $hospital->id }}"
                        placeholder="abc@mail.com">

            <div class="my-3 col-3">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control P_btn_FI" name="name" id="name" value="{{ $hospital->name }}" placeholder="abc@mail.com">
              @error('name')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
           </div>

            <div class="my-3 col-3">
              <label for="" class="form-label">Email</label>
              <input type="email" class="form-control P_btn_FI" name="email" id="email" value="{{ $hospital->email }}" placeholder="abc@mail.com">
              @error('email')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
             </div>

            <div class="my-3 col-3">
              <label for="" class="form-label">Phone</label>
              <input type="text" class="form-control P_btn_FI" name="phone" id="phone" value="{{ $hospital->phone }}" placeholder="abc@mail.com">
              @error('phone')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
             </div>
            <div class="my-3 col-3 h-100">
              <label for="" class="form-label">Enter Adress</label>
              <textarea class="form-control h-100" name="adress" id="" rows="4">{{ $hospital->adress }}</textarea>
              @if($errors->has('adress'))
              <span class="text-danger">{{ $errors->first('adress') }}</span>
              @else
              <small id="emailHelpId" class="form-text text-muted">Enter Your Complete Adress Here</small>
              @endif
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter Country</label>
              <input type="text" class="form-control P_btn_FI" name="country" id="country" value="{{ $hospital->country }}" placeholder="abc@mail.com">
              {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter City</label>
              <input type="text" class="form-control P_btn_FI" name="city" id="city" value="{{ $hospital->city }}" placeholder="abc@mail.com">
              {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter province</label>
              <input type="text" class="form-control P_btn_FI" name="province" id="province"value="{{ $hospital->province }}" placeholder="abc@mail.com">
              @error('province')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Set Password</label>
              <input type="password" class="form-control P_btn_FI" name="password" id="password" value="{{old('password')}}" placeholder="abc@mail.com">
              @error('password')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Confirm Password</label>
              <input type="password" class="form-control P_btn_FI" name="password_confirmation" id="password_confirmation" value="{{old('password')}}" placeholder="abc@mail.com">
              @error('password')
                <small  class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="col-1 my-5 ms-auto">

              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
      </div>

    
  </form>
            </div>

        </div>
    </section>
</body>

</html>