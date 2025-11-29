<?php
include __DIR__.'/../DBController.php';
$error ='';

$db = new DBController();

if(isset($_POST['submit'])){
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $code = htmlentities($_POST['code'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
    $price = htmlentities($_POST['price'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);

    if($nume=='' || $code=='' || $imagine=='' || $price=='' || $descriere=='' || $categorie==''){
        $error='ERROR: Campuri goale!';
    }else{
        try{
            $db->updateDB("INSERT INTO product(name, code, image, price, descriere, categorie) 
                            VALUES (?, ?, ?, ?, ?, ?)", [$nume, $code, $imagine, $price, $descriere, $categorie]);

            header('Location: Vizualizare.php');
            exit;
        }catch(PDOException $e){
            echo "ERROR: Nu se poate executa insert. " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title> <?php echo "INSERARE INREGISTRARE;" ?> </title>
    <meta http-equiv="Content-Type" content ="text/html; charset=utf-8"/>
</head>

<body>
<h1> <?php echo"Inserare inregistrare"; ?> </h1>
<?php if ($error!=''){
    echo "<div style='padding:4px; border:1px solid red; color:red;'> " . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <strong>Nume:</strong> <input type="text" name="nume" value=""/><br/>
        <strong>Cod:</strong> <input type="text" name="code" value=""/><br/>
        <strong>Imagine:</strong> <input type="text" name="imagine" value=""/><br/>
        <strong>Pret:</strong> <input type="text" name="price" value=""/><br/>
        <strong>Descriere</strong> <input type="text" name="descriere" value=""/><br/>
        <strong>Categorie</strong> <input type="text" name="categorie" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/><br/>
        <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>
