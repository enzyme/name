<?php

namespace Enzyme\Name;

class Formatter implements FormatInterface
{
    protected $name;

    public function __construct(NameInterface $name)
    {
        $this->name = $name;
    }

    public static function nameLike(NameInterface $name, $format)
    {
        $fmt = new static($name);

        return $fmt->like($format);
    }

    public function like($format)
    {
        $fmt_parts = explode(' ', $format);
        $final_fmt = [];

        foreach ($fmt_parts as $part) {
            $final_fmt[] = $this->format($part);
        }

        return implode(' ', $final_fmt);
    }

    protected function format($string)
    {
        $short = true;

        switch (substr($string, 0, 2)) {
            case 'Fi':
                return str_replace('First', $this->name->first(), $string);
                break;

            case 'F.':
                return str_replace('F.', $this->name->first($short), $string);
                break;

            case 'La':
                return str_replace('Last', $this->name->last(), $string);
                break;

            case 'L.':
                return str_replace('L.', $this->name->last($short), $string);
                break;

            case 'Mi':
                return str_replace('Middle', $this->name->middle(), $string);
                break;

            case 'M.':
                return str_replace('M.', $this->name->middle($short), $string);
                break;

            default:
                return $string;
                break;
        }
    }
}
