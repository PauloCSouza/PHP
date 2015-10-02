<html>

<head>
    <meta charset="UTF-8">
    <title></title>

    <style type="text/css">
        @import url(css/main);
    </style>

</head>

<body>

<div id="view">
    <fieldset>
        <legend>News</legend>
        <?php

        include 'conexao.php';

        if(isset($_GET["id"])){

            if(is_numeric($_GET["id"])){

                $SQL = "SELECT news.*, autor.nome, date_format(news.data, '%d/%m/%y') as data_pt FROM news INNER JOIN autor on autor.id = news.autor WHERE news.id = ".$_GET["id"];
                $query = mysqli_query($conn, $SQL);
                $exibir = mysqli_fetch_array($query);

                if(mysqli_num_rows($query) > 0){

                    echo "<div id'views'>";
                    echo $exibir["titulo"];
                    echo " - Por: ".$exibir["nome"];
                    echo " - Em: ".$exibir["data_pt"];
                    echo "<div id='viewc'><br/><b>Conteúdo:</b><br/><br/>".$exibir["conteudo"]."</div>";
                    echo "<br/><b>Fonte:</b> ".$exibir["fonte"];
                    echo "</div>";

                } else {

                    echo "<b> Erro no Sistema !</b>";

                }
            }
        }
        ?>
    </fieldset>
</div>
</body>

</html>


