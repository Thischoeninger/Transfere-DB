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
                		<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preencha os campos a seguir para fazer a transferência</span>
                    </div>
                </div>
                	<div class='geral'>
                    	<div class='caixa'>
                        	
                            <div class='dados'>
                            	<form action='transfereDB.php' method='POST'>
                                	<div class='dado' style='margin-bottom:0px'>
                                    <span>Nome da DB</span>
                                    <input type='text' name='dbNome'>
                                    </div>
                                    <div class='tituloCaixa' style='margin-bottom:30px'>
                            			<span>Dados do banco MySQL</span>
                            		</div>
 									<div class='dado'>
                                    <span>URL</span>
                                    <input type='text' name='mysql_url'>
                                    </div>
									<div class='dado'>
                                    <span>User</span>
                                    <input type='text' name='mysql_user'>
                                    </div>
                                    <div class='dado' style='margin-bottom:5px'>
                                    <span>Password</span>
                                    <input type='text' name='mysql_password'>
                                    </div>
                                    <div class='tituloCaixa' style='margin-bottom:30px'>
                            			<span>Dados do banco Microsoft SQL Server</span>
                                    </div>
                                    <div class='dado'>
                                    <span>URL</span>
                                    <input type='text' name='sqlsrv_url'>
                                    </div>
                                    <div class='dado'>
                                    <span>User</span>
                                    <input type='text' name='sqlsrv_user'>
                                    </div>
                                    <div class='dado' style='margin-bottom:20px'>
                                    <span>Password</span>
                                    <input type='text' name='sqlsrv_password'>
                                    </div>
                                    <input class='btnOk' type='submit' value='MIGRAR'>
            					</form>
                            </div>
                        </div>
                    </div>
            </div>
        </body> 
</html>
