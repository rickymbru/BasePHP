<?PHP 
    require 'funcoes/app.php';

    session_start(); 
    If (!$_SESSION['vc']){
        echo "<script>alert('Acesso não autorizado');top.location.href='/';</script>";
    }

    $nome="\"".$_POST['nome']."\"";
    $usuario="\"".$_POST['usuario']."\"";
    $email="\"".$_POST['email']."\"";
    $manager="\"".$_POST['manager']."\"";

    $comando =  escapeshellcmd('python scripts/app.py '.$nome.' '.$usuario.' '.$email.' '.$manager);
    echo $comando;
    $output = shell_exec($comando);
?>