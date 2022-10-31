[![Tests](https://github.com/marguskaidja/php-warbsorber/actions/workflows/tests.yml/badge.svg)](https://github.com/marguskaidja/php-warbsorber/actions/workflows/tests.yml)

# Warbsorber (*Warnings absorber*)

#### The Problem
Many built-in PHP functions emit warning messages in case of failures. It's done very dirty - echoing directly to output and catchable only when having [an special error handler installed](https://www.php.net/manual/en/function.set-error-handler).

Modern (proper) way to transfer failure details would be of course by using _Exceptions_ but due legacy reasons that's not possible for lot's of old built-in functions and will probably never be  "fixed".

#### The Solution
This library provides a wrapper for executing arbitrary _codeblock_, which has tendency to spit out warnings, notices or errors.

All those messages are "absorbed" by the wrapper and returned nicely after the _codeblock_ is executed for later inspection. 

## Requirements

Requires:
* PHP >= 8.0

## Installation

Install with composer:
```bash
composer require margusk/warbsorber
```

## Usage
```php
use function margusk\Warbsorber;

$fopenWarnings = Warbsorber(function () use (&$fp) {
    $fp = fopen("php://non-existent-stream", "r");
});

if (!$fp) {
    echo "fopen() failed with messages: \n";

    foreach ($fopenWarnings as $entry) {
        echo "- " . $entry->errStr . "\n";
    }
}
```
Output:
```bash
fopen() failed with messages:
- fopen(): Invalid php:// URL specified
- fopen(php://non-existent-stream): Failed to open stream: operation failed
```

The code above shows how we're calling [fopen](https://www.php.net/manual/en/function.fopen.php) which is destined to fail. Instead of just getting `false` as return value we also catch textual reasons why the call failed. Those reasons can be later presented to end user for fixing.

### Remove function name from the beginning of message

What if we want to concatenate all messages into single paragraph? We already know that the messages are related to `fopen()` so message beginnings (`fopen():` and `fopen(php://non-existent-stream):`) are actually irrelevant and excessive information.

Let's get rid of them by using `removeFunctionPrefix(string $funcName)` method:
```php
use function margusk\Warbsorber;

$fopenWarnings = Warbsorber(function () use (&$fp) {
    $fp = fopen("php://non-existent-stream", "r");
});

if (!$fp) {
    $fopenWarnings = $fopenWarnings->removeFunctionPrefix('fopen');

    echo "fopen() failed with: "
        .implode(
            '. ',
            array_map(
                fn(Entry $e) => $e->errStr,
                $fopenWarnings->getArrayCopy()
            )
        )
        .".\n";
}
```
Now the output is much cleaner:
```bash
fopen() failed with: Invalid php:// URL specified. Failed to open stream: operation failed.
```

**Note** that `$fopenWarnings` is immutable object, which makes `removeFunctionPrefix` to return cloned instance with modified data.

### Catch messages only with specific error levels

By default all messages regardless of level (e.g. `E_WARNING`, `E_NOTICE` etc.) are catched during codeblock execution. However this can be changed if needed by adding second parameter to `Warbsorber` call:
```php
use function margusk\Warbsorber;

$fopenWarnings = Warbsorber(function () use (&$fp) {
    $fp = fopen("php://non-existent-stream", "r");
}, E_WARNING | E_NOTICE | E_DEPRECATED);
```
This catches only messages with level `E_WARNING`, `E_NOTICE` or `E_DEPRECATED`

## Documentation
Main wrapper `Warbsorber(\Closure $callback, int $level = E_ALL): Warnings;` returns instance of `margusk\Warbsorber\Warnings`

### Class `margusk\Warbsorber\Warnings`
* Implements `IteratorAggregate`, `Countable` and `ArrayAccess`
* Each entry is instance of `margusk\Warbsorber\Entry`
* Method `getArrayCopy(): array` returns messages in native array
* Method `removeFunctionPrefix(string $funcName): static` removes specified function name from beginning of messages and returns cloned instance of itself

### Class `margusk\Warbsorber\Entry`
* Holds data for a single message:
  * `$entry->errNo` gets you error level
  * `$entry->errStr` gets you error message
  * `$entry->errFile` gets you file which triggered the error
  * `$entry->errLine` gets you line which triggered the error

## License
This library is released under the MIT License.