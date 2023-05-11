<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="login-content">
        <form class="login-form" action="auth.php" method="post">
            <h2 class="title">Welcome</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <!-- <h5>Username</h5> -->
                    <input class="form-control" type="text" name="username" placeholder="Username" autofocus autocomplete="off" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <!-- <h5>Password</h5> -->
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <button class="btn btn-primary btn-block" name="login">Login <i class="fa fa-sign-in fa-lg"></i></button><br>
            <!-- <input type="submit" class="btn" value="Login"> -->

        </form>
    </div>
    </div>
</body>

</html>