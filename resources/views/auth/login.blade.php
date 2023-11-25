<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
    <script src="{{asset('bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js') }}"></script>
    <!-- End bootstrap -->

    <!-- Linked SCSS files -->
    <link rel="stylesheet" href="{{asset('scss/main.css')}}">
    <link rel="stylesheet" href="{{asset('animation_assets/css/style.css')}}">
    <!-- Title -->
    <title>Cod Spider Invoice</title>
    <!-- End title -->
</head>

<!-- Start body -->
<body>
<div class="row g-0">
    <div class="col-md-12 g-0">
        <div class="left-side d-flex justify-content-center align-items-center">
            <div class="card form-control w-25 justify-content-center border-0">
                <form action="{{route('authenticate')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <img class="login-img" src="{{asset('img/logo.png')}}">
                        <input type="text" name="username" class="form-control mt-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
                        @error('username')
                        <strong style="color:red;">{{ $errors->first('username') }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control mt-3" id="exampleInputPassword1" placeholder="Password">
                        @error('password')
                        <strong style="color:red;">{{ $errors->first('password') }}</strong>
                        @enderror
                    </div>
                    <input type="hidden" name="login_method" value="admin">
                    <button type="submit" class="btn btn-primary btn-lg form-control mt-3 ">Login</button>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
<!-- End body -->
</html>
