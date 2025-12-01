<?php
include __DIR__ . '/../DBController.php';

$db = new DBController();

try {
    $products = $db->getDBResult("SELECT * FROM product ORDER BY id");
} catch (PDOException $e) {
    $error = "Eroare la interogare: " . htmlspecialchars($e->getMessage());
    $products = [];
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Panou admin - Înregistrări</title>
    <link rel="stylesheet" href="../CSS/interfataAdmin.css">
</head>
<body>

<div class="admin-header">
    <h2>🛠️ Panou Admin - Înregistrări</h2>
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
    <h1 class="admin-title">Înregistrările din tabela de produse</h1>

    <?php if (!empty($error)): ?>
        <div class="admin-error"><?= $error ?></div>
    <?php endif; ?>

    <?php if (empty($products)): ?>
        <p class="admin-empty">Nu sunt înregistrări în tabela de produse.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nume produs</th>
                <th>Cod produs</th>
                <th>Imagine</th>
                <th>Preț</th>
                <th>Descriere</th>
                <th>Categorie</th>
                <th colspan="2">Acțiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['code']) ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <img
                                    src="<?= htmlspecialchars($row['image']) ?>"
                                    alt="Imagine produs"
                                    class="admin-product-image">
                        <?php else: ?>
                            <span class="no-image">Fără imagine</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['descriere']) ?></td>
                    <td><?= htmlspecialchars($row['categorie']) ?></td>
                    <td class="admin-actions">
                        <a class="admin-btn admin-btn-edit"
                           href="admin_edit_product.php?id=<?= (int)$row['id'] ?>">
                            Modificare
                        </a>
                    </td>
                    <td class="admin-actions">
                        <a class="admin-btn admin-btn-delete"
                           href="admin_delete_product.php?id=<?= (int)$row['id'] ?>"
                           onclick="return confirm('Sigur ștergi acest produs?');">
                            Ștergere
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="admin-links">
        <a href="admin_add_product.php">Adaugă produs nou</a>
        <a href="index.php">Înapoi la Home</a>
    </div>
</div>

</body>
</html>
