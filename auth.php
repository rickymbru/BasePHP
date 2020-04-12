<?php

    require('database/ac_db.inc.php');
    include('env.php');
    
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    
    $host = $_SERVER['HTTP_HOST']; 
    If($host == SERVER){
		$user=USER;
	}Else{
		$user=str_replace('@CEDAE.CORP','',$_SERVER['PHP_AUTH_USER']); #Usuario Autenticado
    }
    
    $_SESSION['user'] = $user; 

    $db = new \Oracle\Db("Verifica Chefia","infra");
    $sql ="select REGISTRO,MAIL,LOTACAO,CARGOCONF from infra.view_ad_sisrhu where samaccountname = "."'".$user."'";
    $res = $db->execFetchArray($sql, "Consulta");
    
    $_SESSION['matricula'] = $res["REGISTRO"];#Matricula a partir do usuario autenticado
    $_SESSION['mailchefe'] = $res["MAIL"];#E-mail a partir do usuario autenticado
    
    If (($res["CARGOCONF"] <> 0) or ($res["LOTACAO"] == 'DDPE-7C') or ($res["LOTACAO"] == 'CDPE-7G')){
        $_SESSION['vc'] = true;
    
        header('Location: .\form.php');
    }else {
        $_SESSION['vc'] = false;
        echo "<script>alert('".$user." Acesso não autorizado');top.location.href='/';</script>";
    }

?>