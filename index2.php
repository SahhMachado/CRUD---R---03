<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Lista de Carros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <style>
        .ap{
            color: blue;
        }
        .rp{
            color: red;
        }
    </style>
</head>
<body>
    <form method="post">
    <fieldset>
        <legend>Procurar Carro</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table>
	    <tr>
            <td><b>Id </b></td>
            <td><b>Nome </b></td>
            <td><b>valor </b></td>
            <td><b>km </b></td>
            <td><b>Data de Fabricação </b></td>
            <td><b>Anos de Uso </b></td>
            <td><b>Média km/por ano </b></td>
            <td><b>Valor de Revenda </b></td>
        </tr>
        <?php $consulta = ""; ?>
        <input type="radio" id="1" name="consulta" value="1">Nome<br>
        <input type="radio" id="2" name="consulta" value="2">Valor<br>
        <input type="radio" id="3" name="consulta" value="3">Km<br>
        <?php
            $pdo = Conexao::getInstance();
            if ($consulta == 1) {
                $consulta = $pdo->query("SELECT * FROM carro 
                WHERE nome LIKE '$procurar%' 
                ORDER BY nome");  

            }elseif ($consulta == 2) {
                $consulta = $pdo->query("SELECT * FROM carro 
                WHERE valor LIKE '$procurar%' 
                ORDER BY valor<="); 
                 
            }else{
                $consulta == $pdo->query("SELECT * FROM carro 
                WHERE km LIKE '$procurar%' 
                ORDER BY km<="); 
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
               

            $hoje = date("Y");
            $df = date("Y", strtotime($linha['dataFabricacao']));
            
            $uso = $hoje - $df;
            if ($uso > 10) {
                
            }
        ?>
	    <tr>
            <td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['valor'];?></td>
            <td><?php echo $linha['km'];?></td>
            <td><?php echo date("d/m/y", strtotime($linha['dataFabricacao']));?></td>
            <td><?php echo $uso ?></td>
	    </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>
