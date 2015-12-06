<?php

namespace Enzyme\Name;

interface NameInterface
{
    /**
     * Return the full name, including first, middle and last.
     *
     * @return string
     */
    public function full();

    /**
     * Return just the first name.
     *
     * @param boolean $short Whether to return a shortened version.
     *
     * @return string
     */
    public function first($short = false);

    /**
     * Return just the middle name(s).
     *
     * @param boolean $short Whether to return a shortened version.
     *
     * @return string
     */
    public function middle($short = false);

    /**
     * Return just the last name.
     *
     * @param boolean $short Whether to return a shortened version.
     *
     * @return string
     */
    public function last($short = false);

    /**
     * Return the portion of the name at the given index.
     *
     * @param int $index The index position.
     *
     * @return string
     */
    public function atIndex($index);
}
