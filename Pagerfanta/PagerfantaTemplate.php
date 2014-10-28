<?php

namespace Misd\ProjectLightBundle\Pagerfanta;

use Pagerfanta\View\Template\Template;

/**
 * Pagerfanta template.
 */
final class PagerfantaTemplate extends Template
{
    public function container()
    {
        return '<div class="campl-pagination campl-pagination-centered"><ul>%pages%</ul></div>';
    }

    public function page($page)
    {
        $href = $this->generateRoute($page);

        return '<li><a href="' . $href . '">' . $page . '</a></li>';
    }

    public function pageWithText($page, $text)
    {
        $href = $this->generateRoute($page);

        return '<li><a href="' . $href . '">' . $text . '</a></li>';
    }

    public function previousDisabled()
    {
        return '';
    }

    public function previousEnabled($page)
    {
        $href = $this->generateRoute($page);

        return '<li class="campl-previous-li"><a href="' . $href . '" class="ir campl-pagination-btn campl-previous"><span class="campl-arrow-span"></span>previous</a></li>';
    }

    public function nextDisabled()
    {
        return '';
    }

    public function nextEnabled($page)
    {
        $href = $this->generateRoute($page);

        return '<li class="campl-next-li"><a href="' . $href . '" class="ir campl-pagination-btn campl-next"><span class="campl-arrow-span"></span>next</a></li>';
    }

    public function first()
    {
        return '';
    }

    public function last($page)
    {
        return '';
    }

    public function current($page)
    {
        $href = $this->generateRoute($page);

        return '<li class="campl-active"><a href="' . $href . '">' . $page . '</a></li>';
    }

    public function separator()
    {
        return '<li><span class="campl-elipsis">...</span></li>';
    }
}
