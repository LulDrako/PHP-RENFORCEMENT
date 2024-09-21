<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
</head>

<form action="index.php?page=register" method="POST">
    <label for="email">email :</label>
    <input type="text" id="email" name="email" required>

    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">S'inscrire</button>
</form>
