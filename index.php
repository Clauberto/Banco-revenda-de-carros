<?php
// conectar com servidor e o banco de dados
$conectar = mysql_connect('localhost','root','') ;
$banco    = mysql_select_db("revenda3137");


//------- pesquisa categorias

$sql_categorias  = "SELECT * FROM categoria ";
$pega_categorias = mysql_query($sql_categorias);

//------- pesquisa marcas

$sql_marcas  = "SELECT * FROM marca ";
$pega_marcas = mysql_query($sql_marcas);

//------- pesquisa modelos
$sql_modelos  = "SELECT * FROM modelo ";
$pega_modelos = mysql_query($sql_modelos);

if(!empty($_POST['pesquisar']))
{
$categoria  = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
$marca      = (empty($_POST['marca']))? 'null' : $_POST['marca'];
$modelo     = (empty($_POST['modelo']))? 'null' : $_POST['modelo'];

if (($categoria <> 'null') and ($marca == 'null') and ($modelo == 'null'))
{
     $sql_veiculos = "SELECT automovel.descricao,automovel.cor,automovel.ano,automovel.valor, automovel.foto1
                      FROM automovel, modelo, marca, categoria
                      WHERE automovel.codmodelo = modelo.codmodelo and
                      automovel.codcategoria = categoria.codcategoria and
                      modelo.codmarca = marca.codmarca and
                      automovel.codcategoria = $categoria";
     $seleciona_veiculos = mysql_query($sql_veiculos);
}
else
{
if (($categoria <> 'null') and ($marca <> 'null') and ($modelo == 'null'))
{
     $sql_veiculos = "SELECT automovel.descricao,automovel.cor,automovel.ano,automovel.valor, automovel.foto1
                      FROM automovel, modelo, marca, categoria
                      WHERE automovel.codmodelo = modelo.codmodelo and
                      automovel.codcategoria = categoria.codcategoria and
                      modelo.codmarca = marca.codmarca and
                      automovel.codcategoria = $categoria and
                      modelo.codmarca = $marca";
     $seleciona_veiculos = mysql_query($sql_veiculos);
}
else
{
if (($categoria <> 'null') and ($marca <> 'null') and ($modelo <> 'null'))
{
       $sql_veiculos = "SELECT automovel.descricao,automovel.cor,automovel.ano,automovel.valor, automovel.foto1
                        FROM automovel, modelo, marca, categoria
                      WHERE automovel.codmodelo = modelo.codmodelo and
                      automovel.codcategoria = categoria.codcategoria and
                      modelo.codmarca = marca.codmarca and
                      automovel.codcategoria = $categoria and
                      modelo.codmarca = $marca and
                      automovel.codmodelo = $modelo";
       $seleciona_veiculos = mysql_query($sql_veiculos);
}
else
{
     $sql_veiculos = "SELECT automovel.descricao,automovel.cor,automovel.ano,automovel.valor, automovel.foto1
                      FROM automovel";
     $seleciona_veiculos = mysql_query($sql_veiculos);
}
}
}
}

?>
    <HTML>

    <HEAD>
    <meta charset="utf-8" />
        <TITLE>Revenda de carros</TITLE>
        <style type="text/css">
            .login {
                text-align:right;
            }
            body {
                background:url("bg01.png");
                padding: 0;
                margin: 0;
            }

            .letra {
                color:black;
                
            }
            #topo{
                text-align:center;
                margin: 0 auto; 
                font-family: verdana;
                text-color: #fff;  

            }
            #meio{
                text-align:center;
                margin: 0 auto;
                font-family: verdana;
                font-size: 18px;
                
            }
            #pesquisa{
                text-align:center;
                margin: 0 auto;
                
            }
            body{
                background-color:#D3D3D3;
            }
            a:link {
                color: #000;
                text-decoration: none;
            }
            a:visited {
                color: #000;
                text-decoration: none;
            }
            a:hover {
                color: #000;
                text-decoration: none;
            }
            a:active {
                color: #000;
                text-decoration: none;
            }
        </style>
    </HEAD>

    <BODY>
        <div id='topo'>
            <br>
             <h1>REVENDA DE CARROS</h1>
             <h2 class="login"> <a href="login.htm">LOGIN</a> </h2>
            <hr>
        </div>
        <div id='meio'>
        <form name="formulario" method="post" action="index.php" enctype="multipart/form-data">
            Pesquisa de automoveis
            <br>
            <br>
            <select name="categoria">
                <option value="" selected="selected">Selecione a categoria ...</option>
                <?php
                if(mysql_num_rows($pega_categorias) == 0)
                {
                    echo '<option value="0">Escolha uma categoria ... </option>';
                }
                else
                {
                while($linha = mysql_fetch_array($pega_categorias))
                {
                    echo '<option value="'.$linha['codcategoria'].'">'.utf8_encode($linha['nome']).'</option>';
                }
                }
                ?>
            </select>
            <img src="fotos\transparente.png" width="40" height="10" border="0">
            <select name="marca">
                <option value="" selected="selected">Selecione a marca ...</option>
                <?php
                if(mysql_num_rows($pega_marcas) == 0)
                {
                    echo '<option value="0"> Escolha uma marca ... </option>';
                }
                else
                {
                    while($linha = mysql_fetch_array($pega_marcas))
                    {
                        echo '<option value="'.$linha['codmarca'].'">'.utf8_encode($linha['nome']).'</option>';
                    }
                }
                ?>
            </select>
            <img src="fotos\transparente.png" width="40" height="10" border="0">
            <select name="modelo">
                <option value="" selected="selected">Selecione o modelo ...</option>
                <?php
                if(mysql_num_rows($pega_modelos) == 0)
                {
                    echo '<option value="0">Escolha um modelo ... </option>';
                }
                else
                {
                while($linha = mysql_fetch_array($pega_modelos))
                {
                    echo '<option value="'.$linha['codmodelo'].'">'.utf8_encode($linha['nome']).'</option>';
                }
                }
                ?>
            </select>
            <img src="imagens\transparente.png" width="40" height="10" border="0">
            <input type='submit' name='pesquisar' value='Pesquisar'>
        </div>
        <div id='pesquisa'>
        <?php
    if(!empty($_POST['pesquisar']))
    {
    if(mysql_num_rows($seleciona_veiculos) == 0)
    {
        echo '<h3>Sua busca nao retornou resultados ... </h3>';
    }
    else
    {
        echo '<hr>';
    echo "<Table>";
    echo '<tr>';
    while($resultado = mysql_fetch_array($seleciona_veiculos))
    {
        echo '<td> Automovel: '.utf8_encode($resultado['descricao']).'</td></tr>';
        echo '<tr><td> Cor : '.utf8_encode($resultado['cor']).'</td></tr>';
        echo '<tr><td> Ano : '.utf8_encode($resultado['ano']).'</td></tr>';
        echo '<tr><td> Valor R$: '.utf8_encode($resultado['valor']).'</td></tr>';
        echo '<tr><td> '.'<img src="'.$resultado['foto1'].'"  height="100" width="150" />'.'</td>';
        echo '</tr>';
    }
    echo "</table>";
    echo '<hr>';
    }
}
?>
        </div>
        </form>     
    </BODY>
</HTML>
