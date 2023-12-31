<?php

namespace App\Entity;



class User extends Entity
{
    protected ?int $id_user = null;
    protected ?string $email = '';
    protected ?string $password = '';
    protected ?string $first_name = '';
    protected ?string $last_name = '';
    protected ?string $role = '';

    

    /**
     * Get the value of id_user
     */
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     */
    public function setIdUser(?int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of first_name
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     */
    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     */
    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }


    public function validate(): array
    {
        $errors = [];
        if (empty($this->getFirstName())) {
            $errors['first_name'] = 'Le champ prénom ne doit pas être vide';
        }
        if (empty($this->getLastName())) {
            $errors['last_name'] = 'Le champ nom ne doit pas être vide';
        }
        if (empty($this->getEmail())) {
            $errors['email'] = 'Le champ email ne doit pas être vide';
        } else if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }
        $password = $this->getPassword();
        if (empty($this->getPassword())) {
            $errors['password'] = 'Le champ mot de passe ne doit pas être vide';
        }else{
            //complexité du mot de passe
            if(!$this->isStrongPassword($password)){
                $error['password'] = 'le mot de passe doit contenir au moins 8 caractères, avec des lettres majuscules, des lettres minuscules, des chiffres et des caractères spéciaux.';
            }
        }
        return $errors;
    }

    private function isStrongPassword(string $password): bool
    {
        $hasUppercase = preg_match('/[A-Z]/', $password);
        $hasLowercase = preg_match('/[a-z]/', $password);
        $hasNumber = preg_match('/\d/', $password);
        $hasSpecialChar = preg_match('/[^A-Za-z\d]/', $password);

        return $hasUppercase && $hasLowercase && $hasNumber && $hasSpecialChar && strlen($password) >= 8;
    }

    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function isUser(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'user';
    }

    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }

    public static function getCurrentUserId(): int|bool
    {
        return (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) ? $_SESSION['user']['id']: false;
    }


    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }
}