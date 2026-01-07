<?php 


namespace App\Traits;

trait TaggableTrait{
    protected $tag=[];
    protected $tagsloaded=false;

    protected function normalizeTag(string $tag):string{
        return strtolower(trim($tag));
    }

    protected function loadTgsIfNeeded():void{
        if($this->tagsloaded){
            return;
        }

        $stmt=$this->pdo->prepare('select tag from tags where taggable_id=:id');
        $stmt->execute(['id'=>$this->taggableId]);
        $this->tags=array_map(fn($row) =>$this->normalizeTag($row['tag']),$stmt->fetchAll() );
        $this->tagsloaded=true;
    }

    public function addTag(string $tag):void{
        $this->loadTgsIfNeeded();
        $tag=$this->normalizeTag($tag);
        if(!in_array($tag,$this->tags,true)){
            $this->tags[]=$tag;
        }


    }
    public function clearTags(): void
{
    $this->tags = []; 
}


    public function removeTag(string $tag):void{
        $this->loadTgsIfNeeded();
        $tag=$this->normalizeTag($tag);

        $this->tags=array_values(
            array_filter(
                $this->Tags,
                fn($t)=>$t !==$tag
            )
            );
    }

    public function getTags():array{
        $this->loadedTagsIfNeeded();
        return $this->tags;
    }

    public function hasTag(string $tag):bool{
        $this->loadedTagsIfNeeded();
        return in_array($this->normalizeTag($tag),$this->tags,true);

    }
    public function hasAllTags(array $tags):bool{

        foreach($tags as $tag){
            if (!$this->hasTag($tag)){
                return false;
            }
        }
            return true;
    }
public function hasAnyTag(array $tags):bool
{
    foreach($tags as $tag){
        if($this->hasTag($tag)){
            return true;
        }
        
    }
        return false;
}


}

?>