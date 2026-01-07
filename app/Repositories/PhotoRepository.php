<?php

use FFI\Exception;

require_once __DIR__.'/RepositoryInterface.php';
require_once __DIR__.'/../Entities/photo.php';
require_once __DIR__.'/../Services/UserFactories.php';

class PhotoRepository{
   private  PDO $pdo;
   public function __construct()
   {
     $this->pdo=Database::getConnection();
   }

    protected function normalizeTag(string $tag):string{
        return strtolower(trim($tag));
    }

    public function saveTags( array $tags): bool {

        $tags = [];

        if (count($tags) < 1 || count($tags) > 10) {
            return false;
        }
        try{
            $this->pdo->beginTransaction();
            
            $stmt = $this->pdo->prepare(
                "INSERT INTO photos  VALUES (?, ?)"
            );
            $stmt->execute([]);
            foreach($tags as $tag){
                $tag=$this->normalizeTag($tag);
                $stmt = $this->pdo->prepare("SELECT id FROM tags WHERE name = ?");      
                $stmt->execute([$tag]);
                $tagId = $stmt->fetch();
                if (in_array($tag,$tags,false)){
                    $stmt=$this->pdo->prepare("insert into photo_tag values(?)");
                    $stmt->execute([$tagId]);
                }
                   
                }
                    $this->pdo->commit();
                    return true;
            }catch(Exception $e){
                $this->pdo->rollBack();
                throw $e;
                return false;
            }

        }

    }