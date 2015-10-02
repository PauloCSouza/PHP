<?php

include 'conexao.php';

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>

    <style type="text/css">
        @import url(css/main);
    </style>

    <script type="text/javascript">

        function verificaCombo(id){
            if(document.getElementById(id).value == "0"){
                document.getElementById("btnFiltrar").disabled = true;
            } else {
                document.getElementById("btnFiltrar").disabled = false;
            }
        }

    </script>

</head>
<body>
<div id="cadastro">
    <fieldset>
        <legend>Listar News</legend>

        <form method="GET" action="listar.php">
            <b>By Autor</b>
            <select name="cbAutores" id="cbAutores" onchange="verificaCombo(this.id);">
                <option value="0">-- Selecione --</option>

                <?php

                if(isset($_GET["cbAutores"])){

                    $idAutor = $GET["cbAutores"];

                } else {

                    $idAutor = "0";

                }

                $SQL = "SELECT * FROM autor ORDER BY nome ASC";
                $query = mysqli_query($conn, $SQL);
                while($exibir = mysqli_fetch_array($query)){

                    ?>

                    <option value="<?php echo $exibir["id"];?>" <?PHP echo ($exibir["id"] == $idAutor) ? "selected='selected'" : "" ?>><?php echo $exibir["nome"];?></option>

                    <?php
                }
                ?>

            </select>
            <input type="submit" value="Filtrar" disabled="disabled" id="btnFiltrar"/>
        </form>

        <ul>
            <?php

            $SQL = "SELECT news.*, autor.nome, date_format(news.data, '%d/%m/%y') as data_pt FROM news INNER JOIN autor on autor.id = news.autor";

            if(isset($_GET["cbAutores"])){

                if(is_numeric($_GET["cbAutores"])){

                    $SQL .= " WHERE autor =".$_GET["cbAutores"];

                }
            }

            $query = mysqli_query($conn, $SQL);

            if(mysqli_num_rows($query) <= 0){
                echo "<li>Não existe nenhuma News.</li>";
            }

            while($exibir = mysqli_fetch_array($query)){

                ?>

                <li><?php echo $exibir["data_pt"]?> - <?php echo $exibir["titulo"]?> - Por <b><?php echo $exibir["nome"]?></b> - <a href="view.php?id=<?php echo $exibir["id"]?>">[Veja +]</a></li>

                <?php
            }
            ?>
        </ul>

    </fieldset>
</div>
</body>
</html>
