<?php
namespace ProtocolTest\User;

use App\User\Exception\UserException;
use Core\Locator\Dynamic\ServiceNotParseable;
use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;
use Orm\Xervice\User\Persistence\UserQuery;
use Propel\Runtime\Exception\PropelException;
use Xervice\Core\Facade\FacadeInterface;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Core\Locator\Locator;

/**
 * @method \App\User\UserFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    protected function _before(): void
    {
        Locator::getInstance()->database()->facade()->initDatabase();
    }

    protected function _after()
    {
        $userQuery = UserQuery::create();
        $testUser = $userQuery->findOneByEmail('test@unit-test.de');

        if ($testUser) {
            $testUser->delete();
        }
    }


    /**
     * @group App
     * @group User
     * @group Integration
     */
    public function testCreateUser()
    {
        $userDp = $this->createNewUser();
        $this->assertTrue($userDp->hasUserId());
    }

    /**
     * @group App
     * @group User
     * @group Integration
     */
    public function testLogin()
    {
        $testUser = $this->createNewUser();

        $credentials = new CredentialsDataProvider();
        $credentials
            ->setEmail('test@unit-test.de')
            ->setPassword('testPass');

        $loggedUser = $this->getFacade()->loginUser($credentials);

        $this->assertEquals(
            $testUser->getUserId(),
            $loggedUser->getUserId()
        );
    }

    /**
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Exception\UserException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function createNewUser(): \DataProvider\UserDataProvider
    {
        $newUser = new UserDataProvider();
        $newUser
            ->setPassword('testPass')
            ->setEmail('test@unit-test.de')
            ->setFirstname('Unit')
            ->setLastname('Test')
            ->setCompany('Test Company')
            ->setToken('myToken')
        ;

        $userDp = $this->getFacade()->createUser($newUser);
        return $userDp;
    }

}