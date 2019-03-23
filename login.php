<?php
error_reporting(0);  
set_time_limit(0);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',$_SERVER['DOCUMENT_ROOT']);

include ROOT.'/logAdemir.php';


?>

<!DOCTYPE html>
<html>
<head>
<title>Resgistrar logins</title>
  <link rel="icon" type="image/png" href="https://cdn0.iconfinder.com/data/icons/cyber-crime-or-threats-glyph/120/hacker_cyber_crime-512.png">
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Ubuntu');
body {
  margin: 0;
  padding: 0;
  background-image:url("https://store-images.s-microsoft.com/image/apps.56149.13510798887023509.52cb7b9d-27cf-417d-b33e-e4e758263928.1129934f-d053-41a1-935a-20913a56ea70?mode=scale&q=90&h=1080&w=1920");
  background-size: cover;
    
}
  .btn:focus, .btn::-moz-focus-inner{
  outline:none;
  border:none;
}
.btn{
  font-family: arial;
  font-size:14px;
  text-transform: uppercase;
  font-weight:700;
  border:none;
  padding:10px;
  cursor: pointer;
  display:inline-block;
  text-decoration: none;
}
.btn-green{
  background:green;
  color:#fff;
  box-shadow:0 5px 0 #006000;
}
.btn-green:hover{
  background:#006000;
  box-shadow:0 5px 0 #003f00;
}
.btn-purple{
  background:purple;
  color:#fff;
  box-shadow:0 5px 0 #670167;
}
.btn-purple:hover{
  background:#670167;
  box-shadow:0 5px 0 #470047;
}
.btn-red{
  background:red;
  color:#fff;
  box-shadow:0 5px 0 #d20000;
}
.btn-red:hover{
  background:#d20000;
  box-shadow:0 5px 0 #b00000;
}
.btn-green:active, .btn-purple:active, .btn-red:active{
  position:relative;
  top:5px;
  box-shadow:none;
}

h1 {
font-family: 'Ubuntu', sans-serif;
}

.box {
  width: 450px;
  background: rgb(0, 0, 0, 0.4);
  padding: 40px;
  text-align: center;
  margin: auto;
  margin-top: 5%;
  color: white;
  font-family: 'Century Gothic',sans-serif;

}

.box-img {
  border-radius: 50%;
  width: 100px;
  height: 100px;

}

.box h1 {
  font-size: 25px;
  letter-spacing: 4px;
  font-weight: 100;
  text-align: justify;

}

</style>
</head>

<body>

   <div class="box">
<h1>Registar novo usuário:
<form id="login-form" method="post"> 
<form>
<br>
<label for="key">Senha:</label>
<input type="tel" name="senha" style=" text-decoration: none;border-radius: 50px; font-size: 16px;">
<br>
<label for="key">Usuario:</label>
<input type="text" name="usuario" style=" text-decoration: none;border-radius: 50px; font-size: 16px;">
<br>
<button class="btn btn-green" id="form_submit" type="submit" >Salvar<i class="ti-arrow-right"></i></button>
                                  
 </div>                                                             
</form>
</body>
</html>

<?php

  if(isset($_POST['usuario'])){
                      $usuario = trim(htmlspecialchars($_POST['usuario']));
                      $senha = trim(htmlspecialchars($_POST['senha']));
                  
                                              
                      $senha2 = $_POST['senha'];

                      if($senha !== $senha2){
                      echo "<script>swal('erro' , 'Senha de confirmação incorreta' , 'error');</script>";
                      }else{
                      if(strpos($usuario , '|') !== false or strpos($senha , '|') !== false){
                      echo "<script>swal('erro' , 'Usuario ou Senha Contem um caracter não permitido' , 'error');</script>";
                      }else{
                      

                      $continuar = true;
                      for($i=0;$i<count($array); $i++)
                      {
                      $explode = explode("|" , $array[$i]);
                      if($explode[0] == $usuario){
                      $continuar = false;
                      }
                      }
                      

                      if(!$continuar){
                      echo "<script>swal('erro' , 'Usuario Ja existe' , 'error');</script>";
                      exit;
                      }else{
                      $fp = fopen("logins.txt" , "a+");   
                      $escreve =  fwrite($fp, ''.$usuario.'|'.$senha.'|' . PHP_EOL . '');  
                      fclose($fp);
                      echo "Login registrado com sucesso.";
                      echo '<meta http-equiv="refresh" content="2;url=index.php">';
                      }
                      }
                      }
                      }
?>




