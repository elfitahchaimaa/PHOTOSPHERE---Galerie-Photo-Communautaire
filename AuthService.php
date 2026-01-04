class AuthService {
    private UserRepository $repo;

    public function __construct() {
        $this->repo = new UserRepository();
    }

    public function login(string $email, string $password): ?User {
        $user = $this->repo->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}
