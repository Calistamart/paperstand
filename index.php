<?php
// Obtenez la valeur de l'action à partir de la requête GET
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Faites correspondre l'action à un traitement spécifique
switch ($action) {
    case 'login':
        include('Controller/login.php');
        break;
    default:
        // Gérer l'action par défaut pour une page non trouvée (404)
        http_response_code(404);
        include('404.php');
        break;
}


//     // Vérifier si c'est du get ou du post ( $_SERVER['REQUEST_METHOD'] === 'POST' ou 'GET' 

//     // Vérifier que le paramètre HTTP action existe bien 
//     // Si le paramètre action n'existe pas, on envoie une 400 BarRequest

//     // Tu vas créer un nouveau controller et l'exécuter
//     $controller = null;
//     switch ($action) {
//         case 'listPost' : $controller = new MonController(je lui donne à maner ce qu'il faut);
//             break;
//         case ... :
//         default : echo "404"; // + status HTTP 404;
//         die();
//     }

//     // Ici j'ai un controlleur qui existe 
//     $controller->process(....);

// // Methode 2 
// tu détectes ton action 
// switch ($action) {

//     case 'listPost' : include('Controller/listPost.php');
//         break;
//     default : 404;
//     http_response_code(404);
//     include('my_404.php');
// }


?>