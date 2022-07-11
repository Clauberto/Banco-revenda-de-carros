<?php
// conectar com servidor e o banco de dados
$conectar = mysql_connect('localhost','root','') ;
$banco    = mysql_select_db("revenda3137");

$codigo    = $_POST['codmodelo'];
$nome      = $_POST['nome'];
$marca     = $_POST['codmarca'];


// se o botao CADASTRAR foi escolhido
if (isset($_POST['cadastrar']))
{

$sql = mysql_query("insert into modelo (codmodelo,nome,codmarca)
                               values ('$codigo','$nome', '$marca')");

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Falha ao gravar dados informados";  }
else
{  echo "Dados cadastrados com sucesso"; }

}


// se o botao EXCLUIR foi escolhido
if (isset($_POST['excluir']))
{

$sql = mysql_query("delete from modelo where codmodelo = $codigo");
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

$sql = mysql_query("update modelo set nome='$nome'
                    where codmodelo = $codigo");
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
	$sql = mysql_query("select codmodelo,nome,codmarca from modelo");
	if (mysql_num_rows($sql) == 0)
		{ echo "Desculpe, mas sua pesquisa nao retornou resultados ";
		}	
	else
		{
		echo "Resultado da Pesquisa dos Modelos : "."<br>";
			while($resultado = mysql_fetch_array($sql))
			{
			echo "Codigo            : ".utf8_encode($resultado['codmodelo'])."<br>".
                 "Nome              : ".utf8_encode($resultado['nome'])."<br>".
                 "Codigo Marca      : ".utf8_encode($resultado['codmarca'])."<br>"."<br>"."<br><br>";
			}
		}
}


?>

