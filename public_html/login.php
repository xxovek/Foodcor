<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="login, signin">

    <title>Login Page</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.png">
  </head>

  <body class="min-h-fullscreen bg-img center-vh p-20" style="background-image: url(assets/img/bg/a.jpeg);" data-overlay="7">

    <div class="card card-round card-shadowed px-50 py-30 w-400px mb-0" style="max-width: 100%">
      <h5 class="text-uppercase">Sign in</h5>
      <br>

      <form data-provide="validation" method="post" id="login" class="">
        <div class="form-group">
          <label for="username" class="require"  data-provide="tooltip" title="Enter E-mail Id">Email</label>
          <input type="text" class="form-control" name="uname" id="uname"  required>

        </div>

        <div class="form-group">
          <label for="password" class="require">Password</label>
          <input type="password" class="form-control" name="pwd" id="pwd" required>

        </div>

        <div class="form-group flexbox">
          <label class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" checked>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Remember me</span> -->
          </label>

          <a class="text-muted hover-primary fs-13" href="#">Forgot password?</a>
        </div>

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
          <span id="msg"></span>
        </div>
      </form>

      <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a class="text-primary fw-500" href="register.php">Sign up</a></p>
    </div>
    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>

  </body>
  <script type="text/javascript">
  $("#login").on('submit',function(e){
    e.preventDefault();
    var uname=$("#uname").val();
    var pwd=$("#pwd").val();
    if(uname=="")
    {
    $("#uname").focus();
    }
    else if(pwd=="")
    {
    $("#pwd").focus();
    }
    else {
    $.ajax({
      url:'../src/userLogin.php',
      data:{uname:uname,pwd:pwd},
      dataType:'json',
      success:function(response){
        if(response.msg === 1)
        {
          window.location.href = 'index.php';
      }
        else{
        $("#msg").html("<font color='red' >Invalid Username or Password !</font>");
        $("#msg").show();

        setTimeout(function(){
          $("#msg").hide();
        },3000);
      }
      }
    });
  }
  });
  </script>
</html>
