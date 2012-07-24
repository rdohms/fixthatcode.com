<?php

namespace DMS\Bundle\LauncherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DMS\Bundle\LauncherBundle\Entity\PreUser;
use DMS\Bundle\LauncherBundle\Form\RegistrationForm;

/**
 * @Route("/launcher")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{referrerToken}", name="launcher_index", defaults={"referrerToken" = ""})
     * @Template()
     *
     * @param null|string $referrerToken
     *
     * @return array
     */
    public function indexAction($referrerToken = null)
    {
        $entity = new PreUser();
        $entity->setReferrerToken($referrerToken);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $entity->setReferrerUrl($_SERVER['HTTP_REFERER']);
        }

        $form   = $this->createForm(new RegistrationForm(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new PreUser entity.
     *
     * @Route("/register", name="launcher_register")
     * @Method("post")
     * @Template("DMSLauncherBundle:Default:index.html.twig")
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function registerAction()
    {
        $preUser  = new PreUser();
        $request = $this->getRequest();
        $form    = $this->createForm(new RegistrationForm(), $preUser);
        $form->bindRequest($request);

        if ( ! $form->isValid()) {
            return array('entity' => $preUser, 'form' => $form->createView());
        }

        /** @var $preUserService \DMS\Bundle\LauncherBundle\Service\PreUserService */
        $preUserService = $this->get('dms_launcher.pre_user');
        $preUserService->create($preUser);

        return $this->redirect($this->generateUrl('launcher_done', array('token' => $preUser->getToken())));

    }

    /**
     * @Route("/done/{token}", name="launcher_done")
     * @Template()
     *
     * @param string $token
     *
     * @return array
     */
    public function doneAction($token)
    {
        $repository = $this->getDoctrine()->getRepository('DMSLauncherBundle:PreUser');
        $preUser = $repository->findOneBy(array('token' => $token));


        $shareInfo = array(
            'url' => $this->container->getParameter('dms_launcher.site_url') . '/' . $preUser->getToken(),
            'twitter' => $this->container->getParameter('dms_launcher.twitter_account'),
        );

        return array(
            'token' => $preUser->getToken(),
            'share' => $shareInfo
        );
    }

    /**
     * User may receive an invite to become a alpha/beta user, this is the page he is taken to
     * and his pre-account becomes an actual account.
     *
     * @Route("/invite/accept/{token}")
     */
    public function acceptInviteAction()
    {

    }
}
