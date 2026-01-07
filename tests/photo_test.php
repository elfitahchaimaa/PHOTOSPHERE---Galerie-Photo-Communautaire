<?php

require_once __DIR__ . '/../app/Interface/Taggable.php';
require_once __DIR__ . '/../app/Interface/Commentable.php';
require_once __DIR__ . '/../app/Interface/Likeable.php';
require_once __DIR__ . '/../app/Traits/TaggableTrait.php';
require_once __DIR__ . '/../app/Traits/TimestampableTrait.php';
require_once __DIR__ . '/../app/Entities/Photo.php';


// Maintenant tu peux utiliser Photo
use App\Entities\Photo;

$photo = new Photo(
    id: 1,
    userId: 10,
    title: "Vacances à la plage",
    fileName: "plage.jpg",
    isPublic: true
);

echo "Photo créée avec succès !\n";
