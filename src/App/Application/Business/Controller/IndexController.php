<?php


namespace App\Application\Business\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Business\Controller\AbstractController;
use Xervice\Core\Factory\FactoryInterface;

/**
 * @method \App\Application\ApplicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction(): Response
    {
        return $this->sendResponse(
            sprintf(
                'Hello World %s',
                $this->getFactory()->getSessionClient()->get('name') ?: 'undefined'
            )
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function nameAction(Request $request, string $name): Response
    {
        $this->getFactory()->getSessionClient()->set('name', $name);

        return $this->sendResponse(
            sprintf(
                'Set name %s',
                $name
            )
        );
    }
}