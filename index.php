<?php

error_reporting(0);
set_time_limit(0);

session_start();
unset($auth);
unset($_SESSION['an']);
unset($_SESSION['level']);
unset($_SESSION['an']);
$auth=1;
    
    function chkUser($userName,$pass){
        $pass = hash('sha256', $pass);
        $pass = hash('md5', $pass);
        
        $userName = str_replace("|","%24",$userName);
        
        $mount = $userName."|".$pass;
        
        if ($file = fopen('users.txt', 'r')) {
            while(!feof($file)) {
                $lan = fgets($file);
                $lvl = substr(strrchr($lan,"|"),1);
                $cop = $lan;
                $lan = substr($lan,0,strlen($mount));
                if($lan == $mount){
                    if(intval($lvl) != 10){
                        $cop = explode('|', $cop);
                    	
                        $cop = intval($cop[2]);
                        $noew = intval(strtotime("-30 days"));
                        if($cop > $noew) {
                            $auth=1;
                	        $_SESSION['level'] = $lvl;
                            $_SESSION['an']='1';
                            break;
                        }else{
                            //header("Location: /dashboard.php");
                        }
                    }else{
                        $auth=1;
                	    $_SESSION['level'] = $lvl;
                        $_SESSION['an']='1';
                        break;
                    }

                }
            }
        	fclose($file);
        }
        if($_SESSION['an'] != '1'){
          	$_SESSION['an'] = '0';
    	}
        
    }
    
if(isset($_GET['logout']) AND isset($_SESSION['an'])){
    if($_GET['logout'] == "true"){
    
        unset($auth);
        unset($_SESSION['an']);
        unset($_SESSION['level']);
        session_destroy();
        header("Location: /");
        exit();
    }
}

if(isset($_REQUEST['email'])){
	chkUser($_REQUEST['email'], $_REQUEST['pass']);
}
	//var_dump($_SESSION);

	if($_SESSION['an'] == '1'){
    	echo "<script>alert alert-success alert-dismissable('Sucesso!' , 'Logado Com Sucesso' , 'success');</script>";
    	if($_SESSION['level'] == 10){
			echo '<meta http-equiv="refresh" content="0;url=central.php">';
    	
    	}else{
    		echo '<meta http-equiv="refresh" content="0;url=home/dashboard.php">';
    	}
    	exit();
    }else if($_SESSION['an'] == '0'){
    	echo '<div class="alert alert-danger" role="alert"><strong>Atenção:</strong> O login ou senha inseridos são inválidos!</div>';
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Braske devolper</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="https://cdn0.iconfinder.com/data/icons/cyber-crime-or-threats-glyph/120/hacker_cyber_crime-512.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	
	
	<form name="form" method="POST" autocomplete="off" class="form-horizontal">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

					<span class="login100-form-title p-b-26">
						Bem Vindo
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Usuário"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Logar
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Ainda não tem acesso?
						</span>

						<a class="txt2" href="https://t.me/braske171">
							Contate-nos
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	









<?php

?>
    
    


















	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>