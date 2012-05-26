<?php

namespace FTC\Bundle\CodeBundle\Controller;

use FTC\Controller\Controller;
use FTC\Bundle\CodeBundle\Entity\Choice\CodeEntryTypeChoices;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * CodeEntry controller.
 *
 * @Route("/type")
 */
class CodeEntryTypeController extends Controller
{
    /**
     * List code entries of a certain type
     *
     * @Route("/{slug}/list", name="entry_type_list")
     * @Template()
     *
     * @param string $slug
     * @return array
     */
    public function listAction($slug)
    {
        /** @var \FTC\Bundle\CodeBundle\Service\CodeEntryService $entryService  */
        $entryService = $this->get('ftc_code.entry');
        $queryBuilder = $entryService->getQueryBuilder();

        $queryBuilder->andWhere('e.type = ?0');
        $queryBuilder->setParameter(0, $slug);

        $entries = $queryBuilder->getQuery()->getResult();
        //Todo: pagination

        $choices = new CodeEntryTypeChoices();

        return array(
            'entries' => $entries,
            'title'   => $choices->getTargetUserText($slug),
            'slug'    => $slug
        );
    }

}