<?php

namespace SRC;

class User
{
    protected $email;
    protected $domain;
    protected $roleId;
    protected $role;
    protected $meta;

    /**
     * User constructor.
     * @param string $email
     * @param string $domain
     * @param integer $roleId
     * @param string $meta
     * @param Role $role
     */
    public function __construct($email, $domain, $roleId, $meta = '', Role $role)
    {
        $this->email = $email;
        $this->domain = $domain;
        $this->roleId = $roleId;
        $this->role = $role;
        $this->meta = $meta;
    }

    /**
     * @param array $fileds
     * @return array
     */
    public function toArray($fileds = [])
    {
        $user = [
            'email' => $this->getEmail(),
            'domain' => $this->getDomain(),
            'role_id' => $this->getRoleId(),
            'role' => $this->getRole()->toArray(),
            'meta' => $this->getMeta(),
        ];
        return array_diff_key($user, array_flip($fileds));
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return json_decode($this->meta);
    }

    /**
     * @return string
     */
    public function getRawMeta()
    {
        return $this->meta;
    }
}