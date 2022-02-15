<?php?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
    <title>Login</title>

    <style>
      <?php include ('style.css') ?>
    </style>
  </head>
  <body>
    <div class="Register-box">
      <div class="login-pic">
        <img src="Image/sidepic.jpg" alt="">
      </div>
      <div class="container">
        <h1 style="margin-top: 20px">Welcome Back</h1>
        <form action="login.php" method="post">

          <div class="login-box">

            <label><b>Email</b></label>
            <div class="field">
              <input type="email" placeholder="Enter Your Email" name="email">
            </div>

              <label><b>Password</b></label>
            <div class="field">
              <div class="pass">
                <input onkeyup="trigger()" type="password" placeholder="Type password" name="password">
                <span class="showBtn">SHOW</span>
              </div>

            </div>

          </div>

          <!-- <div class="error-p">
            <div class="error"><p><?php include('errors.php');?></p></div>
          </div> -->

            <div class="log">
              <button type="submit" name="login_user">Login</button>
            </div>
            <div class="back-log">
               <a href="index.php" ><button type="button">Back</button></a>
            </div>

            <div class="forgot">
               <a href="Register.php" style="float:left; color:black;">Register For New User</a><i class="fa fa-arrow-right" style="color:black"></i>
               <br><br><a href="forgotpassword.php" style="float:left; color:black;">Forgot Password?</a>
            </div>
        </form>
      </div>
    </div>

    <!-- <script>
      const indicator = document.querySelector(".indicator");
      const input = document.querySelector(".pass input");
      const showBtn = document.querySelector(".showBtn");
      function trigger(){
        if(input.value != ""){
          showBtn.style.display = "block";
          showBtn.onclick = function(){
            if(input.type == "password"){
              input.type = "text";
              showBtn.textContent = "HIDE";
              showBtn.style.color = "#23ad5c";
            }else{
              input.type = "password";
              showBtn.textContent = "SHOW";
              showBtn.style.color = "#000";
            }
          }
        }else{
          showBtn.style.display = "none";
        }
      }
    </script>

  </body>
</html> -->
