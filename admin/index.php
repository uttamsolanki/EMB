<?php
include('config.php');
if(isset($_POST['submit']))
{
  
  $uname = $_POST['email'];
  $pass = $_POST['password'];
  if($uname=='test@gmail.com' && $pass=='123' )
  {
    ?>
    <script>
    window.location.href='uploademb.php?success';
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      window.location.href='index.php?fail';
    </script>
    <?php
  }
  
}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Welcome to Restaurants Hub</title>
        <link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  </head>

 <body>
 
	
  <div class="row valign-wrapper maindiv">
    <form class="col s12 valign" action="index.php" method="post">
      <div class="row">
        <div class="col s12 center">
			<img src="images/logo.png">
		</div>
      </div>      
      <div class="row center-align">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate inputcenter" name="email">
          <label for="email" class="labellogin">Email</label>
        </div>
      </div>
	  <div class="row center-align">
        <div class="input-field col s12 center-align">
          <input id="password" type="password" class="validate inputcenter" name="password">
          <label for="password" class="labellogin" >Password</label>
        </div>
      </div>
	  <div class="butlogin">
	  <button class="waves-effect waves-light btn center-align amber darken-3" name="submit">Login</button>
	  </div>
    </form>
  </div>
        

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/materialize.js"></script>
    <script src="js/index.js"></script>    
 </body>
</html>
