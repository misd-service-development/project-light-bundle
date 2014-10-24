<?php

namespace Misd\ProjectLightBundle\Menu;

use Knp\Menu\ItemInterface as MenuItem;
use Knp\Menu\Renderer\ListRenderer;

/**
 * Menu renderer.
 */
final class MenuRenderer extends ListRenderer
{
    protected function renderList(
      MenuItem $item,
      array $attributes,
      array $options
    ) {
        if (false === isset($attributes['class'])) {
            $attributes['class'] = array();
        } else {
            $class = (array) $attributes['class'];
        }

        $class[] = 'campl-unstyled-list';

        $attributes['class'] = implode(' ', $class);

        return parent::renderList($item, $attributes, $options);
    }

    protected function renderItem(MenuItem $item, array $options)
    {
        if ($item->getLevel() > 1 && $this->matcher->isCurrent($item)) {
            $class = (array) $item->getAttribute('class');

            $class[] = 'campl-current-page';

            $item->setAttribute('class', implode(' ', $class));
        }

        return parent::renderItem($item, $options);
    }

    protected function renderLinkElement(MenuItem $item, array $options)
    {
        if ($item->getLevel() <= 1 && ($this->matcher->isCurrent($item) || $this->matcher->isAncestor($item))) {
            $class = (array) $item->getLinkAttribute('class');

            $class[] = 'campl-selected';

            $item->setLinkAttribute('class', implode(' ', $class));
        }

        return parent::renderLinkElement($item, $options);
    }
}
