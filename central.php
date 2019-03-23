<?php
session_start();
if($_SESSION['level'] != 10){
	header("Location: /");
}

function removeUser($id){
    $id = intval($id);
    $file = file("users.txt");
    $tempp = count($file);
    if($tempp >= $id){
        $id--;
        $gravados = 0;
        $fileO = fopen("users.txt", "w+");
        foreach ($file as $idt => $text) {

            $text = str_replace("\n", "", $text);

            if($idt != 0 && $idt != $id && $gravados != 0){
                $gravados++;
                fwrite($fileO, "\n".$text);
            }else if($idt == 0 && $idt != $id){
                $gravados++;
                fwrite($fileO, $text);
            }else if($gravados == 0 && $idt != $id){
                $gravados++;
                fwrite($fileO, $text);
            }

        }
        fclose($fileO);
    }
}

/*
//TODO:Remover usuários repetidos, remover usuários permanentemente,ban por ip, mudar level para redirecionar para compra.

    function removeUser($id){
        $id = intval($id);
        $id--;
        
        $file = file("users.txt");
        
        $tempp = count($file);

        $fileO = fopen("users.txt", "w+");
        
        foreach($file as $idt => $text){
            
            $text = str_replace("\n","", $text);

            if($id != $idt && $idt != 0 && $tempp > 1){

                fwrite($fileO, "\n".$text);
            
            }else if($id != $idt && $idt != 0){
                fwrite($fileO, $text);
            }else if($idt == 0 && $id != $idt){
            
                fwrite($fileO, $text);
            
            }
        }
        fclose($fileO);
    }
    
  */  
    function addUser($userName, $pass, $level){
        
        $userName = str_replace("|","%24",$userName);
        
        $pass = hash('sha256', $pass);
        $pass = hash('md5', $pass);
        
        $time = strtotime("now");
        if(file_exists('users.txt')){
            $filetmp= file('users.txt');
            $file = fopen('users.txt', 'a+');
            if(count($filetmp) > 0){
                fwrite($file, "\n".$userName.'|'.$pass.'|'.$time.'|'.$level);
                fclose($file);

            }else{
                fwrite($file, trim($userName.'|'.$pass.'|'.$time.'|'.$level));
                fclose($file);
            }
        }else{
            $file = fopen('users.txt', 'w+');
            fwrite($file, $userName.'|'.$pass.'|'.$time.'|'.$level);
            fclose($file);
        }
    }
    
    // TEMPORÁRIO CHECA SE TD TD...
    if((isset($_POST['userName']) && !empty($_POST['userName'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['level']) && !empty($_POST['level'])) ){
        addUser($_POST['userName'], $_POST['pass'], $_POST['level']);
    }else{
        
        /*echo "Por favor, preencha todos os campos corretamente\nPara ter certeza consulte o manual do PHP <a href='http://php.net/manual/en/function.empty.php'>aqui</a>.Obrigado.";*/
        
    }
    
    if((isset($_POST['id']) && !empty($_POST['id']))){
        removeUser($_POST['id']);
    }
    
    /*
     if((isset($_POST['userName']) && !empty($_POST['userName'])) && (isset($_POST['pass']) && !empty($_POST['pass']))){
            chkUser($_POST['userName'], $_POST['pass']);
     }else{
         
         echo "Por favor, preencha todos os campos corretamente\nPara ter certeza consulte o manual do PHP <a href='http://php.net/manual/en/function.empty.php'>aqui</a>.Obrigado.";
     }
*/
?>
<html>
<head>
<title>Admin Panel</title>
</head>

<body>
<center>
<a href="linkk">Ir para a central</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
<a href="/index.php?logout=true">Sair</a>
<h1>ADMIN PAGE ATÉ AMANHÃ</h1>
<br />
<form method=post>
<label>UserName<input type=text name="userName" placeholder="User" required /></label><br />
<label>Senha<input type=password name="pass" placeholder="Senha" required /> <br />
<label>Level<input type=number name="level" value=1 required /><br />
<input type=submit value="Adicionar Membro" />
</form>
<br />
<form method=post>
<h1>Remover membros <b style="color:green;">id</b></h1>
<br />
<label>ID<input type=number name="id" value=0 /><br />
<input type=submit value="Remover Membro" />
</form>
<br /> <br /> <br /> <br />
<h1>Lista de membros</h1><br />
<h2> Formato id,nome de usuário,senha e level</h2>
<?php
//$fileArray = array_values(array_filter($fileArray, "trim"));

function rep($array){
    return str_replace(" ", "", $array);
}

if ($file = file('../users.txt')) {
    echo "Total de Usuários:".count($file)."<br />";
    $id = 0;
    foreach($file as $value){
        $id++;
        echo $id."|".$value.'<br />';
    }
  }
unset($_POST['userName']);
unset($_POST['pass']);
unset($_POST['level']);
unset($_POST['id']);
?>
</center>
</body>
</html>