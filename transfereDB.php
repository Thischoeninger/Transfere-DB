<?php 
//Pega o nome da base de dados
$db = $_POST['dbNome'];

//Pega dados do MySQL
$mysql_url = $_POST['mysql_url'];
$mysql_user = $_POST['mysql_user'];
$mysql_password = $_POST['mysql_password'];

//Pega dados do SQL Server
$sqlsrv_url = $_POST['sqlsrv_url'];
$sqlsrv_user = $_POST['sqlsrv_user'];
$sqlsrv_password = $_POST['sqlsrv_password'];

//Conexão com o SQL Server
$sqlsrv_dados = array( "Database"=>$db, "UID"=>$sqlsrv_user, "PWD"=>$sqlsrv_password);
$sqlsrv_conn = sqlsrv_connect($sqlsrv_url, $sqlsrv_dados);

//Conexão com o MySQL
$mysql_conn = mysqli_connect($mysql_url,$mysql_user,$mysql_password);
$okdb = mysqli_select_db($mysql_conn,$db);

//Pega os nomes das tabelas dentro da bsae de dados
$res = mysqli_query($mysql_conn,'show tables') or die(mysqli_error());

//"While" para passar por todas as tabelas
$contadorTabela = 0;

//"While" para passar por todas as tabelas
while ($row1 = $res->fetch_row()) {
		$colunas= mysqli_query($mysql_conn,'describe '.
		$row1[0]) or die(mysqli_error());
		$contadorColuna = 0;
		
		//While para passar por todas as colunas das tabelas
		while ($row2 = $colunas->fetch_row()) {
			$linhas = mysqli_query($mysql_conn,'SELECT '.
			$row2[0].
			' FROM '.
			$row1[0]) or die(mysqli_error());
			$contadorLinha = 0;
			/*iformações sobre o array $coluna[tabela][coluna atual][0=nome]
																    [1=tipo]
																		  */
			$coluna[$contadorTabela][$contadorColuna][0] = $row2[0];
			$coluna[$contadorTabela][$contadorColuna][1] = $row2[1];
			
			//Cria a tabela e a primeira coluna
			sqlsrv_query( $sqlsrv_conn, 'CREATE TABLE '.
			$row1[0].
			' (id INT NOT NULL Identity(1,1) , PRIMARY KEY (id));'); 
				 
			//Insere as outras colunas		    		
			sqlsrv_query($sqlsrv_conn,'ALTER TABLE '.
			$row1[0].
			' ADD '.
			$coluna[$contadorTabela][$contadorColuna][0].
			' '.$coluna[$contadorTabela][$contadorColuna][1].
			';'); 				
			
			//While para passar por todas as linhas de todas as colunas e armazenar seus dados dentro de um array			
			while ($row3 = $linhas->fetch_row()) {
				$linha[$contadorTabela][$contadorColuna][$contadorLinha] = $row3[0];
				$contadorLinha++;
			}
			$contadorColuna++;
		}
		//Pega o numero de colunas da tabela
		$numColunas = mysqli_num_rows(mysqli_query($mysql_conn,'DESCRIBE '.
		$row1[0])); 
		
		//Pega o numero de linhas da tabela
		$numLinhas = mysqli_num_rows(mysqli_query($mysql_conn,'SELECT * FROM '.
		$row1[0])); 
		$colunasNomes = ""; 
		$linhaValores = "";
		
		//Faz uma string com o nome das colunas
		for($contColunas=1;$contColunas<$numColunas;$contColunas++){
			$colunasNomes .= $coluna[$contadorTabela][$contColunas][0];
				if($contColunas == $numColunas -2){
					$colunasNomes .= ',';
				}
		}
		
		//Faz uma string com os valores de cada coluna na determinada linha
		for($contLinhas=0;$contLinhas<$numLinhas;$contLinhas++){
		    $linhaValores = "";
			for($contColunas=1;$contColunas<$numColunas;$contColunas++){				
					$linhaValores .= "'".$linha[$contadorTabela][$contColunas][$contLinhas]."'";
				if($contColunas == $numColunas -2){
					$linhaValores .= ',';
				}
			}
			//Insere uma linha no banco de dados Microsoft SQL Server
			sqlsrv_query($sqlsrv_conn,"INSERT INTO ".
			$row1[0].
			" (".$colunasNomes.") 
			VALUES (".$linhaValores.") ");
		}
		$contadorTabela++;
    }
	header('Location: index.php');

?>