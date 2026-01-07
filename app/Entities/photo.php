<?php

namespace App\Entities;

use App\Interface\Taggable;
use App\Interface\Commentable;
use App\Interface\Likeable;
use App\Traits\TaggableTrait;
use App\Traits\TimestampableTrait;

class Photo implements Taggable, Commentable, Likeable
{
    use TaggableTrait;
    use TimestampableTrait;

    private int $id;
    private int $userId;
    private string $title;
    private string $fileName;
    private bool $isPublic;

    private int $likeCount = 0;
    private int $commentCount = 0;

    public function __construct(
        int $id,
        int $userId,
        string $title,
        string $fileName,
        bool $isPublic
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->fileName = $fileName;
        $this->isPublic = $isPublic;

        $this->initializeTimestamps();
    }

    public function addComment(string $content, int $userId): int
    {
        $this->commentCount++;
        return $this->commentCount;
    }


    public function removeComment(int $commentId): bool
    {
        if ($this->commentCount > 0) {
            $this->commentCount--;
            return true;
        }
        return false;
    }

    public function getComments(): array
    {
        return [];
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function addLike(int $userId): bool
    {
        $this->likeCount++;
        return true;
    }

    public function removeLike(int $userId): bool
    {
        if ($this->likeCount > 0) {
            $this->likeCount--;
            return true;
        }
        return false;
    }

    public function isLikedBy(int $userId): bool
    {
        return false;
    }

    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    public function getLikedBy(): array
    {
        return [];
    }

    protected function loadTagsFromDatabase(): void
    {
        // sera rempli plus tard
    }
}
