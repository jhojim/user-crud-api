<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * ProjectServiceContainer.
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class ProjectServiceContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = array();
        $this->methodMap = array(
            'action.auth' => 'getAction_AuthService',
            'action.role' => 'getAction_RoleService',
            'action.roles' => 'getAction_RolesService',
            'action.user' => 'getAction_UserService',
            'action.users' => 'getAction_UsersService',
            'auth0' => 'getAuth0Service',
            'callableresolver' => 'getCallableresolverService',
            'common.app' => 'getCommon_AppService',
            'common.middleware.contenttype' => 'getCommon_Middleware_ContenttypeService',
            'common.middleware.errorhandler' => 'getCommon_Middleware_ErrorhandlerService',
            'container' => 'getContainerService',
            'currentuser' => 'getCurrentuserService',
            'database' => 'getDatabaseService',
            'doc' => 'getDocService',
            'environment' => 'getEnvironmentService',
            'foundhandler' => 'getFoundhandlerService',
            'headers' => 'getHeadersService',
            'jwtauthenticationfactory' => 'getJwtauthenticationfactoryService',
            'middleware.jwt' => 'getMiddleware_JwtService',
            'middleware.verifyuser' => 'getMiddleware_VerifyuserService',
            'notallowedhandler' => 'getNotallowedhandlerService',
            'notfoundhandler' => 'getNotfoundhandlerService',
            'request' => 'getRequestService',
            'response' => 'getResponseService',
            'rolesstorage' => 'getRolesstorageService',
            'router' => 'getRouterService',
            'service.auth' => 'getService_AuthService',
            'service.roles' => 'getService_RolesService',
            'service.users' => 'getService_UsersService',
            'settings' => 'getSettingsService',
            'usersstorage' => 'getUsersstorageService',
        );
        $this->aliases = array(
            'errorhandler' => 'common.middleware.errorhandler',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return true;
    }

    /**
     * Gets the 'action.auth' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Action\Auth A SRC\Action\Auth instance
     */
    protected function getAction_AuthService()
    {
        return $this->services['action.auth'] = new \SRC\Action\Auth($this->get('service.auth'));
    }

    /**
     * Gets the 'action.role' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Action\Role A SRC\Action\Role instance
     */
    protected function getAction_RoleService()
    {
        return $this->services['action.role'] = new \SRC\Action\Role($this->get('service.roles'));
    }

    /**
     * Gets the 'action.roles' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Action\Roles A SRC\Action\Roles instance
     */
    protected function getAction_RolesService()
    {
        return $this->services['action.roles'] = new \SRC\Action\Roles($this->get('service.roles'), $this->get('currentuser'));
    }

    /**
     * Gets the 'action.user' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Action\User A SRC\Action\User instance
     */
    protected function getAction_UserService()
    {
        return $this->services['action.user'] = new \SRC\Action\User($this->get('service.users'), $this->get('currentuser'));
    }

    /**
     * Gets the 'action.users' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Action\Users A SRC\Action\Users instance
     */
    protected function getAction_UsersService()
    {
        return $this->services['action.users'] = new \SRC\Action\Users($this->get('service.users'), $this->get('auth0'), $this->get('currentuser'));
    }

    /**
     * Gets the 'auth0' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Auth0 A SRC\Auth0 instance
     */
    protected function getAuth0Service()
    {
        return $this->services['auth0'] = new \SRC\Auth0(array('client_id' => '8ngYCiwuH0efEzgGQWcsLxuLqrkDwsgX', 'client_secret' => 'EY6J8-81adMpmSJwD1kddHbzcOSwDY2fUcCZ5MGkvNds9L2-TsycHCh6gsr1ZL24', 'domain' => 'dudich.auth0.com', 'scope' => 'openid email email_verified app_metadata iss sub aud exp iat', 'connection' => 'Username-Password-Authentication'));
    }

    /**
     * Gets the 'callableresolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\CallableResolver A Slim\CallableResolver instance
     */
    protected function getCallableresolverService()
    {
        return $this->services['callableresolver'] = new \Slim\CallableResolver($this->get('container'));
    }

    /**
     * Gets the 'common.app' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\App A Slim\App instance
     */
    protected function getCommon_AppService()
    {
        $this->services['common.app'] = $instance = new \Slim\App($this->get('container'));

        $instance->add($this->get('common.middleware.contenttype'));

        return $instance;
    }

    /**
     * Gets the 'common.middleware.contenttype' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Middleware\ContentType A SRC\Middleware\ContentType instance
     */
    protected function getCommon_Middleware_ContenttypeService()
    {
        return $this->services['common.middleware.contenttype'] = new \SRC\Middleware\ContentType();
    }

    /**
     * Gets the 'common.middleware.errorhandler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Middleware\ErrorHandler A SRC\Middleware\ErrorHandler instance
     */
    protected function getCommon_Middleware_ErrorhandlerService()
    {
        return $this->services['common.middleware.errorhandler'] = new \SRC\Middleware\ErrorHandler();
    }

    /**
     * Gets the 'container' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("container"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'currentuser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\CurrentUser A SRC\CurrentUser instance
     */
    protected function getCurrentuserService()
    {
        return $this->services['currentuser'] = new \SRC\CurrentUser($this->get('usersstorage'));
    }

    /**
     * Gets the 'database' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\DBAL\Connection A Doctrine\DBAL\Connection instance
     */
    protected function getDatabaseService()
    {
        return $this->services['database'] = \Doctrine\DBAL\DriverManager::getConnection(array('dbname' => 'sample_db', 'user' => 'sample_db_user', 'password' => 'sample_db_user_password', 'host' => '127.0.0.1', 'driver' => 'pdo_mysql'));
    }

    /**
     * Gets the 'doc' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Common\Doc A SRC\Common\Doc instance
     */
    protected function getDocService()
    {
        return $this->services['doc'] = new \SRC\Common\Doc(array('apikey' => 'public/doc', 'internal' => 'public/docinternal'), array(0 => '/^src/'), array(0 => 'doc/', 1 => 'docinternal/', 2 => 'vendor/'));
    }

    /**
     * Gets the 'environment' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Common\Environment A SRC\Common\Environment instance
     */
    protected function getEnvironmentService()
    {
        return $this->services['environment'] = new \SRC\Common\Environment();
    }

    /**
     * Gets the 'foundhandler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Handlers\Strategies\RequestResponse A Slim\Handlers\Strategies\RequestResponse instance
     */
    protected function getFoundhandlerService()
    {
        return $this->services['foundhandler'] = new \Slim\Handlers\Strategies\RequestResponse();
    }

    /**
     * Gets the 'headers' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Http\Headers A Slim\Http\Headers instance
     */
    protected function getHeadersService()
    {
        return $this->services['headers'] = new \Slim\Http\Headers(array('Content-Type' => 'text/html; charset=UTF-8'));
    }

    /**
     * Gets the 'jwtauthenticationfactory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\JwtAuthenticationFactory A SRC\JwtAuthenticationFactory instance
     */
    protected function getJwtauthenticationfactoryService()
    {
        return $this->services['jwtauthenticationfactory'] = new \SRC\JwtAuthenticationFactory('EY6J8-81adMpmSJwD1kddHbzcOSwDY2fUcCZ5MGkvNds9L2-TsycHCh6gsr1ZL24');
    }

    /**
     * Gets the 'middleware.jwt' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Middleware\JwtAuthentication A Slim\Middleware\JwtAuthentication instance
     */
    protected function getMiddleware_JwtService()
    {
        return $this->services['middleware.jwt'] = $this->get('jwtauthenticationfactory')->createJwtAuthentication();
    }

    /**
     * Gets the 'middleware.verifyuser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Middleware\VerifyUser A SRC\Middleware\VerifyUser instance
     */
    protected function getMiddleware_VerifyuserService()
    {
        return $this->services['middleware.verifyuser'] = new \SRC\Middleware\VerifyUser($this->get('currentuser'));
    }

    /**
     * Gets the 'notallowedhandler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Handlers\NotAllowed A Slim\Handlers\NotAllowed instance
     */
    protected function getNotallowedhandlerService()
    {
        return $this->services['notallowedhandler'] = new \Slim\Handlers\NotAllowed();
    }

    /**
     * Gets the 'notfoundhandler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Handlers\NotFound A Slim\Handlers\NotFound instance
     */
    protected function getNotfoundhandlerService()
    {
        return $this->services['notfoundhandler'] = new \Slim\Handlers\NotFound();
    }

    /**
     * Gets the 'request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Http\Request A Slim\Http\Request instance
     */
    protected function getRequestService()
    {
        return $this->services['request'] = \Slim\Http\Request::createFromEnvironment($this->get('environment'));
    }

    /**
     * Gets the 'response' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Http\Response A Slim\Http\Response instance
     */
    protected function getResponseService()
    {
        $this->services['response'] = $instance = new \Slim\Http\Response(200, $this->get('headers'));

        $instance->withProtocolVersion('1.1');

        return $instance;
    }

    /**
     * Gets the 'rolesstorage' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\RolesStorage A SRC\RolesStorage instance
     */
    protected function getRolesstorageService()
    {
        return $this->services['rolesstorage'] = new \SRC\RolesStorage($this->get('database'));
    }

    /**
     * Gets the 'router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Router A Slim\Router instance
     */
    protected function getRouterService()
    {
        return $this->services['router'] = new \Slim\Router();
    }

    /**
     * Gets the 'service.auth' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Service\Auth A SRC\Service\Auth instance
     */
    protected function getService_AuthService()
    {
        return $this->services['service.auth'] = new \SRC\Service\Auth(array('client_id' => '8ngYCiwuH0efEzgGQWcsLxuLqrkDwsgX', 'client_secret' => 'EY6J8-81adMpmSJwD1kddHbzcOSwDY2fUcCZ5MGkvNds9L2-TsycHCh6gsr1ZL24', 'domain' => 'dudich.auth0.com', 'scope' => 'openid email email_verified app_metadata iss sub aud exp iat', 'connection' => 'Username-Password-Authentication'));
    }

    /**
     * Gets the 'service.roles' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Service\Roles A SRC\Service\Roles instance
     */
    protected function getService_RolesService()
    {
        return $this->services['service.roles'] = new \SRC\Service\Roles($this->get('rolesstorage'), $this->get('usersstorage'), $this->get('currentuser'));
    }

    /**
     * Gets the 'service.users' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\Service\Users A SRC\Service\Users instance
     */
    protected function getService_UsersService()
    {
        return $this->services['service.users'] = new \SRC\Service\Users($this->get('usersstorage'), $this->get('rolesstorage'), $this->get('currentuser'));
    }

    /**
     * Gets the 'settings' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Slim\Collection A Slim\Collection instance
     */
    protected function getSettingsService()
    {
        return $this->services['settings'] = new \Slim\Collection(array('httpVersion' => '1.1', 'responseChunkSize' => 4096, 'outputBuffering' => 'append', 'determineRouteBeforeAppMiddleware' => false, 'displayErrorDetails' => true));
    }

    /**
     * Gets the 'usersstorage' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \SRC\UsersStorage A SRC\UsersStorage instance
     */
    protected function getUsersstorageService()
    {
        return $this->services['usersstorage'] = new \SRC\UsersStorage($this->get('database'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array();
    private $dynamicParameters = array();

    /**
     * Computes a dynamic parameter.
     *
     * @param string The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'settings' => array(
                'httpVersion' => '1.1',
                'responseChunkSize' => 4096,
                'outputBuffering' => 'append',
                'determineRouteBeforeAppMiddleware' => false,
                'displayErrorDetails' => true,
            ),
            'jwt.secret' => 'EY6J8-81adMpmSJwD1kddHbzcOSwDY2fUcCZ5MGkvNds9L2-TsycHCh6gsr1ZL24',
            'doc.levels' => array(
                'apikey' => 'public/doc',
                'internal' => 'public/docinternal',
            ),
            'doc.include' => array(
                0 => '/^src/',
            ),
            'doc.exclude' => array(
                0 => 'doc/',
                1 => 'docinternal/',
                2 => 'vendor/',
            ),
            'database' => array(
                'dbname' => 'sample_db',
                'user' => 'sample_db_user',
                'password' => 'sample_db_user_password',
                'host' => '127.0.0.1',
                'driver' => 'pdo_mysql',
            ),
            'auth0' => array(
                'client_id' => '8ngYCiwuH0efEzgGQWcsLxuLqrkDwsgX',
                'client_secret' => 'EY6J8-81adMpmSJwD1kddHbzcOSwDY2fUcCZ5MGkvNds9L2-TsycHCh6gsr1ZL24',
                'domain' => 'dudich.auth0.com',
                'scope' => 'openid email email_verified app_metadata iss sub aud exp iat',
                'connection' => 'Username-Password-Authentication',
            ),
        );
    }
}
