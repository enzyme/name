<?php

namespace Enzyme\Name;

use Stringy\Stringy as S;

class Format
{
    protected $name;

    public function __construct(Simple $name)
    {
        $this->name = $name;
    }

    public static function nameLike(Simple $name, $format_string)
    {
        $fmt = new static($name);
        return $fmt->like($format_string);
    }

    public function like($format_string)
    {
        $string = S::create($format_string)->collapseWhitespace();
        $parts = $string->split(' ');

        $final_parts = [];
        foreach ($parts as $part) {
            $final_parts[] = $this->format($part);
        }

        return S::create(implode(' ', $final_parts))->collapseWhitespace();
    }

    protected function format($part)
    {
        $part = S::create($part);

        switch ($part->substr(0, 2)) {
            case 'Pr':
                return $part->replace('Prefix', $this->tryGetLongVersion($this->name->getPrefix()));

            case 'Fi':
                return $part->replace('First', $this->tryGetLongVersion($this->name->getFirst()));

            case 'Mi':
                return $part->replace('Middle', $this->tryGetLongVersion($this->name->getMiddle()));

            case 'La':
                return $part->replace('Last', $this->tryGetLongVersion($this->name->getLast()));

            case 'P.':
                return $part->replace('P.', $this->tryGetShortVersion($this->name->getPrefix()));

            case 'F.':
                return $part->replace('F.', $this->tryGetShortVersion($this->name->getFirst()));

            case 'M.':
                return $part->replace('M.', $this->tryGetShortVersion($this->name->getMiddle()));

            case 'L.':
                return $part->replace('L.', $this->tryGetShortVersion($this->name->getLast()));

            default:
                return $part;
        }
    }

    protected function tryGetLongVersion($part)
    {
        return $part !== null
            ? $part->long()
            : '';
    }

    protected function tryGetShortVersion($part)
    {
        return $part !== null
            ? $part->short()
            : '';
    }
}