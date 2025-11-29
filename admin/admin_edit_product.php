<?php
include __DIR__.'/../DBController.php';

$db = new DBController();

$error ='';

if(!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $name = htmlentities($_POST['nume'], ENT_QUOTES, 'UTF-8');
            $code = htmlentities($_POST['code'], ENT_QUOTES, 'UTF-8');
            $image = htmlentities($_POST['imagine'], ENT_QUOTES, 'UTF-8');
            $price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES, 'UTF-8');
            $categorie = htmlentities($_POST['categorie'], ENT_QUOTES, 'UTF-8');

            if ($name == '' || $code == '' || $image == '' || $price == '' || $descriere == '' || $categorie == '') {
                echo "<div> ERROR: Completati campurile obligatorii </div>";
            }else{
                try {
                    $db->updateDB("UPDATE product 
                                    SET name=?, code=?, image=?, price=?, descriere=?, categorie=? 
                                    WHERE id=?", [$name,$code,$image, $price, $descriere, $categorie]);
                }catch (PDOException $e){
                    echo "ERROR: nu se poate executa update." . htmlspecialchars($e->getMessage());
                }
            }
        }else{
            echo "ID incorect";
        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DYD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title> <?php if(!empty($_GET['id'])){echo "Modificare inregistrare";}?> </title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8" />
</head>
<body>
<h1> <?php if(!empty($_GET['id'])) {echo "Modificare Inregistrare";}?> </h1>
<?php if($error!=''){
echo "<div style='padding:4px; border:1px solid red; color:red'> . $error.</div>";}?>

<form action="" method='post'>
    <div>
        <?php if(!empty($_GET['id'])){ ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']);?>" />
            <p>ID: <?php echo htmlspecialchars($_GET['id']); ?></p>

        <?php
        $rows = $db->getDBResult("SELECT * FROM product WHERE id=?", [$_GET['id']]);
        if(!empty($rows)){
            $row = $rows[0];?>

            <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo htmlspecialchars($row['name']); ?>"/><br/>
            <strong>Code: </strong> <input type="text" name="code" value="<?php echo htmlspecialchars($row['code']); ?>"/><br/>
            <strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo htmlspecialchars($row['image']); ?>"/><br/>
            <strong>Pret: </strong> <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>"/><br/>
            <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo htmlspecialchars($row['descriere']); ?>"/><br/>
            <strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo htmlspecialchars($row['categorie']); ?>"/><br/>

        <?php
        }else{
            echo"<div>Nu s-au gasit inregistrari.</div>";
            }
        ?>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
        <?php } ?>
    </div>
</form>
</body>
</html>