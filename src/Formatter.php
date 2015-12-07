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
            $formatted_string = $this->format($part);

            if($formatted_string !== null) {
                $final_fmt[] = $formatted_string;
            }
        }

        return implode(' ', $final_fmt);
    }

    protected function format($string)
    {
        if(strlen(trim($string)) < 1) {
            return null;
        }

        $short = true;
        switch (substr($string, 0, 2)) {
            case 'Fi':
                return $this->attemptFormat('First', $this->name->first(), $string);

            case 'F.':
                return $this->attemptFormat('F.', $this->name->first($short), $string);

            case 'La':
                return $this->attemptFormat('Last', $this->name->last(), $string);

            case 'L.':
                return $this->attemptFormat('L.', $this->name->last($short), $string);

            case 'Mi':
                return $this->attemptFormat('Middle', $this->name->middle(), $string);

            case 'M.':
                return $this->attemptFormat('M.', $this->name->middle($short), $string);

            default:
                return trim($string);
        }
    }

    protected function attemptFormat($needle, $name, $string)
    {
        if($name === null || strlen($name) < 1) {
            return null;
        }

        return str_replace($needle, $name, $string);
    }
}
