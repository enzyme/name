<?php

namespace Enzyme\Name;

class Formatter implements FormatInterface
{
    /**
     * A local reference to the name being formatted.
     * @var NameInterface
     */
    protected $name;

    /**
     * Create a new formatter given the specified name
     *
     * @param NameInterface $name The name to format.
     */
    public function __construct(NameInterface $name)
    {
        $this->name = $name;
    }

    /**
     * A static method for quickly formatting a name.
     *
     * @param NameInterface $name   The name to format.
     * @param string        $format The format to follow.
     *
     * @return string
     */
    public static function nameLike(NameInterface $name, $format)
    {
        $fmt = new static($name);

        return $fmt->like($format);
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Format and return the given string chunk otherise
     * return null.
     *
     * @param string $string The string to format.
     *
     * @return string | null
     */
    protected function format($string)
    {
        if(strlen(trim($string)) < 1) {
            return null;
        }

        $short = true;
        switch (substr($string, 0, 2)) {
            case 'Fi':
                return $this->processString('First', $this->name->first(), $string);

            case 'F.':
                return $this->processString('F.', $this->name->first($short), $string);

            case 'La':
                return $this->processString('Last', $this->name->last(), $string);

            case 'L.':
                return $this->processString('L.', $this->name->last($short), $string);

            case 'Mi':
                return $this->processString('Middle', $this->name->middle(), $string);

            case 'M.':
                return $this->processString('M.', $this->name->middle($short), $string);

            default:
                return trim($string);
        }
    }

    /**
     * Tries to process the given string chunk, otherwise
     * returns null.
     *
     * @param string $needle The format specifier.
     * @param string $name   The name part.
     * @param string $string The full string to format.
     *
     * @return string | null
     */
    protected function processString($needle, $name, $string)
    {
        if($name === null || strlen($name) < 1) {
            return null;
        }

        return str_replace($needle, $name, $string);
    }
}
