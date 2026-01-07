<?php
require_once __DIR__.'/BasicUser.php';
class ProUser extends BasicUser{
    protected ?int $limit;
    protected DateTime $subscriptionStart;
    protected DateTime $subscriptionEnd;

public function __construct(
    $username,
    $email,
    $passworde,
    $urlphoto = null,
    $biographie = null,
    $uploadCount = 0,
    $subscriptionStart = null,
    $subscriptionEnd = null
) {
    parent::__construct($username, $email, $passworde, $urlphoto, $biographie, $uploadCount);

    $this->limit = null;


    if (is_string($subscriptionStart)) {
        $this->subscriptionStart = new DateTime($subscriptionStart);
    } else {
        $this->subscriptionStart = $subscriptionStart ?? new DateTime();
    }

    if (is_string($subscriptionEnd)) {
        $this->subscriptionEnd = new DateTime($subscriptionEnd);
    } else {
        $this->subscriptionEnd = $subscriptionEnd ?? (clone $this->subscriptionStart)->modify('+1 month');
    }
}


 public function getsubscriptionStart(){
    return $this->subscriptionStart;
}
public function getsubscriptionEnd(){
    return $this->subscriptionEnd;
}
}

?>