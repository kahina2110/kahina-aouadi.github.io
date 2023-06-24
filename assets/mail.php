<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>

    <title>Formulaire de contact</title>
</head>
<body>

<?php
// Définir les variables vides
$email = $subject = $message = $success = $error = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = test_input($_POST["email"]);
    $subject = test_input($_POST["subject"]);
    $message = test_input($_POST["message"]);

    // Vérifier si l'adresse e-mail est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'adresse e-mail n'est pas valide.";
    } else {
        // Envoyer l'e-mail
        $to = "votre_adresse_email@example.com";
        $headers = "From: $email\r\nReply-To: $email\r\n";
        $mailSent = mail($to, $subject, $message, $headers);

        if ($mailSent) {
            $success = "L'e-mail a été envoyé avec succès.";
        } else {
            $error = "Une erreur s'est produite lors de l'envoi de l'e-mail.";
        }
    }
}

// Fonction pour nettoyer et valider les données du formulaire
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div id="contact" class="bg-gray-100 h-[50vh] text-2xl flex flex-col items-center">
    <p class="text-center w-[70%] sm:ml-[100px] md:ml-auto md:mr-auto">Contact</p>
    <form method="post" class="w-[70%] sm:w-[60%] md:w-[40%] lg:w-[30%] xl:w-[25%] mt-6 border-black">
        <input class="border border-black rounded-lg w-full mb-4" type="text" name="email" placeholder="Email" required>
        <input class="border border-black rounded-lg w-full mb-4" type="text" name="subject" placeholder="Sujet" required>
        <textarea class="border border-black rounded-lg w-full mb-4" rows="4" name="message" placeholder="Votre message ici" required></textarea>
        <button class="bg-gray-300 w-full" type="submit">Envoyer</button>
    </form>

    <?php if (!empty($success)) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

</div>

</body>
</html>
