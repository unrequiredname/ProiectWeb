<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sending email with php</title>
    <link rel="stylesheet" href="../CSS/interfataEmail.css">
    <link rel="stylesheet" href="../CSS/interfata.css">
</head>
<body>
<div class="form-container-wrapper">
    <div class ="form-container">
        <p class=""> Aveti intrebari ? Scrieti-ne un email!</p>
        <form method="post" action="../Lab8Email/pagSend.php">
            <label>Name:</label>
                <input type="text" name="name" required placeholder="Ion Ionescu"><br>
            <label>Email:</label>
                <input type="text" name="email" required placeholder="ionescuion@mail.com"><br>
            <label>Subject:</label>
                <input type="text" name="subject" required placeholder="Subiect"><br>
            <label>Message:</label>
                <textarea name="msg" required placeholder="Un elefant se legana pe o panja de paianjen si pentru ca nu se rupea, a mai chemat un elefant."></textarea>
            <button type="submit" name="send_message_btn">Send</button>
        </form>
    </div>
</div>
</body>
</html>