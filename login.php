<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="login-content w-full h-full min-h-[100vh] flex items-center justify-center">
        <form class="login-form flex flex-col items-center space-y-4" action="auth.php" method="post">
            <h2 class="title text-3xl">Welcome</h2>
            <div class="flex flex-col space-y-3">
            <input class="py-2 px-4 border-[1px] border-black rounded-[8px]" type="text" name="username" placeholder="Username" autofocus autocomplete="off" required>
            <input class="py-2 px-4 border-[1px] border-black rounded-[8px]" type="password" name="password" placeholder="Password" required>
            </div>
            <button class="py-2 px-4 border-[1px] border-black rounded-[8px]" name="login">Login <i class="fa fa-sign-in fa-lg"></i></button><br>
        </form>
    </div>
    </div>
</body>

</html>