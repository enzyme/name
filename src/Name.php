<?php

namespace Enzyme;

class Name
{
    protected $nameStack = [];

    private function __construct($parts)
    {
        $this->nameStack = $parts;
    }

    public static function fromArgs()
    {
        return new static(func_get_args());
    }

    public static function fromArray($parts)
    {
        return new static($parts);
    }

    public static function fromString($string)
    {
        return new static(explode(' ', $string));
    }

    public function full()
    {
        return implode(' ', $this->nameStack);
    }

    public function first()
    {
        return $this->nameStack[0];
    }

    public function middle()
    {
        if($this->stackCount() < 3) {
            return null;
        }

        $middles = [];
        for ($i = 1; $i < $this->stackCount() - 1; $i++) {
            $middles[] = $this->nameStack[$i];
        }

        return implode(' ', $middles);
    }

    public function last()
    {
        return ($this->stackCount() < 2)
            ? null
            : $this->peel();
    }

    public function atIndex($index)
    {
        if(array_key_exists($index, $this->nameStack) === false) {
            return null;
        }

        return $this->nameStack[$index];
    }

    private function stackCount()
    {
        return count($this->nameStack);
    }

    private function peel($layers = 1)
    {
        return $this->nameStack[$this->stackCount() - $layers];
    }
}