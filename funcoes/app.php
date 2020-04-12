<?PHP
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

?>