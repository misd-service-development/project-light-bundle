<?php

namespace Misd\ProjectLightBundle\Pagerfanta;

use Pagerfanta\PagerfantaInterface as Pagerfanta;
use Pagerfanta\View\Template\Template as PagerfantaTemplate;
use Pagerfanta\View\ViewInterface as View;

/**
 * Pagerfanta view.
 */
final class PagerfantaView implements View
{
    /**
     * @var Pagerfanta
     */
    private $pagerfanta;

    /**
     * @var PagerfantaTemplate
     */
    private $template;

    /**
     * @var integer
     */
    private $currentPage;

    /**
     * @var integer
     */
    private $numberOfPages;

    public function __construct(PagerfantaTemplate $template)
    {
        $this->template = $template;
    }

    public function render(
      Pagerfanta $pagerfanta,
      $routeGenerator,
      array $options = array()
    ) {
        $this->pagerfanta = $pagerfanta;
        $this->currentPage = $pagerfanta->getCurrentPage();
        $this->numberOfPages = $pagerfanta->getNbPages();

        $this->template->setRouteGenerator($routeGenerator);
        $this->template->setOptions($options);

        return $this->generate();
    }

    private function generate()
    {
        $pages = $this->generatePages();

        return $this->generateContainer($pages);
    }

    private function generateContainer($pages)
    {
        return str_replace('%pages%', $pages, $this->template->container());
    }

    private function generatePages()
    {
        return $this->previous() . $this->first() . $this->second() . $this->third() . $this->fourth() . $this->last() . $this->next();
    }

    private function previous()
    {
        if ($this->pagerfanta->hasPreviousPage()) {
            return $this->template->previousEnabled($this->pagerfanta->getPreviousPage());
        }

        return $this->template->previousDisabled();
    }

    private function first()
    {
        if (1 === $this->currentPage) {
            return $this->template->current(1);
        }

        return $this->template->page(1);
    }

    private function second()
    {
        if ($this->numberOfPages <= 2) {
            return '';
        } elseif (1 === $this->currentPage || 3 === $this->currentPage || ((4 === $this->currentPage || 5 === $this->currentPage) && 5 === $this->numberOfPages) || (4 === $this->currentPage && 4 === $this->numberOfPages)) {
            return $this->template->page(2);
        } elseif (2 === $this->currentPage) {
            return $this->template->current($this->currentPage);
        }

        return $this->template->separator();
    }

    private function third()
    {
        if ($this->numberOfPages <= 4) {
            return '';
        } elseif ($this->currentPage <= 2) {
            return '';
        } elseif ($this->numberOfPages > 5 && ($this->currentPage === $this->numberOfPages)) {
            return '';
        } elseif ($this->currentPage >= ($this->numberOfPages - 1)) {
            return $this->template->page($this->numberOfPages - 2);
        }

        return $this->template->current($this->currentPage);
    }

    private function fourth()
    {
        if ($this->numberOfPages <= 3) {
            return '';
        } elseif ($this->currentPage === ($this->numberOfPages - 2)) {
            return $this->template->page($this->currentPage + 1);
        } elseif ($this->currentPage === ($this->numberOfPages - 1)) {
            return $this->template->current($this->currentPage);
        } elseif ($this->currentPage === $this->numberOfPages) {
            return $this->template->page($this->currentPage - 1);
        } elseif (4 === $this->numberOfPages) {
            return $this->template->page(3);
        }

        return $this->template->separator();
    }

    private function last()
    {
        if (1 === $this->numberOfPages) {
            return '';
        } elseif ($this->numberOfPages === $this->currentPage) {
            return $this->template->current($this->numberOfPages);
        }

        return $this->template->page($this->numberOfPages);
    }

    private function next()
    {
        if ($this->pagerfanta->hasNextPage()) {
            return $this->template->nextEnabled($this->pagerfanta->getNextPage());
        }

        return $this->template->nextDisabled();
    }

    public function getName()
    {
        return 'project_light';
    }
}
