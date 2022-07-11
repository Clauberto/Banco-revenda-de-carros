<?php
// conectar com servidor e o banco de dados
$conectar = mysql_connect('localhost','root','') ;
$banco    = mysql_select_db("revenda3137");

$foto = $_FILES["foto"];
$pasta_dir = "fotos/";

if (!file_exists($pasta_dir)) {
	mkdir($pasta_dir);
}

$foto_nome = $pasta_dir.$foto["name"];

move_uploaded_file($foto["tmp_name"],$foto_nome);

// se o botao CADASTRAR foi escolhido
if (isset($_POST['cadastrar']))
{
$codigo     = $_POST['codigo'];
$nome       = $_POST['nome'];
$login      = $_POST['login'];
$senha      = md5($_POST['senha']);

$sql = mysql_query("insert into usuario (codigo,nome,login,senha, foto)
                               values ('$codigo','$nome','$login','$senha', '$foto_nome')");

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Falha ao gravar dados informados";  }
else
{  echo "Dados cadastrados com sucesso"; }

}


// se o botao EXCLUIR foi escolhido
if (isset($_POST['excluir']))
{
$codigo     = $_POST['codigo'];
$nome       = $_POST['nome'];
$login      = $_POST['login'];
$senha      = $_POST['senha'];

$sql = mysql_query("delete from usuario where codigo = $codigo");
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
$codigo     = $_POST['codigo'];
$nome       = $_POST['nome'];
$login      = $_POST['login'];
$senha      = $_POST['senha'];

$sql = mysql_query("update usuario set senha='$senha'
                    where codigo = $codigo");
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
	$sql = mysql_query("select codigo,nome,login,senha,foto from usuario");
	if (mysql_num_rows($sql) == 0)
		{ echo "Desculpe, mas sua pesquisa nao retornou resultados ";
		}	
	else
		{
		echo "Resultado da Pesquisa dos Usuario : "."<br>";
			while($resultado = mysql_fetch_array($sql))
			{
			echo "Codigo            : ".utf8_encode($resultado['codigo'])."<br>".
                 "Nome              : ".utf8_encode($resultado['nome'])."<br>".
                 "Login             : ".utf8_encode($resultado['login'])."<br>".
                 "Senha             : ".utf8_encode($resultado['senha'])."<br><br>";
			echo "<img src=".$resultado['foto']." width=150 height=150>"."<br><br>";
			}
		}
}


?>

