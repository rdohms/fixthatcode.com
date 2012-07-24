<?php
namespace DMS\Bundle\LauncherBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Access Listener
 *
 * Listens to accesses to the website and decides if it needs to intercept and redirect the user
 * to the launch page, or let him in.
 */
class AccessListener
{

    protected $enable;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext $securityContext
     */
    protected $securityContext;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected $router;

    /**
     * @var array
     */
    protected $whitelist;

    /**
     * Constructor
     *
     * @param boolean $enable
     * @param array $whitelist
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     * @param \Symfony\Component\Routing\RouterInterface $router
     */
    public function __construct($enable, $whitelist, $securityContext, $router)
    {
        $this->enable          = $enable;
        $this->whitelist       = $whitelist;
        $this->securityContext = $securityContext;
        $this->router          = $router;
    }

    /**
     * Redirects if user is not in alpha launch
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     * @return null
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        //Let launcher URLs through
        if ($this->isWhiteListed($request)) {
            return null;
        }

        //If the user is logged in he can go where he likes
        if ($this->hasLoggedUser()) {
            return null;
        }

        //No session - FORWARD to launcher page
        $event->setResponse(new RedirectResponse($this->router->generate('launcher_index')));

    }

    /**
     * Checks if a user is logged in
     *
     * @return bool
     */
    protected function hasLoggedUser()
    {
        if (null === $token = $this->securityContext->getToken()) {
            return false;
        }

        if (!is_object($user = $token->getUser())) {
            return false;
        }

        return true;
    }

    /**
     * Checks if a url is white listed for launcher access
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    protected function isWhiteListed($request)
    {
        //Let launcher URLs through
        if (strpos($request->getPathInfo(), 'launcher') !== false) {
            return true;
        }

        //Let launcher URLs through
        if (strpos($request->getPathInfo(), 'login') !== false) {
            return true;
        }

        //Internal Symfony Routes
        if (substr($request->attributes->get('_route'), 0, 1) == "_"){
            return true;
        }

        //No whitelist
        if ( ! is_array($this->whitelist)) {
            return false;
        }

        //Whitelisted
        if (in_array($request->getPathInfo(), $this->whitelist)) {
            return true;
        }

        return false;
    }
}
