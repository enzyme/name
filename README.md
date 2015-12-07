# Name
Name manipulation library for PHP.

# Installation

```bash
composer require enzyme/name
```

# Usage

#### Standard first and last names.

```php
use Enzyme\Name\Lang\En as Name;

$name = new Name::fromString('Hubert Cumberdale');

echo $name->first(); // Will echo 'Hubert'.
echo $name->last(); // Will echo 'Cumberdale'.
```

#### Formatted first and last names.

```php
use Enzyme\Name\Formatter;
use Enzyme\Name\Lang\En as Name;

$name = new Name::fromString('Hubert Cumberdale');

$fmt = new Formatter($name);
echo $fmt->like('First L.'); // Will echo 'Hubert C.'
echo $fmt->like('Last, F.'); // Will echo 'Cumberdale, H.'

// OR...

// Will echo 'Hubert C.'
echo Formatter::nameLike($name, 'First L.');
```

#### Formatted full names (with middle).

```php
use Enzyme\Name\Formatter;
use Enzyme\Name\Lang\En as Name;

$name = Name::fromString('Hubert Alfred Cumberdale');
$fmt = new Formatter($name);

// Will echo 'Hubert A. Cumberdale'.
echo $fmt->like('First M. Last');
```

# Name options

`$name->first();` Will return the first name.

`$name->last();` Will return the last name.

`$name->middle();` Will return the the middle name(s).

# Formatter Options

The follow examples use the name `Hubert Alfred Smith Cumberdale`

Marker | Returned Name
-------|--------------
First  | Hubert
F.     | H.
Last   | Cumberdale
L.     | C.
Middle | Alfred Smith
M.     | A. S.

Any other character will be left untouched. So for example you can create the name `Cumberdale, H. A. S.` from the following format string `Last, F. M.`

