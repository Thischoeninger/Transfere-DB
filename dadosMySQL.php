<?php 
$url = $_POST['url'];
$user = $_POST['user'];
$password = $_POST['password'];
$db = $_POST['dbNome'];

$conn = mysqli_connect($url,$user,$password);
$okdb = mysqli_select_db($conn,$db);
if(!$okdb){
	die('Problemas ao solucionar a base de dados!!!');
}
$sql ='show tables';
$res = mysqli_query($conn,$sql) or die(mysqli_error());
$contadorTabela = 0;

while ($row1 = $res->fetch_row()) {
		$colunas= mysqli_query($conn,'describe '.$row1[0]) or die(mysqli_error());
		$contadorColuna = 0;
		mysqli_query($conn,'CREATE DATABASE '.$db.'2;'); //Cria base de dados
		
		while ($row2 = $colunas->fetch_row()) {
			$linhas = mysqli_query($conn,'SELECT '.$row2[0].' FROM '.$row1[0]) or die(mysqli_error());
			$contadorLinha = 0;
			/*iformações sobre o array $coluna[tabela][coluna atual][0=nome]
																    [1=tipo]
			                                                        [2=key]
			                                                        [3=extra]*/
			$coluna[$contadorTabela][$contadorColuna][0] = $row2[0];
			$coluna[$contadorTabela][$contadorColuna][1] = $row2[1];
			$coluna[$contadorTabela][$contadorColuna][2] = $row2[3];
			$coluna[$contadorTabela][$contadorColuna][3] = $row2[5];
			
			mysqli_select_db($conn,$db.'2');
			mysqli_query($conn,'CREATE TABLE '.$row1[0].'(id INT(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (id));'); //Cria a tabela e a primeira coluna		    
			mysqli_query($conn,'ALTER TABLE '.$row1[0].' ADD '.$coluna[$contadorTabela][$contadorColuna][0].' '.$coluna[$contadorTabela][$contadorColuna][1].';'); 
			//Insere as outras colunas			
			mysqli_select_db($conn,$db);					
			
			while ($row3 = $linhas->fetch_row()) {
				$linha[$contadorTabela][$contadorColuna][$contadorLinha] = $row3[0];
				$contadorLinha++;
			}
			$contadorColuna++;
		}
		$numColunas = mysqli_num_rows(mysqli_query($conn,'DESCRIBE '.$row1[0]));
		$numLinhas = mysqli_num_rows(mysqli_query($conn,'SELECT * FROM '.$row1[0]));
		$colunasNomes = "";
		$linhaValores = "";
		mysqli_select_db($conn,$db.'2');
		
		for($contColunas=1;$contColunas<$numColunas;$contColunas++){
			$colunasNomes .= $coluna[$contadorTabela][$contColunas][0];
				if($contColunas == $numColunas -2){
					$colunasNomes .= ',';
				}
		}
		
		for($contLinhas=0;$contLinhas<$numLinhas;$contLinhas++){
		    $linhaValores = "";
			for($contColunas=1;$contColunas<$numColunas;$contColunas++){
				if(is_string($linha[$contadorTabela][$contColunas][$contLinhas])){
					$linhaValores .= "'".$linha[$contadorTabela][$contColunas][$contLinhas]."'";
				} else {
					$linhaValores .= $linha[$contadorTabela][$contColunas][$contLinhas];
				}
				if($contColunas == $numColunas -2){
					$linhaValores .= ',';
				}
			}
			echo $row1[0].'<br>';
			echo $colunasNomes.'<br>';
			echo $linhaValores.'<br>';
			mysqli_query($conn,"INSERT INTO ".$row1[0]." (".$colunasNomes.") VALUES (".$linhaValores.") ") or die(mysqli_error());
		}
		mysqli_select_db($conn,$db);
		$contadorTabela++;
    }
mysqli_close($conn);

?>