<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Lista de Carros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $cnst = isset($_POST["cnst"]) ? $_POST["cnst"] : "1";
?>
<html>
<head>
    <?php include_once "menu.php";?>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/estilo.css">
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
            <td><b>Id</b></td>
            <td><b>Nome</b></td>
            <td><b>valor</b></td>
            <td><b>km</b></td>
            <td><b>Data de Fabricação </b></td>
            <td><b>Anos de Uso </b></td>
            <td><b>Média km/por ano </b></td>
            <td><b>Valor de Revenda </b></td>
        </tr>
        <fieldset>
        <legend>Procurar por:</legend>
           <input type="radio" id="1" name="cnst" value="1" <?php if($cnst == 1) echo "checked" ?>>Nome<br>
           <input type="radio" id="2" name="cnst" value="2" <?php if($cnst == 2) echo "checked" ?>>Valor<br>
           <input type="radio" id="3" name="cnst" value="3" <?php if($cnst == 3) echo "checked" ?>>Km<br>
        </fieldset>
        <?php
            $pdo = Conexao::getInstance();

            if($cnst == 1) {
                $consulta = $pdo->query("SELECT * FROM carro
                                        WHERE nome LIKE '$procurar%' 
                                        ORDER BY nome");
    
            }else if($cnst == 2) {
                $consulta = $pdo->query("SELECT * FROM carro
                                        WHERE valor <= '$procurar%' 
                                        ORDER BY valor");  

            }else {
                $consulta = $pdo->query("SELECT * FROM carro
                                        WHERE km <= '$procurar%' 
                                        ORDER BY km");
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
            
                
            $hoje = date("Y");
            $df = date("Y", strtotime($linha['dataFabricacao']));
            
            $uso = $hoje - $df;
            $class1 = "red";
            if ($uso <= 10) {
                $uso = $hoje - $df;
                $class1 = "black";

            }
            $media = ($linha['km'])/$uso;
            $class = "red";
            if ($linha['km'] <= 100000) {
                $media = ($linha['km'])/$uso;
                $class = "black";
    
            }
        
            $revenda = $linha['valor'];
            if($linha['km'] > 100000 && $uso > 10){
                $desconto = $linha['valor'] * (20/100);
                $revenda = $linha['valor'] - $desconto;
            
            
            }else if($uso > 10 or $linha['km'] > 100000) {
                $desconto = $linha['valor'] * (10/100);
                $revenda = $linha['valor'] - $desconto;

            }
        ?>
	    <tr>
            <td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo number_format($linha['valor'], 2, ',', '.');?></td>
            <td class="<?php echo $class;?>"><?php echo number_format($linha['km'], 1, ',', '.');?></td>
            <td><?php echo date("d/m/y", strtotime($linha['dataFabricacao']));?></td>
            <td class="<?php echo $class1;?>"><?php echo $uso;?></td>
            <td><?php echo number_format($media, 0, ',', '.');?></td>
            <td><?php echo number_format($revenda, 2, ',', '.');?></td>
	    </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>
