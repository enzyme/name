<img src="https://cloud.githubusercontent.com/assets/2805249/11685005/7af1aa74-9ec1-11e5-924c-711068f7adde.png" width="200">

[![Build Status](https://travis-ci.org/enzyme/name.svg?branch=master)](https://travis-ci.org/enzyme/name)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/enzyme/name/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/enzyme/name/?branch=master)
[![Coverage Status](https://coveralls.io/repos/enzyme/name/badge.svg?branch=master&service=github)](https://coveralls.io/github/enzyme/name?branch=master)

Name manipulation library for PHP.

# What is it?

If your website accepts user data in the form of *First Name*, *Last Name* and optionally *Middle* and/or *Prefix (Dr., Mrs.)* and then you would like to format the data - this package is for you.

# Installation

```bash
composer require enzyme/name
```

# Usage

#### Standard first and last names.

```php
use Enzyme\Name\Simple;

$name = Simple::fromString('Hubert Cumberdale');
echo $name->getFirst(); // Hubert
echo $name->getLast(); // Hubert
```

#### Formatted first and last names.

```php
use Enzyme\Name\Simple;
use Enzyme\Name\Format;

$name = Simple::fromString('Hubert Cumberdale');
$fmt = Format($name);

echo $fmt->like('First'); // Hubert
echo $fmt->like('First L.'); // Hubert C.
echo $fmt->like('Last, F.'); // Cumberdale, H.

// Quickfire option.
echo Format::nameLike($name, 'First L.'); // Hubert C.
```

#### Formatted full names (with middle/prefix).

```php
use Enzyme\Name\Simple;
use Enzyme\Name\Format;

$name = Simple::fromString('Dr. Hubert Alberto Cumberdale');

echo Format::nameLike($name, 'First M. Last'); // Hubert A. Cumberdale
echo Format::nameLike($name, 'P. First M. Last'); // Dr. Hubert A. Cumberdale
echo Format::nameLike($name, 'P. Last, F. M.'); // Dr. Cumberdale, H. A.
```

# Name options

`Simple` exposes the follow accessors which return `Part` instances.

`$name->getPrefix();`
`$name->getFirst();`
`$name->getMiddle();`
`$name->getLast();`

Each `Part` has two options:

`$part->long()` Returns the long version of the name, eg: Hubert
`$part->short()` Returns the short version of the name, eg: H.

You can build a new name in 3 ways:

`Simple::fromString(...)` Simply pass in a string and it will 'intelligently' try and parse the name out from it.

`Simple::fromArgs(...)` Simply pass in arguments and it will try and build the full name from them. The name is build based on the number of arguments passed in, so 1 argument equals to the `first` name, 2 -> `first last`, 3 -> `first middle last` and 4 -> `prefix first middle last`. 

So to create the name `Hubert Cumberdale` using the `fromArgs` constructor, it would look like `Simple::fromArgs('Hubert', 'Cumberdale');`.

The last option give you the most control, `Simple::strict()`. It simply returns a new `Simple` object which you then explicitly build up using the setters: `$simple->prefix(...);`, `$simple->first(...);`, `$simple->middle(...);` and `$simple->last(...);`. Each setter can be optionally called to build names of different configurations.

# Formatter Options

The following examples use the name `Mr. Hubert Alfred Smith Cumberdale`

Marker | Returned Name
-------|--------------
Prefix | Mr.
P.     | Mr.
First  | Hubert
F.     | H.
Last   | Cumberdale
L.     | C.
Middle | Alfred Smith
M.     | A. S.

Any other character will be left untouched. So for example you can create the name `Cumberdale, H. A. S.` from the following format string `Last, F. M.`

