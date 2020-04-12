<?PHP
    require('database/ac_db.inc.php');

     function cabecalho() {
        $ano = date('Y');
        $mes = rtrim(strtolower(nomemes(date('m'))));
        $dia = date('d');
        $diasemana = rtrim(nomediasemana(date('w')+1));

        echo "Rio de Janeiro - " . $diasemana . ", " . $dia . " de " . $mes . " de " . $ano . ". ";
        
        $login = $_SESSION['user'];
        if ($login != "") {
            $nome = str_replace("@CEDAE.CORP","",$login);
            $nome = ucwords($nome);

            echo " Bem-vindo(a) <strong>" . $nome . "</strong>"; 
        }         
     }

    function nomemes($nummes)
    {
        $aux = 'Janeiro  FevereiroMarço    Abril    Maio     Junho    Julho    Agosto   Setembro Outubro  Novembro Dezembro ';
        $ind = ($nummes - 1) * 9;

        return( substr( $aux, $ind, 9 ));
    }
    function nomediasemana($numdiasemana)
    {
        $aux = 'Domingo      Segunda-feiraTerça-feira  Quarta-feira Quinta-feira Sexta-feira  Sábado       ';
        $ind = ($numdiasemana - 1) * 13;
        
        return( substr( $aux, $ind, 13 ));
    }

    function doublequotes($string){
        $string = "\"".$string."\"";
        
        return $string;
    }
    function padronizanome($nome){
        $arraynome = explode(" ",$nome);
        if (sizeof($arraynome) === 1){
            $nome = $nome." CEDAE";
        }

        return $nome;
    }
    function split_name($name) {
        $arrname = list($first_name, $last_name) = explode(' ', $name, 2);
        $last_name = $arrname[1];
        $first_name = $arrname[0];
        return array($first_name, $last_name);
    }

    function retornaGestores() {
        $db = new \Oracle\Db("Lista Usuários","infra");
        $sql ="select NAME,SAMACCOUNTNAME from infra.view_ad_sisrhu where cargoconf <> 0 order by 1";
        $res = $db->execFetchAll($sql, "Consulta");

        return $res;
    }
    function retornaMailGestor($username){
        $db = new \Oracle\Db("Verifica Chefia","infra");
        $sql ="select MAIL from infra.view_ad where samaccountname = "."'".$username."'";
        $res = $db->execFetchArray($sql, "Consulta");

        return $res["MAIL"];
    }
    function enviaEmail($email,$manager){

        $mailgestor = retornaMailGestor($manager);
        $destinatario  = "infra@cedae.com.br,".$mailgestor;
        $assunto = "E-mail institucional criado - ".$email;
        $password = "cedae#4455";
        $corpo = '	
        <html>
            <head>
                <title>E-mail institucional</title>
            </head>
            <body>
                <p><b>Prezado(a)</b> <br>
                Este é um e-mail automático, segue os dados para utilização.<br><br>
                Login			: <b>'.$email.'</b> <br>
                Senha			: <b>'.$password.'</b> <br><br>
    
                Clique <a href="https://seguro.cedae.com.br/trocasenha">aqui</a> para realizar a troca da senha, que deve seguir os critérios relacionados abaixo.<BR><BR>
    
                A senha deverá possuir 8 dígitos, divergir das três últimas (histórico de senha) e contemplar caracteres de três destas quatro categorias abaixo:<BR>
                <ol>
                    <li>Maiúsculos (A-Z)</li>
                    <li>Minúsculos (a-z)</li>
                    <li>Dígitos de base 10 (0 a 9)</li>
                    <li>Não alfabéticos (por exemplo, !, $, #, %)</li>
                </ol>
                 </p>
                 <br><br>
                 <img src="https://seguro.cedae.com.br/images/trocasenha.png" alt="Trocar a Senha">
            </body>
        </html>
    ';
        //para o envio em formato HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html;charset=iso-8859-1\r\n";
        //endereï¿½o do remetente
        $headers .= "FROM : Infraestrutura <infraestrutura@cedae.com.br>";
        mail($destinatario,$assunto,$corpo,$headers);

    }    

?>