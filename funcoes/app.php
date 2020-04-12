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

?>