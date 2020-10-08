<?php

namespace App\Model\DTO\User;


use App\Helper\SerializableTrait;

class UserDTO
{
    use SerializableTrait;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /**
     * UserDTO constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function dto()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,

        ];
    }

    protected function getSerializationMap(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

}