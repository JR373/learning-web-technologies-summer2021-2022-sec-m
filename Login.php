<?php
	
    $uname="";
    $err_uname="";
    $pass="";
    $err_pass="";
    $err_invalid="";
    $type="";
    $has_error=false;
	
	if(isset($_POST['submit']))
	{	
		if(empty($_POST['uname']))
		{
			$err_uname="*Username Required";
			$has_error=true;
			
		}
		else
		{
			$uname=$_POST['uname'];
		}
		if(empty($_POST['pass']))
		{
			$err_pass="*Password Required";
			$has_error=true;
			
		}
		else
		{
			$pass=$_POST['pass'];
		}
		
		if(!$has_error)
		{
            $xml=simplexml_load_file("data.xml");
            for($i=0;$i<count($xml->UserLogin);$i++)
            {
           
                if($uname == (String)$xml->UserLogin[$i]->name && $pass == (String)$xml->UserLogin[$i]->pass)
                {
                    $type = (String)$xml->UserLogin[$i]["type"];

                    if($type == "Doctor")
                    {
                        session_start();
                        $_SESSION["loggedinuser"]=$uname;
                        header("Location:DocHome.php");
                    }
                    else if($type == "Admin")
                    {
                        session_start();
                        $_SESSION["loggedinuser"]=$uname;
                        header("Location:Admin.php");
                    }
                    
                }
                else
                {
                    $flag=0;
                }
                
            }
                if($flag == 0)
                {
			    
                    $err_invalid="Invalid Username Password";
                    echo $err_invalid;
                    $uname="";
                    $pass="";
			    
                }

			
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    
    <title>Login</title>
    
    <title>Home</title>
    <script>
  function login() {
  let username = document.forms["Login"]["uname"].value;
  let pass = document.forms["Login"]["pass"].value;
  if (username == "" || pass == "") {
    alert("Username/Password Missing!!!");
    return false;
  }
}
</script>
    
  </head>
  <body>
      
      <h1>Medical Management System</h1>
      <form name="Login" method="post" action="" onsubmit="return login()">
      <div>
        
        <input type="text" placeholder="USERNAME" value="<?php echo $uname;?>" name="uname">
        <span style="color:red"><?php echo $err_uname;?></span>
      </div>

      <div>
        
        <input type="password" placeholder="PASSWORD" value="<?php echo $pass;?>" name="pass">
        <span style="color:red"><?php echo $err_pass;?></span>
      </div>
     
  <input type="submit" class="btn" value="Sign in" name="submit">
  </form>
  <a href="http://localhost:80/medical/reg.php">New here? Signup</a>
</div>
  </body>
</html>
