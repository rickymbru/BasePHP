<?PHP 
    require 'funcoes/app.php';

    session_start(); 
    If (!$_SESSION['vc']){
        echo "<script>alert('Acesso não autorizado');top.location.href='/';</script>";
    }
    if (empty($_POST)){
        echo "<script>alert('Formulário não preenchido');top.location.href='form.php';</script>";
    }
 
    $nomecompleto=$_POST['nome'];
    $usuario=$_POST['usuario'];
    $email=$_POST['email'];
    $manager=$_POST['manager'];

    if ( empty( $nomecompleto ) ) {
        $nomecompleto = $usuario;
    }
    if ( empty($email) ) {
        $email = $usuario."@cedae.com.br";
    }

    $nomecompleto = padronizanome($nomecompleto);
    $arrnomecompleto = split_name($nomecompleto);

    enviaEmail($email,$manager);

    $nomecompleto = doublequotes($nomecompleto);
    $usuario = doublequotes($usuario);
    $email = doublequotes($email);
    $manager = doublequotes($manager);
    $nome = doublequotes($arrnomecompleto[0]);
    $sobrenome = doublequotes($arrnomecompleto[1]);

    $comando =  escapeshellcmd('python scripts/app.py '.$nomecompleto.' '.$usuario.' '.$email.' '.$manager.' '.$nome.' '.$sobrenome);
    $output = shell_exec($comando);
    echo "<script>alert('Processo concluido, verifique se a conta ".$email." foi criada corretamente');top.location.href='form.php';</script>";
    
?>