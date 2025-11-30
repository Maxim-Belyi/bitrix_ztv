<?php
class CreateUserDTO {
    public function __construct(
        public string $login,
        public string $name,
        public string $lastName,
        public string $email,
        public string $password,
        
        public bool $isActive = true,
        public ?string $myString = null,
        public ?int $myNumber = null,
        public ?bool $myBool = null
        ) {}
};
