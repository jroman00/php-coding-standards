<!-- omit in toc -->
# jroman00/php-coding-standards

This project makes custom PHP code sniffs available to your project

<!-- omit in toc -->
## Table of Contents

* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
    * [Install PHP\_CodeSniffer](#install-php_codesniffer)
  * [Installation](#installation)
    * [1. Add a Custom VCS](#1-add-a-custom-vcs)
    * [2. Require this Library](#2-require-this-library)
    * [3. Define a Custom Ruleset.xml](#3-define-a-custom-rulesetxml)
    * [4. Lint Your Code](#4-lint-your-code)
* [Contributing](#contributing)

## Getting Started

These instructions will allow you to import this project's sniffs into your own project

### Prerequisites

#### Install PHP_CodeSniffer

```sh
composer require --dev squizlabs/phpcs
```

For more information, see https://github.com/squizlabs/PHP_CodeSniffer/

### Installation

#### 1. Add a Custom VCS

In your `composer.json` file, add `https://github.com/jroman00/php-coding-standards.git` as a custom VCS:

```json
"repositories": [{
    "type": "vcs",
    "url": "https://github.com/jroman00/php-coding-standards.git"
}],
```

#### 2. Require this Library

Import this project via composer, by running the following:

```sh
composer require --dev jroman00/php-coding-standards
```

#### 3. Define a Custom Ruleset.xml

In your `ruleset.xml`, add the following:

1. An entry for `installed_paths` for this library
2. A rule for this library

```xml
<?xml version="1.0"?>
<ruleset>
    <description>Coding standards</description>

    <!-- jroman00/php-coding-standards -->
    <config name="installed_paths" value="vendor/jroman00/php-coding-standards" />

    <!-- Jroman00 -->
    <rule ref="Jroman00" />

    <!-- Additional configs can go here -->
    <!-- ... -->
</ruleset>
```

For more information, see [PHP_CodeSniffer's Annotated ruleset.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml)

#### 4. Lint Your Code

```sh
./vendor/bin/phpcs -p --standard=./ruleset.xml src/
```

## Contributing

When contributing to this repository, please first discuss the change you wish to make via an issue, an email, or any other method with the owners of this repository before making a change

Please read [CONTRIBUTING.md](./CONTRIBUTING.md) and [CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md) for more details
