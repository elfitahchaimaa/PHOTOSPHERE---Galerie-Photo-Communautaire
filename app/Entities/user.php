<?php



abstract class User
{
    protected ?int $id_user = null;
    protected string $username;
    protected string $email;
    protected string $password;
    protected DateTimeInterface $createdAt;

    public function __construct(string $username, string $email, string $password)
    {
        $this->username  = $username;
        $this->email     = $email;
        $this->password  = password_hash($password, PASSWORD_BCRYPT);
        $this->createdAt = new DateTimeImmutable();
    }

    
    public function getId(): ?int
    {
        return $this->id_user;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    
    public function setId(int $id): void
    {
        $this->id_user = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    
    public function affichage(): string
    {
        return "ID: " . ($this->id_user ?? 'non défini') .
               " | Username: {$this->username} | Email: {$this->email}";
    }
}
