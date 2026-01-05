<?php 
require_once __DIR__.'/RepositoryInterface.php';
require_once __DIR__.'/../Entities/user.php';
require_once __DIR__.'/../Database/Database.php';
require_once __DIR__.'/../Entities/BasicUser.php';
require_once __DIR__.'/../Entities/ProUser.php';
require_once __DIR__.'/../Entities/Moderator.php';
require_once __DIR__.'/../Entities/Administrator.php';

class UserRepo implements RepositoryInterface {
    protected PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }
    public function findall(): array
    {
        $stmt=$this->pdo->query("select * from users");
        $users=[];
        while($row=$stmt->fetch()){
            $users[]=UserFactory::checkrole($row);
        }
        return $users;
    }


   public function findById(int $id){
        $stmt=$this->pdo->prepare("select * from users where id_user=:id");
        $stmt->execute(['id'=>$id]);
        $row=$stmt->fetch();

    if($row){
        return $user=UserFactory::checkrole($row);
    }
    else{
        return null;
    }}
    public function update($user):bool{
                $stmt=$this->pdo->prepare("update utilisateur set username=:username,email=:email,passworde=:passworde,urlphoto=:urlphoto,biographie=:biographie where id_user=:id_user");
                return $stmt->execute([
                    'username'=>$user->getusername(),
                    'email'=>$user->getemail(),
                    'passworde'=>$user->getpassworde(),
                    'urlphoto'=>$user->geturlphoto(),
                    'biographie'=>$user->getbiographie(),
                    'id_user'=>$user->getid()
                    ]);
}

public function delete($user):bool{
        $stmt=$this->pdo->prepare("delete from utilisateur where id_user=:id");
        return $stmt->execute(['id'=>$user->getid()]);
}
}

?>