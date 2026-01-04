class User {
    public int $id;
    public string $username;
    public string $email;
    public string $role;
    public ?string $bio;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->role = $data['role'];
        $this->bio = $data['bio'] ?? null;
    }
}
