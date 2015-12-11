<?php

namespace Enzyme\Name;

use Stringy\Stringy as S;

class Part
{
    /**
     * A store of the name segments.
     *
     * @var array
     */
    protected $segments = [];

    /**
     * Creates a new part given the string part.
     *
     * @param string $string The name part.
     */
    public function __construct($string)
    {
        $parts = S::create($string)->split(' ');
        $segments = array_filter($parts, function($part) {
            return S::create($part)->trim()->length() > 0;
        });

        $this->segments = $segments;
    }

    /**
     * Returns the long (original) part of this name.
     *
     * @return string
     */
    public function long()
    {
        return implode(' ', $this->segments);
    }

    /**
     * Returns the shortened version of this name.
     *
     * @return string
     */
    public function short()
    {
        $shortened_parts = [];
        foreach ($this->segments as $part) {
            $string = S::create($part);

            if ($string->contains('.')) {
                $shortened_parts[] = $string;
            } else {
                $shortened_parts[] = $string->truncate(2, '.');
            }
        }

        return implode(' ', $shortened_parts);
    }
}