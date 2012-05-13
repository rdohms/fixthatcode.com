<?php

namespace FTC\Bundle\ApiBundle\Controller;

use FTC\Controller\Controller;

/**
 * API Base Controller
 *
 * Base controller that implements functions for easier response
 */
abstract class BaseController extends Controller
{

    /**
     * @return \FTC\Bundle\ApiBundle\Service\JsonResponder
     */
    protected function getResponder()
    {
        return $this->get('ftc_api.json_responder');
    }

}
