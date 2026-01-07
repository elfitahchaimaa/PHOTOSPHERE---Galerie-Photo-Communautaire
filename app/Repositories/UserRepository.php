<?php 
require_once __DIR__.'/RepositoryInterface.php';
require_once __DIR__.'/../Entities/User.php';
require_once __DIR__.'/../Database/Database.php';
require_once __DIR__.'/../Entities/BasicUser.php';
require_once __DIR__.'/../Entities/ProUser.php';
require_once __DIR__.'/../Entities/Moderator.php';
require_once __DIR__.'/../Entities/Administrator.php';
require_once __DIR__.'/../Services/UserFactories.php';

class UserRepo implements RepositoryInterface {
    protected PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = UserFactory::checkRole($row);
        }

        return $users;
    }

public function create(User $user): bool
{
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $user->getUsername()]);
    if ($stmt->fetchColumn() > 0) {
        throw new Exception("Username '{$user->getUsername()}' déjà utilisé !");
    }

    $stmt = $this->pdo->prepare(
        "INSERT INTO users(username,email,password) VALUES(:username,:email,:password)"
    );

    return $stmt->execute([
        'username' => $user->getUsername(),
        'email'    => $user->getEmail(),
        'password' => $user->getPassword()
    ]);
}


    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? UserFactory::checkRole($row) : null;
    }

public function update($user): bool
{
  
    $stmt = $this->pdo->prepare(
        "SELECT COUNT(*) FROM users WHERE username = :username AND id != :id"
    );
    $stmt->execute([
        'username' => $user->getUsername(),
        'id'       => $user->getId()
    ]);

    if ($stmt->fetchColumn() > 0) {
        throw new Exception("Username '{$user->getUsername()}' déjà utilisé !");
    }

    $stmt = $this->pdo->prepare(
        "UPDATE users 
         SET username = :username, email = :email, password = :password
         WHERE id = :id"
    );

    return $stmt->execute([
        'username' => $user->getUsername(),
        'email'    => $user->getEmail(),
        'password' => $user->getPassword(),
        'id'       => $user->getId()
    ]);
}


    public function delete( $user): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id_user = :id");
        return $stmt->execute(['id' => $user->getId()]);
    }
}
?>
