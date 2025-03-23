<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $_SESSION['system']['name'] ?></title>

  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
  ?>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
</head>
<style>
    body {
        width: 100%;
        height: 100%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    main#main {
        width: 80%;
        max-width: 900px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        display: flex;
        overflow: hidden;
    }
    #login-right {
        width: 40%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
    }
    #login-left {
        width: 60%;
        background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) no-repeat center center;
        background-size: cover;
    }
    #login-right .card {
        width: 100%;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    label {
        display: block;
        font-weight: 500;
    }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
        border: 2px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
    }
    input[type="text"]:focus, input[type="password"]:focus {
        border-color: #0056b3;
        outline: none;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }
</style>

<body>
    <main id="main" class="animate__animated animate__fadeIn">
        <div id="login-left"></div>
        <div id="login-right">
            <div class="card">
                <div class="card-body">
                    <form id="login-form">
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $('#login-form').submit(function(e){
        e.preventDefault();
        $('button[type="submit"]').attr('disabled',true).html('Logging in...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'ajax.php?action=login',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                $('button[type="submit"]').removeAttr('disabled').html('Login');
            },
            success:function(resp){
                if(resp == 1){
                    location.href ='index.php?page=home';
                }else{
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('button[type="submit"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
    </script>
</body>
</html>
