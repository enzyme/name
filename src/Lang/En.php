<?php

namespace Enzyme\Name\Lang;

use Enzyme\Name\AbstractName;

class En extends AbstractName
{
    /**
     * {@inheritdoc}
     */
    public function full()
    {
        return implode(' ', $this->nameStack);
    }

    /**
     * {@inheritdoc}
     */
    public function first($short = false)
    {
        return $short === true
            ? $this->shorten($this->nameStack[0])
            : $this->nameStack[0];
    }

    /**
     * {@inheritdoc}
     */
    public function middle($short = false)
    {
        $middles = $this->slice(1, $this->stackCount() - 1);
        if ($middles === null) {
            return null;
        }

        if ($short === true) {
            array_walk($middles, function(&$part) {
                $part = $this->shorten($part);
            });
        }

        return implode(' ', $middles);
    }

    /**
     * {@inheritdoc}
     */
    public function last($short = false)
    {
        if ($this->stackCount() < 2) {
            return null;
        }

        return $short === true
            ? $this->shorten($this->peel())
            : $this->peel();
    }
}
