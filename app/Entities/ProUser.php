<?php
require_once __DIR__.'/BasicUser.php';
class ProUser extends BasicUser{
    protected ?int $limit;
    protected DateTime $subscriptionStart;
    protected DateTime $subscriptionEnd;

public function __construct($username,$email,$passworde,$urlphoto=null,$biographie=null,$uploadCount=0,$subscriptionStart,$subscriptionEnd)
{ parent::__construct($username,$email,$passworde,$urlphoto,$biographie,$uploadCount);
 $this->limit=null;
 $this->subscriptionStart= $subscriptionStart ?? new DateTime();
 $this->subscriptionEnd=$subscriptionEnd ?? (clone $this->subscriptionStart)->modify('+1 month');
}
 public function getsubscriptionStart(){
    return $this->subscriptionStart;
}
public function getsubscriptionEnd(){
    return $this->subscriptionEnd;
}
}

?>