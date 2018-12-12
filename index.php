<?php
/*Thiago Schoeninger
10/11/2018*/
header("Content-Type: text/html; charset=ISO-8859-1",true) ;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-quiv="content-Type" content="text/html"; charset=iso-8859-1>
        <link rel="icon" href="img/senacLogo.png">
        <title>MySQL para SQL Server</title>
        <link rel='stylesheet' href="../css/reset.css">
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
        <body>
            <div id="container">
 				<div class='topo'>
                	<div class='imgTopo'>
               			<img style='height:100%;' src="img/senac.png">
                    </div>
                    <div class='fraseTopo'>    
                		<span>Preencha os campos a seguir para fazer a transferência</span>
                    </div>
                </div>
                	<div class='geral'>
                    	<div class='caixa'>
                        	<div class='tituloCaixa'>
                            	<span>Insira aqui os dados do banco de dados MySQL para a transferência</span>
                            </div>
                            <div class='dados'>
                            	<form action='dadosMySQL.php' method='POST' class='formMySQL'>
 									<div class='dado'><span>URL</span><input type='text' name='url'></div>
									<div class='dado'><span>User</span><input type='text' name='user'></div>
                                    <div class='dado'><span>Password</span><input type='text' name='password'></div>
                                    <div class='dado'><span>Nome da DB</span><input type='text' name='dbNome'></div>
                                    <input class='btnOk' type='submit' value='OK'>
            					</form>
                            </div>
                        </div>
                    </div>
            </div>
        </body> 
</html>
