<?php

namespace FTC\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTC\Bundle\CodeBundle\Entity\Choice\CodeEntryTypeChoices;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $categories = new CodeEntryTypeChoices();

        $entryService = $this->get('ftc_code.entry');
        $latest = $entryService->getLatest(10);

        $sortedEntries = array();
        $categoryFilter = function($entry) use (&$sortedEntries) {

            if (!isset($sortedEntries[$entry->getType()])) {
                $sortedEntries[$entry->getType()] = array();
            }

            $sortedEntries[$entry->getType()][] = $entry;
        };

        $latest->map($categoryFilter);

        return array(
            'entries'    => $sortedEntries,
            'categories' => $categories->getTargetUserChoices()
        );
    }
}
