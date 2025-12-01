<?php
include __DIR__.'/../DBController.php';

$error = '';
$db = new DBController();

if (isset($_POST['submit'])) {

    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $code = htmlentities($_POST['code'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
    $price = htmlentities($_POST['price'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);

    if ($nume == '' || $code == '' || $imagine == '' || $price == '' || $descriere == '' || $categorie == '') {
        $error = 'ERROR: Toate câmpurile sunt obligatorii!';
    } else {
        try {
            $db->updateDB(
                    "INSERT INTO product(name, code, image, price, descriere, categorie)
                 VALUES (?, ?, ?, ?, ?, ?)",
                    [$nume, $code, $imagine, $price, $descriere, $categorie]
            );

            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            $error = "ERROR: Insert eșuat. " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adaugă produs</title>
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

    <h1 class="admin-title">Adaugă un produs</h1>

    <?php if (!empty($error)): ?>
        <div class="admin-error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" class="admin-form">
        <label for="nume">Nume produs:</label>
        <input type="text" id="nume" name="nume">

        <label for="code">Cod produs:</label>
        <input type="text" id="code" name="code">

        <label for="imagine">Imagine (link):</label>
        <input type="text" id="imagine" name="imagine">

        <label for="price">Preț:</label>
        <input type="text" id="price" name="price">

        <label for="descriere">Descriere:</label>
        <input type="text" id="descriere" name="descriere">

        <label for="categorie">Categorie:</label>
        <input type="text" id="categorie" name="categorie">

        <button type="submit" name="submit" class="admin-submit">
            Adaugă produs
        </button>
    </form>

    <div class="admin-links">
        <a href="Vizualizare.php">Înapoi la listă produse</a>
        <a href="index.php">Înapoi la Home</a>
    </div>

</div>

</body>
</html>