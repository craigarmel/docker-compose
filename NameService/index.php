<?php
header('Content-Type: text/html; charset=utf-8');

// Gérer les requêtes GET et POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET : retourner le prénom par défaut
    $prenom = "Armel";
    echo $prenom;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST : recevoir un nom dans le body de la requête
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (isset($data['nom']) && !empty($data['nom'])) {
        $nom = $data['nom'];
        echo "Nom reçu : " . htmlspecialchars($nom);
    } elseif (isset($_POST['nom']) && !empty($_POST['nom'])) {
        // Gérer aussi les données de formulaire
        $nom = $_POST['nom'];
        echo "Nom reçu : " . htmlspecialchars($nom);
    } else {
        http_response_code(400);
        echo "Erreur : Veuillez fournir un nom dans le body de la requête (format JSON: {\"nom\": \"votre nom\"})";
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée. Utilisez GET ou POST.";
}
?>

