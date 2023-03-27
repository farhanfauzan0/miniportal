<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <title>Login</title>
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme" disabled>
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme">
</head>
<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{ route('login.post') }}" method="POST">
                @csrf
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
                    <img height="100" width="100" src="{{ asset('/assets/images/logo.png') }}">
                </a>
                <p></p>
                <h1 class="h5 mb-3">Login Portal</h1>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Username</label>
                    <input type="text" name="username" id="inputEmail" class="form-control form-control-lg" placeholder="Username" required="" autofocus="">
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
                </div>
                @if(session('error'))
                <h1 class="h6 mb-3" style="color: red">Login Failed!</h1>
                @endif
                {{-- <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Stay logged in </label>
                </div> --}}
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    @if (session('mysweet'))

    <script>
        Swal.fire({
            title: "{{ session('title_a') }}"
            , text: "{{ session('text_a') }}"
            , icon: "{{ session('icon_a') }}"
        , }).then(function(e) {
            if (e.isConfirmed) {
                location.reload();
            }
        });

    </script>
    @endif
</body>
</html>
</body>
</html>
