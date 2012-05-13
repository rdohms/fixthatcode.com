<?php
namespace FTC\Bundle\ApiBundle\Service;

use JMS\SerializerBundle\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Json Responder
 *
 * Is capable of responding with a josn encoded response, it wraps functionality
 */
class JsonResponder
{
    /**
     * @var \JMS\SerializerBundle\Serializer\SerializerInterface
     */
    protected $serializer;

    /**
     * @param \JMS\SerializerBundle\Serializer\SerializerInterface $serializer
     */
    public function __construct( SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Builds a success Json Response
     *
     * @param $content
     * @param int $status
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSuccessResponse($content, $status = 200, $headers = array())
    {
        return $this->buildResponse($content, $status, $headers);
    }

    /**
     * Builds an error Json Response
     *
     * @param string $message
     * @param int $code
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getErrorResponse($message = "Error.", $code = 500, $headers = array())
    {
        $content = array('message' => $message);
        return $this->buildResponse($content, $code, $headers);
    }

    /**
     * Builds a response
     *
     * @param array $content
     * @param int $status
     * @param array $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildResponse($content, $status, $headers)
    {
        $encodedContent = $this->serializer->serialize($content, 'json');

        $jsonResponse = new Response($encodedContent, $status, $headers);

        $jsonResponse->headers->set('Content-Type', 'application/json');

        return $jsonResponse;
    }

    /**
     * Gets a 404 response
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get404Response($message = "Not Found.")
    {
        return $this->getErrorResponse($message, 404);
    }

    /**
     * Gets a 401 response
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get401Response($message = "Unauthorized.")
    {
        return $this->getErrorResponse($message, 401);
    }

    /**
     * Gets a 500 response
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get500Response($message = "Application Error.")
    {
        return $this->getErrorResponse($message, 500);
    }
}
