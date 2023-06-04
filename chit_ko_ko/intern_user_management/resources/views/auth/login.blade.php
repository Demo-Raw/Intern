<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/storage/favicon-login.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
        }

        body {
            background-image: url("{{ asset('/storage/login.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        #login-form {
            background-color: #ffffff;
            border-radius: 25px;
            width: 500px;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div id="login-form">
        <div class="row">
            <div class="col-md">
                <h2 class="text-center">
                    <i class="fa-solid fa-user me-1"></i>
                </h2>
                <h2 class="text-center mb-4">
                    Login
                </h2>
                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <i class="fa-solid fa-envelope me-1"></i>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="mb-5">
                        <i class="fa-solid fa-key me-1"></i>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary px-5">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/98dfc436c4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            $('input[name="email"]').focus();
        });
    </script>
</body>
</html>