<?php
// conectar com servidor e o banco de dados
$conectar = mysql_connect('localhost','root','') ;
$banco    = mysql_select_db("revenda3137");

$codigo    = $_POST['codcategoria'];
$nome      = $_POST['nome'];


// se o botao CADASTRAR foi escolhido
if (isset($_POST['cadastrar']))
{

$sql = mysql_query("insert into categoria (codcategoria,nome)
                               values ('$codigo','$nome')");

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Falha ao gravar dados informados";  }
else
{  echo "Dados cadastrados com sucesso"; }

}


// se o botao EXCLUIR foi escolhido
if (isset($_POST['excluir']))
{

$sql = mysql_query("delete from categoria where codcategoria = $codigo");
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

$sql = mysql_query("update categoria set nome='$nome'
                    where codcategoria = $codigo");
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
	$sql = mysql_query("select codcategoria,nome from categoria");
	if (mysql_num_rows($sql) == 0)
		{ echo "Desculpe, mas sua pesquisa nao retornou resultados ";
		}	
	else
		{
		echo "Resultado da Pesquisa das Categorias : "."<br>";
			while($resultado = mysql_fetch_array($sql))
			{
			echo "Codigo            : ".utf8_encode($resultado['codcategoria'])."<br>".
                 "Nome              : ".utf8_encode($resultado['nome'])."<br>"."<br><br>";
			}
		}
}


?>

