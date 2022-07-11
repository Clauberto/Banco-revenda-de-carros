<?php
// conectar com servidor e o banco de dados
$conectar = mysql_connect('localhost','root','') ;
$banco    = mysql_select_db("revenda3137");




$codigo    		= $_POST['codautomovel'];
$descricao      = $_POST['descricao'];
$codigomodelo	= $_POST['codmodelo'];
$codigocategoria= $_POST['codcategoria'];
$ano      		= $_POST['ano'];
$cor            = $_POST['cor'];
$placa    		= $_POST['placa'];
$localizacao	= $_POST['localizacao'];
$tipocombustivel= $_POST['tipocombustivel'];
$opcionais      = $_POST['opcionais'];
$valor      	= $_POST['valor'];


// se o botao CADASTRAR foi escolhido
if (isset($_POST['cadastrar']))
{

$foto1 = $_FILES["foto1"];
$foto2 = $_FILES["foto2"];

$pasta_dir = "fotos/";

if (!file_exists($pasta_dir)) {
	mkdir($pasta_dir);
}

$foto1_nome = $pasta_dir.$foto1["name"];
$foto2_nome = $pasta_dir.$foto2["name"];

move_uploaded_file($foto1["tmp_name"],$foto1_nome);
move_uploaded_file($foto2["tmp_name"],$foto2_nome);




$sql = mysql_query("insert into automovel (codautomovel,descricao,codmodelo,codcategoria,ano,cor,placa,localizacao,tipocombustivel,opcionais,valor,foto1,foto2)
                               values ('$codigo','$descricao','$codigomodelo','$codigocategoria','$ano','$cor','$placa','$localizacao','$tipocombustivel','$opcionais','$valor','$foto1_nome','$foto2_nome')");

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Falha ao gravar dados informados";  }
else
{  echo "Dados cadastrados com sucesso"; }

}


// se o botao EXCLUIR foi escolhido
if (isset($_POST['excluir']))
{

$sql = mysql_query("delete from automovel where codautomovel = $codigo");
$resultado = mysql_query($sql);
if ($resultado)
        {
		echo "Falha ao EXCLUIR dados informados";
        }
else
	{
		echo "Dados excluidos com sucesso";
	}
}

// se o botao ALTERAR foi escolhido
if (isset($_POST['alterar']))
{
$foto1 = $_FILES["foto1"];
$foto2 = $_FILES["foto2"];

$pasta_dir = "fotos/";

if (!file_exists($pasta_dir)) {
	mkdir($pasta_dir);
}

$foto1_nome = $pasta_dir.$foto1["name"];
$foto2_nome = $pasta_dir.$foto2["name"];

move_uploaded_file($foto1["tmp_name"],$foto1_nome);
move_uploaded_file($foto2["tmp_name"],$foto2_nome);


$sql = mysql_query("update automovel set descricao='$descricao',ano='$ano',cor='$cor',placa='$placa',localizacao='$localizacao',tipocombustivel='$tipocombustivel',opcionais='$opcionais',valor='$valor',foto1='$foto1_nome',foto2='$foto2_nome'
                    where codautomovel = $codigo");
$resultado = mysql_query($sql);
if ($resultado)
        {
		echo "Falha ao ALTERAR dados informados";
        }
else
	{
		echo "Dados alterados com sucesso";
	}
}

// se o botao PESQUISAR foi escolhido
if (isset($_POST['pesquisar']))
{
	$sql = mysql_query("select codautomovel,descricao,codmodelo,codcategoria,ano,cor,placa,localizacao,tipocombustivel,opcionais,valor,foto1,foto2 from automovel");
	if (mysql_num_rows($sql) == 0)
		{ echo "Desculpe, mas sua pesquisa nao retornou resultados ";
		}	
	else
		{
		echo "Resultado da Pesquisa dos Alunos : "."<br>";
			while($resultado = mysql_fetch_array($sql))
			{
			echo "Codigo            : ".utf8_encode($resultado['codautomovel'])."<br>".
                 "Descricao         : ".utf8_encode($resultado['descricao'])."<br>".
                 "Codigo Modelo     : ".utf8_encode($resultado['codmodelo'])."<br>".
                 "Codigo Categoria  : ".utf8_encode($resultado['codcategoria'])."<br>".
                 "Ano               : ".utf8_encode($resultado['ano'])."<br>".
                 "Cor               : ".utf8_encode($resultado['cor'])."<br>".
                 "Placa             : ".utf8_encode($resultado['placa'])."<br>".
                 "Localizacao       : ".utf8_encode($resultado['localizacao'])."<br>".
				 "Tipo Combustivel  : ".utf8_encode($resultado['tipocombustivel'])."<br>".
                 "Opcionais         : ".utf8_encode($resultado['opcionais'])."<br>".
                 "Valor             : ".utf8_encode($resultado['valor'])."<br><br>";
			echo "<img src=".$resultado['foto1']." width=512 height=256>"."<br><br>";
            echo "<img src=".$resultado['foto2']." width=512 height=256>"."<br><br>";
			}
		}
}


?>

