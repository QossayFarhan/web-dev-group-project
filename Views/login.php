<html>

<head>
    <title>SuperManager - Login Page</title>
    <link rel="icon" href="assets/favicon/favicon.png"/> <!-- Logo on tab -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="Views/common/css/login.css"/>
</head>

<body class="text-center">
    <main class="form-signin">
        <form method="post" action="login">
            <img class="mb-2" src="assets/images/logo.png" alt="" width="300" height="100">
            <h1 class="h3 mb-3 fw-normal">Login to access your account</h1>
            <?php if(isset($_REQUEST['invalid'])) { ?>
            <div class="alert alert-danger" role="alert">
                Incorrect Email address or Password
            </div>
            <?php } ?>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Email address">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <br/>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
        </form>
    </main>
</body>

</html>