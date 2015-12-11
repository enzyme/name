<?php

namespace Enzyme\Name;

use Stringy\Stringy as S;

class Simple
{
    /**
     * The name prefix.
     *
     * @var Part
     */
    protected $prefix;

    /**
     * The first name.
     *
     * @var Part
     */
    protected $first;

    /**
     * The middle name.
     *
     * @var Part
     */
    protected $middle;

    /**
     * The last name.
     *
     * @var Part
     */
    protected $last;

    /**
     * Create a new name given the specified parts.
     *
     * @param Part|null $prefix The prefix
     * @param Part|null $first  The first name.
     * @param Part|null $middle The middle name.
     * @param Part|null $last   The last name.
     */
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

    /**
     * Try to intelligently create a name from the given string.
     *
     * @param string $name The name.
     *
     * @return Simple
     */
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

    /**
     * Build a name from the given function arguments.
     *
     * @return Simple
     */
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

    /**
     * Return a fresh instance of Simple.
     *
     * @return Simple
     */
    public static function strict()
    {
        return new static();
    }

    /**
     * Set the prefix for this name
     *
     * @param Part $prefix The prefix.
     *
     * @return void
     */
    public function prefix(Part $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Set the first part of this name
     *
     * @param Part $first The first part.
     *
     * @return void
     */
    public function first(Part $first)
    {
        $this->first = $first;

        return $this;
    }

    /**
     * Set the middle part of this name
     *
     * @param Part $middle The middle part.
     *
     * @return void
     */
    public function middle(Part $middle)
    {
        $this->middle = $middle;

        return $this;
    }

    /**
     * Set the last part of this name
     *
     * @param Part $last The last part.
     *
     * @return void
     */
    public function last(Part $last)
    {
        $this->last = $last;

        return $this;
    }

    /**
     * Get the prefix for this name.
     *
     * @return Part
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get the first part of this name.
     *
     * @return Part
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * Get the middle part of this name.
     *
     * @return Part
     */
    public function getMiddle()
    {
        return $this->middle;
    }

    /**
     * Get the last part of this name.
     *
     * @return Part
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Process this name given the segments.
     *
     * @param array $segments The name segments.
     *
     * @return Simple
     */
    protected static function processName($segments)
    {
        $name = new static();

        static::tryExtractPrefix($name, $segments);
        static::tryExtractExtended($name, $segments);
        static::tryExtractStandard($name, $segments);
        static::tryExtractSimple($name, $segments);

        return $name;
    }

    /**
     * Try and extract simply a first name.
     *
     * @param Simple $name     The name to process.
     * @param array &$segments The given segments.
     *
     * @return void
     */
    protected static function tryExtractSimple($name, &$segments)
    {
        if (count($segments) > 0 && count($segments) < 2) {
            // First name.
            $name->first(new Part($segments[0]));
            array_shift($segments);
        }
    }

    /**
     * Try and extract simply a first and last name.
     *
     * @param Simple $name     The name to process.
     * @param array &$segments The given segments.
     *
     * @return void
     */
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

    /**
     * Try and extract a first, middle and last name.
     *
     * @param Simple $name     The name to process.
     * @param array &$segments The given segments.
     *
     * @return void
     */
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

    /**
     * Try and extract the prefix for this name.
     *
     * @param Simple $name     The name to process.
     * @param array &$segments The given segments.
     *
     * @return void
     */
    protected static function tryExtractPrefix($name, &$segments)
    {
        if (stripos($segments[0], '.') !== false) {
            // Prefix.
            $name->prefix(new Part($segments[0]));
            array_shift($segments);
        }
    }
}