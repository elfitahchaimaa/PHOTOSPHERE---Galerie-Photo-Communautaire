class UserRepository {

    public function findByEmail(string $email): ?User {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $data = $stmt->fetch();
        return $data ? new User($data) : null;
    }

    public function create(array $data): bool {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['username'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['role']
        ]);
    }
}
