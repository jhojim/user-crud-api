<?php

namespace SRC\Tests;

use SRC\Exception\UnauthorizedRequestException;
use SRC\Role;
use SRC\RolesStorage;
use SRC\CurrentUser;
use SRC\UsersStorage;
use SRC\Service\Roles;
use SRC\Exception\DatabaseErrorException;

class RolesTest extends \PHPUnit_Framework_TestCase
{
    protected $roles;

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

        $this->roles = new Roles($this->rolesStorageMock, $this->usersStorageMock, $this->currentUserMock);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreate($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('create')
            ->will($this->returnValue($this->roleMock));
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->roles->create($params['name'], $params['manage_users'], $params['manage_roles'], $params['dimensions'],
            $params['metric_groups'], $params['domain']);
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreateDbRoleCreationFails($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('create')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'db role creation fails');
        $this->roles->create($params['name'], $params['manage_users'], $params['manage_roles'], $params['dimensions'],
            $params['metric_groups'], $params['domain']);
    }

    public function createDataProvider()
    {
        return [
            [
                [
                    'name' => 'test',
                    'manage_users' => 1,
                    'manage_roles' => 1,
                    'dimensions' => [],
                    'metric_groups' => [],
                    'domain' => 'domain.com'
                ],
            ]
        ];
    }


    /**
     * @dataProvider getByIdDataProvider
     */
    public function testGetById($id)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->roles->getById($id);
    }

    public function getByIdDataProvider()
    {
        return [
            [
                '1'
            ]
        ];
    }

    /**
     * @dataProvider getByDomainDataProvider
     */
    public function testGetByDomain($domain)
    {
        $this->rolesStorageMock->expects($this->once())->method('fetchByDomain')
            ->will($this->returnValue($this->roleMock));
        $this->roles->getByDomain($domain);
    }

    public function getByDomainDataProvider()
    {
        return [
            [
                'domain.com'
            ]
        ];
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdate($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('update')
            ->will($this->returnValue($this->roleMock));
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->roles->update($params['name'], $params['manage_users'], $params['manage_roles'], $params['dimensions'],
            $params['metric_groups'], $params['domain'], $params['id']);
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdateDbRoleUpdatingFails($params)
    {
        $this->rolesStorageMock->expects($this->once())->method('update')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'db role updating fails');
        $this->roles->update($params['name'], $params['manage_users'], $params['manage_roles'], $params['dimensions'],
            $params['metric_groups'], $params['domain'], $params['id']);
    }

    public function updateDataProvider()
    {
        return [
            [
                [
                    'name' => 'test',
                    'manage_users' => 1,
                    'manage_roles' => 1,
                    'dimensions' => [],
                    'metric_groups' => [],
                    'domain' => 'domain.com',
                    'id' => 1
                ],
            ]
        ];
    }

    /**
     * @dataProvider deleteDataProvider
     */
    public function testDelete($id)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->rolesStorageMock->expects($this->once())->method('delete')
            ->will($this->returnValue($this->roleMock));
        $this->roles->delete($id);
    }

    /**
     * @dataProvider deleteDataProvider
     */
    public function testDeleteRoleDeletion($id)
    {
        $this->currentUserMock->expects($this->once())->method('getDomain')
            ->will($this->returnValue(true));
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->setExpectedException(UnauthorizedRequestException::class, 'This role assigned to another domain');
        $this->roles->delete($id);
    }

    /**
     * @dataProvider deleteDataProvider
     */
    public function testDeleteUserWithThisRoleExists($id)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->usersStorageMock->expects($this->once())->method('fetchForRole')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'User with this role exists');
        $this->roles->delete($id);
    }

    /**
     * @dataProvider deleteDataProvider
     */
    public function testDeleteRoleDeletionFails($id)
    {
        $this->rolesStorageMock->expects($this->once())->method('getById')
            ->will($this->returnValue($this->roleMock));
        $this->rolesStorageMock->expects($this->once())->method('delete')
            ->will($this->returnValue(false));
        $this->setExpectedException(DatabaseErrorException::class, 'Role deletion fails');
        $this->roles->delete($id);
    }


    public function deleteDataProvider()
    {
        return [
            [
                1
            ]
        ];
    }
}