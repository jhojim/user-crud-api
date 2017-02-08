<?php

namespace SRC\Tests;

use SRC\Exception\UserNotFoundException;
use SRC\Role;
use SRC\RolesStorage;
use SRC\User;
use SRC\CurrentUser;
use SRC\UsersStorage;
use SRC\Service\Users;
use SRC\Exception\DatabaseErrorException;

class UsersTest extends \PHPUnit_Framework_TestCase
{
    protected $users;

    public function setUp()
    {
        $this->rolesStorageMock = $this->getMockBuilder(RolesStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->usersStorageMock = $this->getMockBuilder(UsersStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currentUserMock = $this->getMockBuilder(CurrentUser::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->roleMock = $this->getMockBuilder(Role::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->userMock = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->users = new Users($this->usersStorageMock, $this->rolesStorageMock, $this->currentUserMock);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreate($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->throwException(new UserNotFoundException()));
        $this->usersStorageMock->expects($this->once())->method('create')
            ->will($this->returnValue($this->userMock));
        $this->users->create($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreateUserAlreadyExists($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->returnValue($this->userMock));
        $this->setExpectedException(DatabaseErrorException::class, 'user already exists');
        $this->users->create($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreateRoleNotExists($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'role doesn\'t exists');
        $this->users->create($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreateDbUserCreationFails($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->throwException(new UserNotFoundException()));
        $this->usersStorageMock->expects($this->once())->method('create')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'db user creation fails');
        $this->users->create($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    public function createDataProvider()
    {
        return [
            [
                ['email' => 'email@domain.com', 'filter' => [], 'role_id' => 1, 'domain' => 'domain.com'],
            ]
        ];
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdate($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->exactly(2))->method('fetch')
            ->will($this->returnValue($this->userMock));
        $this->usersStorageMock->expects($this->once())->method('update')
            ->will($this->returnValue($this->userMock));
        $this->users->update($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdateRoleroleDoesntExists($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'role doesn\'t exists');
        $this->users->update($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdateUserIsNotFoundInDomain($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->throwException(new UserNotFoundException()));
        $this->setExpectedException(UserNotFoundException::class, '');
        $this->users->update($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdateDbUserUpdatingFails($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->returnValue($this->userMock));
        $this->usersStorageMock->expects($this->once())->method('update')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'db user updating fails');
        $this->users->update($params['email'], $params['filter'], $params['role_id'], $params['domain']);
    }

    public function updateDataProvider()
    {
        return [
            [
                ['email' => 'email@domain.com', 'filter' => ['test'], 'role_id' => 1, 'domain' => 'domain.com'],
            ]
        ];
    }

    /**
     * @dataProvider getByEmailDataProvider
     */
    public function testGetByEmail($email)
    {
        $this->usersStorageMock->expects($this->once())->method('fetchForEmail')
            ->will($this->returnValue($this->userMock));
        $this->users->getByEmail($email);
    }

    public function getByEmailDataProvider()
    {
        return [
            [
                'email@domain.com'
            ]
        ];
    }

    /**
     * @dataProvider getByDomainDataProvider
     */
    public function testGetByDomain($email)
    {
        $this->usersStorageMock->expects($this->once())->method('fetchForDomain')
            ->will($this->returnValue($this->userMock));
        $this->users->getByDomain($email);
    }

    public function getByDomainDataProvider()
    {
        return [
            [
                'email@domain.com'
            ]
        ];
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testDelete($params)
    {
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->returnValue($this->userMock));
        $this->usersStorageMock->expects($this->once())->method('unAttach')
            ->will($this->returnValue($this->userMock));
        $this->users->delete($params['email'], $params['domain']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testDeleteUserIsNotFoundInDomain($params)
    {
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->throwException(new UserNotFoundException()));
        $this->setExpectedException(UserNotFoundException::class, '');
        $this->users->delete($params['email'], $params['domain']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testDeleteUserDeletionFails($params)
    {
        $this->usersStorageMock->expects($this->once())->method('fetch')
            ->will($this->returnValue($this->userMock));
        $this->usersStorageMock->expects($this->once())->method('unAttach')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'User deletion fails');
        $this->users->delete($params['email'], $params['domain']);
    }

    public function deleteDataProvider()
    {
        return [
            [
                ['email' => 'email@domain.com', 'domain' => 'domain.com'],
            ]
        ];
    }
}