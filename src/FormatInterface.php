<?php

namespace Enzyme\Name;

interface FormatInterface
{
    /**
     * Return the name like shown in the provided format.
     * Eg: 'First L.' => 'Hubert C.'
     *
     * @param string $format The format description.
     *
     * @return string
     */
    public function like($format);
}
