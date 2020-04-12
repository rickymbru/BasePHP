<?PHP 
    require 'funcoes/app.php';

    session_start(); 
    If (!$_SESSION['vc']){
        echo "<script>alert('Acesso não autorizado');top.location.href='/';</script>";
    }
    if (empty($_POST)){
        echo "<script>alert('Formulário não preenchido');top.location.href='form.php';</script>";
    }

 
    $nome=$_POST['nome'];
    $usuario=$_POST['usuario'];
    $email=$_POST['email'];
    $manager=$_POST['manager'];

    if ( empty( $nome ) ) {
        $nome = doublequotes($usuario);
    }
    if ( empty($email) ) {
        $email = doublequotes($usuario."@cedae.com.br");
    }

    $nome = doublequotes($nome);
    $usuario = doublequotes($usuario);
    $email = doublequotes($email);
    $manager = doublequotes($manager);

    $comando =  escapeshellcmd('python scripts/app.py '.$nome.' '.$usuario.' '.$email.' '.$manager);
    $output = shell_exec($comando);
    header('Location: form.php');
?>