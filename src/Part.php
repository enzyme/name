<?php

namespace Enzyme\Name;

use Stringy\Stringy as S;

class Part
{
    protected $segments = [];

    public function __construct($string)
    {
        $parts = S::create($string)->split(' ');
        $segments = array_filter($parts, function($part) {
            return S::create($part)->trim()->length() > 0;
        });

        $this->segments = $segments;
    }

    public function long()
    {
        return implode(' ', $this->segments);
    }

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