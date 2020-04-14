<?PHP 
    require 'funcoes/app.php';

    session_start(); 
    If (!$_SESSION['vc']){
        echo "<script>top.location.href='auth.php';</script>";
    }
?>

<html>
    <script type="text/javascript" src="funcoes/app.js"></script>
	<body onLoad="showtime()">
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/app.css">
        <div id="content_A">			
        <div id="content_Date_Big">
            <div class="contentPanel_Date_Big">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="left">
                            <label><?PHP cabecalho(); ?></label>
                        </td>
                        <td align="left">
                            <form action="#" id="frmRelogio">
                                    <input type="text" id="txtRelogio" class="contentPanel_Date_TextareaClock" size="9"
                                    readonly="readonly" disabled="disabled"/>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
		<div class="contentPanel_01_Middle">
		<!-- a DIV contentPanel refere-se ao painel azul com borda que marca o conteudo -->
		    <h2>Cadastro<br/><br/>
		    <sup>Orgão Responsável: ATI-3.2 Telefone/Ramal: 233<u>2-1349</u></sup></h2>
			<div class="story">
				<p>
                <title>Infraestrutura</title>
                <form id="form" name="form" action="process.php" method="post">
                    <table id="esmaecer1" style="font-size: 0.8em; padding-left: 15px; background-image: url(images/fundo_form_NovoMail.jpg);" width="100%" 
                        border="0" cellpadding="0" cellspacing="0">
                        <tr>
                                <td colspan="2"><br>
                                    <h1><b><font size=4>Entre com os dados:</font></b></h1><br>
                                    <br>
                                </td>
                        </tr>
                        <tr><td><br><br></td></tr>
                        <tr>
                            <td><h1>Login da conta Institucional</td>	
                        </tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td height="12"><input type="text" maxlength="60" name="usuario" id="usuario" size="60" placeholder="garagem" required></td>
                        </tr>
                        <tr><td><br><br></td></tr>
                        <tr>
                            <td><h1>Login do Gerente</td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td>
                                <select class="inputbox" name="manager" id="manager">
                                    <option value="">---selecione---</option>

                                    <?php
                                        $gestores = retornaGestores();
                                        foreach ($gestores as $row) {
                                                printf("<option value=".$row['SAMACCOUNTNAME'].">".$row['NAME']."</option>\n");
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td><br><br></td></tr>
                        <tr>
                            <td><h1>Nome Completo da conta Institucional</td>	
                        </tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td height="12"><input type="text" maxlength="60" name="nome" id="nome" size="60" placeholder="Garagem da CEDAE"></td>
                        </tr>
                        <tr><td><br><br></td></tr>
                        <tr>
                            <td><h1>E-mail da conta Institucional</td>	
                        </tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td height="12"><input type="email" maxlength="60" name="email" id="email" size="60" placeholder="garagem@cedae.com.br"></td>
                        </tr>
                        <tr><td><br><br></td></tr>
                        <tr>
                            <td colspan="3" align="center"><br>
                            <input type="submit" value="  Cadastrar " id="myButton2" name="submit2" class="button" onclick="return validate();">
                            <br><br>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
   </body>
</html>