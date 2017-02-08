<?php

namespace SRC;

use SRC\Exception\UserNotFoundException;
use Doctrine\DBAL\Connection;

class UsersStorage
{
    protected $db;
    protected $users;

    /**
     * UsersStorage constructor.
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }


    /**
     * @param string $email
     * @param string $domain
     * @return User
     * @throws UserNotFoundException
     */
    public function fetch($email, $domain)
    {
        $user = $this->selectByEmailDomain($email, $domain)->fetch();
        if ($user) {
            return self::build($user);
        }
        throw new UserNotFoundException('User doesn\'t exists', 500);
    }

    /**
     * @param string $email
     * @param string $domain
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    private function selectByEmailDomain($email, $domain)
    {
        return $this->buildSelect()
            ->where('email = :email')->setParameter('email', $email)
            ->andWhere('domain = :domain')->setParameter('domain', $domain)
            ->execute();

    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder instance
     */
    private function buildSelect()
    {
        return $this->db->createQueryBuilder()
            ->select('users.email', 'users.domain', 'users.meta', 'users.role_id', 'r.id', 'r.name', 'r.role_domain',
                'r.manage_users', 'r.manage_roles', 'r.meta')
            ->from('users')
            ->join('users', 'roles', 'r', 'role_id = r.id');
    }

    /**
     * @param array $user
     * @return User
     */
    public static function build($user)
    {
        $role = RolesStorage::build($user);
        return (new User($user['email'], $user['domain'], $user['role_id'], $user['meta'], $role));
    }

    /**
     * @param string $domain
     * @return array
     */
    public function fetchForDomain($domain)
    {
        $results = $this->selectByDomain($domain)->fetchAll();
        $users = [];
        foreach ($results as $user) {
            $users[] = self::build($user)->toArray(['domain']);
        }
        return $users;
    }

    /**
     * @param string $domain
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    private function selectByDomain($domain)
    {
        return $this->buildSelect()
            ->where('domain = :domain')->setParameter('domain', $domain)
            ->execute();
    }

    /**
     * @param integer $roleId
     * @return array
     */
    public function fetchForRole($roleId)
    {
        $results = $this->selectByRole($roleId)->fetchAll();
        $users = [];
        foreach ($results as $user) {
            $users[] = self::build($user)->toArray();
        }
        return $users;
    }

    /**
     * @param integer $roleId
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    private function selectByRole($roleId)
    {
        return $this->buildSelect()
            ->where('role_id = :role_id')->setParameter('role_id', $roleId)
            ->execute();
    }

    /**
     * @param string $email
     * @return int
     */
    public function checkEmailExist($email)
    {
        return count($this->fetchForEmail($email));
    }


    /**
     * @param string $email
     * @return array
     */
    public function fetchForEmail($email)
    {
        $results = $this->selectByEmail($email)->fetchAll();
        $users = [];
        foreach ($results as $user) {
            $users[] = self::build($user)->toArray(['email']);
        }
        return $users;
    }

    /**
     * @param string $email
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    private function selectByEmail($email)
    {
        return $this->buildSelect()->where('email = :email')->setParameter('email', $email)->execute();
    }

    /**
     * @param User $user
     * @return int
     */
    public function unAttach(User $user)
    {
        return $this->db->delete('users', ['email' => $user->getEmail(), 'domain' => $user->getDomain()]);
    }

    /**
     * @param User $user
     * @return int
     */
    public function create(User $user)
    {
        return $this->db->insert('users', [
            'email' => $user->getEmail(),
            'domain' => $user->getDomain(),
            'role_id' => $user->getRoleId(),
            'meta' => $user->getRawMeta()
        ]);
    }

    /**
     * @param User $user
     * @return int
     */
    public function update(User $user)
    {
        $data = [
            'role_id' => $user->getRoleId(),
            'meta' => $user->getRawMeta()
        ];
        $identifier = [
            'email' => $user->getEmail(),
            'domain' => $user->getDomain(),
        ];

        return $this->db->update('users', $data, $identifier);
    }
}