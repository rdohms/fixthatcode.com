<?php
namespace FTC\Bundle\WebBundle\Twig\Security;

use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * SecurityExtension exposes security context features.
 *
 * @package FTC
 */
class SecurityExtension extends \Twig_Extension
{
    private $context;

    /**
     * @param null|\Symfony\Component\Security\Core\SecurityContextInterface $context
     */
    public function __construct(SecurityContextInterface $context = null)
    {
        $this->context = $context;
    }

    /**
     * Checks is page has a security context and a valid token
     *
     * @return boolean
     */
    public function hasSecurityContext()
    {

        if (null === $this->context) {
            return false;
        }

        if (null === $this->context->getToken()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'has_security_context' => new \Twig_Function_Method($this, 'hasSecurityContext'),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ftc_web_security';
    }
}
