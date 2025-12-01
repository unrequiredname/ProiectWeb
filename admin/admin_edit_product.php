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
                    $product = $db->updateDB("UPDATE product 
                                    SET name=?, code=?, image=?, price=?, descriere=?, categorie=? 
                                    WHERE id=?", [$name, $code, $image, $price, $descriere, $categorie, $id]);
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

        <?php
        $rows = $db->getDBResult("SELECT * FROM product WHERE id=?", [$_GET['id']]);

        if(!empty($rows)){
            $row = $rows[0];?>
        <?php
        }else{
            echo"<div>Nu s-au gasit inregistrari.</div>";
        }
        ?>
            <!DOCTYPE html>
            <html lang="ro">
            <head>
                <meta charset="UTF-8">
                <title>Modificare înregistrare</title>
                <link rel="stylesheet" href="../CSS/interfataAdmin.css">
            </head>
            <body>

            <div class="admin-header">
                <h2>🛠️ Panou Admin</h2>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="Vizualizare.php">Produse</a>
                    <a href="admin_add_product.php">Adauga un produs nou</a>
                    <?php if(!isset($_SESSION['member_id'])) {?>
                        <a href="login_admin.php">Logout</a>
                    <?php }else{?>
                        <a href="logout_admin.php">Logout</a>
                    <?php }?>
                </nav>
            </div>

            <div class="admin-container">

                <h1 class="admin-title">Modificare înregistrare</h1>

                <?php if ($error !== ''){ ?>
                    <div class="admin-error"><?= htmlspecialchars($error) ?></div>
                <?php } ?>

                <?php if (!empty($_GET['id'])){ ?>
                    <?php
                    $rows = $db->getDBResult("SELECT * FROM product WHERE id=?", [$_GET['id']]);
                    ?>
                    <?php if (!empty($rows)){
                        $row = $rows[0];
                    } ?>
                        <form action="" method="post" class="admin-form">

                            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">

                            <label>ID produs:</label>
                            <div class="admin-id-box"><?= htmlspecialchars($_GET['id']) ?></div>

                            <label for="nume">Nume produs:</label>
                            <input type="text" id="nume" name="nume"
                                   value="<?= htmlspecialchars($row['name']) ?>">

                            <label for="code">Cod produs:</label>
                            <input type="text" id="code" name="code"
                                   value="<?= htmlspecialchars($row['code']) ?>">

                            <label for="imagine">Imagine (link):</label>
                            <input type="text" id="imagine" name="imagine"
                                   value="<?= htmlspecialchars($row['image']) ?>">

                            <label for="price">Preț:</label>
                            <input type="text" id="price" name="price"
                                   value="<?= htmlspecialchars($row['price']) ?>">

                            <label for="descriere">Descriere:</label>
                            <input type="text" id="descriere" name="descriere"
                                   value="<?= htmlspecialchars($row['descriere']) ?>">

                            <label for="categorie">Categorie:</label>
                            <input type="text" id="categorie" name="categorie"
                                   value="<?= htmlspecialchars($row['categorie']) ?>">

                            <button type="submit" name="submit" class="admin-submit">
                                Salvează modificările
                            </button>
                        </form>

                    <?php }else{ ?>
                        <div class="admin-error">Nu s-au găsit înregistrări pentru acest ID.</div>
                    <?php }  ?>

                <div class="admin-links">
                    <a href="Vizualizare.php">Înapoi la listă produse</a>
                    <a href="index.php">Înapoi la Home</a>
                </div>
            </div>
            </body>
</html>
