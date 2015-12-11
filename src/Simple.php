<?php

namespace Enzyme\Name;

use Stringy\Stringy as S;

class Simple
{
    protected $prefix;
    protected $first;
    protected $middle;
    protected $last;

    protected function __construct(
        Part $prefix = null,
        Part $first = null,
        Part $middle = null,
        Part $last = null
    ) {
        $this->prefix = $prefix;
        $this->first = $first;
        $this->middle = $middle;
        $this->last = $last;
    }

    public static function fromString($name)
    {
        $name = S::create($name)->collapseWhitespace();

        $parts = $name->split(' ');
        $segments = array_filter($parts, function($part) {
            return S::create($part)->trim()->length() > 0;
        });

        $count = count($segments);

        if ($count < 1) {
            throw new NameException('The string provided could not be processed.');
        }

        return static::processName($segments);
    }

    public static function fromArgs()
    {
        $num_args = func_num_args();
        $args = func_get_args();

        switch ($num_args) {
            case 0:
                throw new NameException('At least one argument should be passed.');

            case 1:
                return new static(
                    null,
                    new Part($args[0])
                );

            case 2:
                return new static(
                    null,
                    new Part($args[0]),
                    null,
                    new Part($args[1])
                );

            case 3:
                return new static(
                    null,
                    new Part($args[0]),
                    new Part($args[1]),
                    new Part($args[2])
                );

            case 4:
                return new static(
                    new Part($args[0]),
                    new Part($args[1]),
                    new Part($args[2]),
                    new Part($args[3])
                );

            default:
                throw new NameException('Too many arguments provided.');
        }
    }

    public static function strict()
    {
        return new static();
    }

    public function prefix(Part $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function first(Part $first)
    {
        $this->first = $first;

        return $this;
    }

    public function middle(Part $middle)
    {
        $this->middle = $middle;

        return $this;
    }

    public function last(Part $last)
    {
        $this->last = $last;

        return $this;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getFirst()
    {
        return $this->first;
    }

    public function getMiddle()
    {
        return $this->middle;
    }

    public function getLast()
    {
        return $this->last;
    }

    protected static function processName($segments)
    {
        $name = new static();

         static::tryExtractPrefix($name, $segments);
         static::tryExtractExtended($name, $segments);
         static::tryExtractStandard($name, $segments);
         static::tryExtractSimple($name, $segments);

        return $name;
    }

    protected static function tryExtractSimple($name, &$segments)
    {
        if (count($segments) > 0 && count($segments) < 2) {
            // First name.
            $name->first(new Part($segments[0]));
            array_shift($segments);
        }
    }

    protected static function tryExtractStandard($name, &$segments)
    {
        if (count($segments) > 0 && count($segments) === 2) {
            // First name.
            $name->first(new Part($segments[0]));
            array_shift($segments);

            // Last name.
            $name->last(new Part(array_pop($segments)));
        }
    }

    protected static function tryExtractExtended($name, &$segments)
    {
        if (count($segments) > 2) {
            // First name.
            $name->first(new Part($segments[0]));
            array_shift($segments);

            // Last name.
            $name->last(new Part(array_pop($segments)));

            // Middle name.
            $name->middle(new Part(implode(' ', $segments)));
            $segments = [];
        }
    }

    protected static function tryExtractPrefix($name, &$segments)
    {
        if (stripos($segments[0], '.') !== false) {
            // Prefix.
            $name->prefix(new Part($segments[0]));
            array_shift($segments);
        }
    }
}