<?php


namespace App\Traits;

use DateTimeImmutable;
use DateTimeInterface;

trait TimestampableTrait{
    protected ?DateTimeInterface $createdAt = null;
    protected ?DateTimeInterface $updatedAt = null;

    protected function initializeTimestamps():void
    {

        $now=new DateTimeImmutable();
        $this->createdAt=$now;
        $this->updatedAt=$now;
    }

    protected function updateTimestamp():void
    {
        $this->updatedAt=new DateTimeImmutable();
    }

   public function getCreatedAt(?string $format = null): DateTimeInterface|string|null
   {
            if ($this->createdAt === null) {
            return null;
        }
        return $format
            ? $this->createdAt->format($format)
            : $this->createdAt;

   }
    public function getUpdatedAt(?string $format = null): DateTimeInterface|string|null
    {
        if ($this->updatedAt === null) {
            return null;
        }

        return $format
            ? $this->updatedAt->format($format)
            : $this->updatedAt;
    }


}


?>