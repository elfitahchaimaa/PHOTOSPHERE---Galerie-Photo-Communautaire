<?php
require_once '../app/Database/Database.php';
require_once '../app/Repositories/UserRepository.php';
require_once '../app/Entities/BasicUser.php';

$pdo = Database::getConnection();
$userRepo = new UserRepo($pdo);
echo "Tester une méthode Creation d'un user :<br>";
$user = new BasicUser('aicha', 'aicha@mail.com','123');
echo "un nouveux utilisateur : " . $user->affichage() . "<br>";
try {
    $userRepo->create($user);
    echo "Utilisateur créé avec succès !";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

echo "ID attribué : " . $user->getid() . "<br>";

echo "Tester une méthode findById : 1 <br>";
$user = $userRepo->findById(1);
if ($user) {
    echo "user: récupéré <br> " . $user->affichage();
} else {
    echo "aucun user <br>";
}
echo "Tester une méthode update user:  <br>";
$user->setusername("aicha");
try {
    $userRepo->update($user);
    echo "Utilisateur mis à jour !";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}


echo "Tester une méthode findall :  <br>";
$allUsers = $userRepo->findall();
foreach ($allUsers as $user) {
    echo $user->affichage() . "<br>";
}
?>