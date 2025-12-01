<?php

$email = "baraian.si.coti@bsg.com";
$to = "baraian.si.coti123@bsg.com";
$subject="Un nou contact s-a inregistrat";

$headers="From:$email" . "\r\n" .
$message="A visitor to your site has sent the following email address to be added to you mailing list.\n";
mail($to,$subject,$message,$headers);

if(isset($_POST['send_message_btn'])) {
    $name = $_POST['name'];
    $emailUser = $_POST['email'];
    $userSubject = $_POST['subject'];
    $msg = $_POST['msg'];

    $userSubject=   "Thank you";

    $userHeaders = "From: baraian.si.coti@outlook.com\r\n";
    $userHeaders .= "Content-type: X-Mailers: php\r\n";
    $userHeaders .= "MIME-Version: 1.0" . "\r\n";
    $userHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $userMessage = "Thank you for subscribing to our mailing list.";
    $userMessage = "
<html>
<head>
    <title>HTML Email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subiect</th>
        </tr>
        <tr>
            <td>$name</td>
            <td>$emailUser</td>
            <td>$userSubject</td>
        </tr>
    </table>
<p>$msg</p>
</body>
</html>";
    $mesaj ='';
    $eroare = false;
    try {
        if (!mail($email, $userSubject, $userMessage, $userHeaders)) {
            throw new Exception("Functia mail a returnat fals, emailul nu a fost trimis.");
        }
        $mesaj = "Mail trimis cu succes !";
    }catch (Exception $e){
        $mesaj = "Emailul nu s-a putut trimite:" . $e->getMessage();
        $eroare = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultat trimitere email</title>
    <link rel="stylesheet" href="../CSS/interfataEmail.css">
</head>

<body>
<div class="mail-wrapper">
    <h1 class="mail-title">Rezultat trimitere email</h1>

    <div class="mail-message <?= $eroare ? 'error' : 'success' ?>">
        <?= $mesaj ?>
    </div>

    <div class="mail-actions">
        <a href="http://localhost:8025" target="_blank" class="mail-btn">Vizualizeaza pe MailHog!</a>
        <a href="../user/index.php" class="mail-btn secondary">Înapoi la magazin</a>
    </div>
</div>
</body>
</html>