<?php

include '../conexao.php';

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

        function apagar(id, desc){

            if(window.confirm("Deseja realmente apagar este registro: " + desc + "?")){

                window.location = 'apagar.php?id=' + id;

            }
        }

    </script>

</head>
<body>
<div id="cadastro">
    <fieldset>
        <legend>Listar News</legend>

        <ul>
            <?php

            $SQL = "SELECT *, date_format(data, '%d/%m/%y') as data_pt FROM news";
            $query = mysqli_query($conn, $SQL);
            while($exibir = mysqli_fetch_array($query)){

                ?>

                <li><?php echo $exibir["data_pt"]?> - <?php echo $exibir["titulo"]?> - <a href="editar.php?id=<?php echo $exibir["id"]?>">[Editar]</a>&nbsp;<a href="#" onclick="apagar('<?php echo $exibir["id"]?>', '<?php echo $exibir["titulo"]?>');">[Apagar]</a></li>

                <?php
            }
            ?>
        </ul>

    </fieldset>
</div>
</body>
</html>
