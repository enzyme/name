<?php

namespace Enzyme\Name;

abstract class AbstractName implements NameInterface
{
    /**
     * The stack of name parts.
     *
     * @var array
     */
    protected $nameStack = [];

    /**
     * Construct a new name given the name stack parts.
     *
     * @param array $parts
     */
    private function __construct($parts)
    {
        $this->nameStack = $this->removeUnwantedWhitespace($parts);
    }

    /**
     * Construct a new name from the supplied function arguments.
     * Eg: fromArgs('Hubert', 'Cumberdale')
     *
     * @return self
     */
    public static function fromArgs()
    {
        return new static(func_get_args());
    }

    /**
     * Construct a new name from the supplied array.
     * Eg: fromArray(['Hubert', 'Cumberdale'])
     *
     * @return self
     */
    public static function fromArray($parts)
    {
        return new static($parts);
    }

    /**
     * Construct a new name from the supplied string.
     * Eg: fromString('Hubert Cumberdale')
     *
     * @return self
     */
    public static function fromString($string)
    {
        return new static(explode(' ', $string));
    }

    /**
     * {@inheritdoc}
     */
    abstract public function full();

    /**
     * {@inheritdoc}
     */
    abstract public function first($short = false);

    /**
     * {@inheritdoc}
     */
    abstract public function middle($short = false);

    /**
     * {@inheritdoc}
     */
    abstract public function last($short = false);

    /**
     * {@inheritdoc}
     */
    public function atIndex($index)
    {
        if (array_key_exists($index, $this->nameStack) === false) {
            return null;
        }

        return $this->nameStack[$index];
    }

    /**
     * The number of elements in the name stack.
     *
     * @return int
     */
    protected function stackCount()
    {
        return count($this->nameStack);
    }

    /**
     * Peel back from the end of the name stack at the given depth
     * and return the name portion located there.
     *
     * @param integer $depth The depth to traverse back by.
     *
     * @return string
     */
    protected function peel($depth = 1)
    {
        return $this->nameStack[$this->stackCount() - $depth];
    }

    /**
     * Returns an array slice from the given start (from) and end (to)
     * locations.
     *
     * @param int $from The starting location.
     * @param int $to   The ending location.
     *
     * @return array
     */
    protected function slice($from, $to)
    {
        if ($this->stackCount() < ($to - $from)) {
            return null;
        }

        if ($from < 0 || $from >= $this->stackCount()) {
            return null;
        }

        return array_slice($this->nameStack, $from, ($to - $from));
    }

    /**
     * Shorten the given string part.
     *
     * @param string $part
     *
     * @return string
     */
    protected function shorten($part)
    {
        return substr($part, 0, 1) . '.';
    }

    /**
     * Walks over the array and returns a copy with all unwanted
     * whitespace stripped out.
     *
     * @param array $parts The array to process.
     *
     * @return array
     */
    protected function removeUnwantedWhitespace($parts)
    {
        return array_values(array_filter($parts, function($part) {
            return strlen(trim($part)) > 0;
        }));
    }
}
