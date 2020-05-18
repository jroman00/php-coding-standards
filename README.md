<!-- omit in toc -->
# jroman00/php-coding-standards

This project makes custom PHP code sniffs available to your project

<!-- omit in toc -->
## Summary

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
    - [Install PHP_CodeSniffer](#install-phpcodesniffer)
    - [Set Up a Custom Ruleset](#set-up-a-custom-ruleset)
  - [Installation](#installation)
    - [1. Add a Custom VCS](#1-add-a-custom-vcs)
    - [2. Require jroman/php-coding-standards](#2-require-jromanphp-coding-standards)
    - [3. Add a Custom `installed_path` Entry](#3-add-a-custom-installedpath-entry)
    - [4. Add the Custom Rule](#4-add-the-custom-rule)
    - [5. Lint Your Code](#5-lint-your-code)
- [Contributing](#contributing)

## Getting Started

These instructions will allow you to import this project's sniffs into your own project

### Prerequisites

#### Install PHP_CodeSniffer

Install `PHP_CodeSniffer` by following the instructions found at https://github.com/squizlabs/PHP_CodeSniffer/

#### Set Up a Custom Ruleset

Define a custom `ruleset.xml` in your own project. See [PHP_CodeSniffer's Annotated ruleset.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml) for more information

### Installation

Once a custom `ruleset.xml` is set up, you'll need to do the following:

#### 1. Add a Custom VCS

In your `composer.json` file, add `https://github.com/jroman00/php-coding-standards.git` as a custom VCS:

```json
"repositories": [{
    "type": "vcs",
    "url": "https://github.com/jroman00/php-coding-standards.git"
}],
```

#### 2. Require jroman/php-coding-standards

Import this project via composer, by running the following:

```bash
composer require --dev jroman00/php-coding-standards
```

#### 3. Add a Custom `installed_path` Entry

Add the following line to your `ruleset.xml` file

```xml
<config name="installed_paths" value="vendor/jroman00/php-coding-standards" />
```

#### 4. Add the Custom Rule

Add the `Jroman00` ruleset to `ruleset.xml`

```xml
<rule ref="Jroman00" />
```

#### 5. Lint Your Code

```bash
./vendor/bin/phpcs --standard=./ruleset.xml example.php
```

## Contributing

When contributing to this repository, please first discuss the change you wish to make via an issue, an email, or any other method with the owners of this repository before making a change

Please read [CONTRIBUTING.md](./CONTRIBUTING.md) and [CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md) for more details
