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

        $SQL = "INSERT INTO news (titulo, fonte, data, autor, conteudo)";
        $SQL .= " VALUES('".$titulo."', '".$fonte."', '".$data."', ".$autor.", '".$conteudo."')";
        $query = mysqli_query($conn, $SQL);

        if(mysqli_affected_rows($conn) > 0){

            echo "<script>alert('News cadastrada com sucesso');</script>";
            echo "<script>window.location = 'listar.php';</script>";

        } else {

            echo "<script>alert('Erro ao cadastrar a news');</script>";
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
<div id="teste">
</div>
<div id="cadastro">
    <fieldset>
        <legend>Cadastro News</legend>

        <form name="frm_cadastro" method="POST" action="index.php" onsubmit="return validar();">

            <label for="titulo">Título: </label>
            <br/>
            <input type="text" name="txtTitulo" id="titulo" size="95">
            <br/>
            <label for="fonte">Fonte: </label>
            <br/>
            <input type="text" name="txtFonte" id="fonte" size="95">
            <br/>
            <label for="data">Data da Publicação: </label>
            <br/>
            <input type="date" name="txtData" id="data" size="15" maxlength='10' value="dd/mm/aaaa">
            <br/>
            <label for="cbAutores">Autor: </label>
            <br/>
            <!-- comentário -->
            <select name="cbAutores" id="cbAutores">
                <option value="0">-- Selecione --</option>
                <?php

                $SQL = "SELECT * FROM autor ORDER BY nome ASC";
                $query = mysqli_query($conn, $SQL);
                while($exibir = mysqli_fetch_array($query)){

                    ?>

                    <option value="<?php echo $exibir["id"];?>"><?php echo $exibir["nome"];?></option>

                    <?php
                }
                ?>

            </select>
            <br/>
            <label for="conteudo">Conteúdo: </label>
            <br/>
            <textarea type="text" name="txtConteudo" id="conteudo" rows="10" cols="90"></textarea>
            <br/>
            <br/>
            <input type="submit" value="Cadastrar"/>
            <input type="reset" value="Limpar"/>

        </form>
    </fieldset>
</div>
</body>
</html>
