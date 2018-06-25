# jroman00/php-coding-standards

This project makes custom code sniffs available to your project

## Getting Started

These instructions will allow you to import this project's sniffs into your own project

### Prerequisites

#### Install PHP_CodeSniffer

Install `PHP_CodeSniffer` by following the instructions found at [https://github.com/squizlabs/PHP_CodeSniffer/]()

#### Set Up a Custom Ruleset

Define a custom `ruleset.xml` in your own project and reference it via:

```
./vendor/bin/phpcs --standard=/path/to/custom_ruleset.xml test.php
```

See [PHP_CodeSniffer's Annotated ruleset.xml](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-ruleset.xml) for more information

### Installation

Once a custom `ruleset.xml` is set up, you'll need to do the following:

#### 1. Add a Custom VCS

In your `composer.json` file, add `https://github.com/jroman00/php-coding-standards.git` as a custom VCS:

```
"repositories": [{
    "type": "vcs",
    "url": "https://github.com/jroman00/php-coding-standards.git"
}],
```

#### 2. Require jroman/php-coding-standards

Import this project via composer, by running the following:

```
composer require --dev jroman00/php-coding-standards
```

#### 3. Add a Custom `installed_path` Entry

Add the following line to your `ruleset.xml` file

```
<config name="installed_paths" value="vendor/jroman00/php-coding-standards" />
```

#### 4. Add the Custom Rule

Add the `Jroman00` ruleset to `ruleset.xml`

```
<rule ref="Jroman00" />
```
