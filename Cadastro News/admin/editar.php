<?php
include '../conexao.php';


if(isset($_POST["txtTitulo"])){

    $titulo = $_POST["txtTitulo"];
    $fonte = $_POST["txtFonte"];
    $data = $_POST["txtData"];
    $autor = $_POST["cbAutores"];
    $conteudo = $_POST["txtConteudo"];

    if( ($titulo == "") || ($fonte == "") || ($data == "") || ($autor == "0") || ($conteudo == "")){

        echo 'preencha as informações corretamente.';
        exit;

    } else {

        $SQL = "UPDATE news SET titulo = '".$titulo."', fonte = '".$fonte."', data = '".$data."', autor = ".$autor.", conteudo = '".$conteudo."' WHERE id = ".$_GET["id"];
        $query = mysqli_query($conn, $SQL);

        if(mysqli_affected_rows($conn) > 0){

            echo "<script>alert('News atualizada com sucesso');</script>";
            echo "<script>window.location = 'listar.php';</script>";

        } else {

            echo "<script>alert('Erro ao atualizar a news');</script>";
            echo "<script>window.location = 'listar.php';</script>";

        }
    }
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>

    <style type="text/css">
        @import url(../css/main);
    </style>

    <script type="text/javascript">
        function validar(){

            var msg = "************* AVISO *************\n Preencha os seguintes campos:\n**********************************\n";

            if(document.getElementById("titulo").value.length <= 0){
                msg += "Campo Título.\n";
            }

            if(document.getElementById("fonte").value.length <= 0){
                msg += "Campo Fonte.\n";
            }

            if(document.getElementById("cbAutores").value == "0"){
                msg += "Selecione o Autor.\n";
            }

            if(document.getElementById("conteudo").value.length <= 0){
                msg += "Campo Conteúdo.\n";
            }

            if(msg != "************* AVISO *************\n Preencha os seguintes campos:\n**********************************\n"){
                alert(msg);
                return false;
            }

        }
    </script>
</head>
<body>

<?php

//Busca dados e atribui ao formulário
if(isset($_GET["id"])){

    if(is_numeric($_GET["id"])){

        $SQL = "SELECT * FROM news WHERE id = ".$_GET["id"];
        $executa = mysqli_query($conn, $SQL);
        $resultado = mysqli_fetch_array($executa);

        ?>

        <div id="cadastro">
            <fieldset>
                <legend>Editar News</legend>

                <form name="frm_cadastro" method="POST" action="editar.php?id=<?php echo $_GET["id"];?>" onsubmit="return validar();">

                    <label for="titulo">Título: </label>
                    <br/>
                    <input type="text" name="txtTitulo" id="titulo" size="95" value="<?php echo $resultado["titulo"] ?>">
                    <br/>
                    <label for="fonte">Fonte: </label>
                    <br/>
                    <input type="text" name="txtFonte" id="fonte" size="95" value="<?php echo $resultado["fonte"] ?>">
                    <br/>
                    <label for="data">Data da Publicação: </label>
                    <br/>
                    <input type="date" name="txtData" id="data" size="15" maxlength='10' value="<?php echo $resultado["data"]; ?>">
                    <br/>
                    <label for="cbAutores">Autor: </label>
                    <br/>
                    <select name="cbAutores" id="cbAutores" value="<?php echo $resultado["autor"] ?>">
                        <option value="0">-- Selecione --</option>
                        <?php

                        $SQL = "SELECT * FROM autor ORDER BY nome ASC";
                        $query = mysqli_query($conn, $SQL);
                        while($exibir = mysqli_fetch_array($query)){

                    ?>

                        <option value="<?php echo $exibir["id"];?>" <?php echo ($resultado["autor"] == $exibir["id"]) ? "selected='selected'" : "" ?> "><?php echo $exibir["nome"];?></option>

                    <?php
                        }
                        ?>
                    </select>
                    <br/>
                    <label for="conteudo">Conteúdo: </label>
                    <br/>
                    <textarea type="text" name="txtConteudo" id="conteudo" rows="10" cols="90" ><?php echo $resultado["conteudo"] ?></textarea>
                    <br/>
                    <br/>
                    <input type="submit" value="Atualizar"/>
                    <input type="reset" value="Resetar"/>

                </form>
            </fieldset>
        </div>
        <?php
    }
}
?>
</body>
</html>
