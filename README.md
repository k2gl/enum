# PHP BackedEnum spiced with syntactic sugar.

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require k2gl/enum
```

## Usage

```php
use K2gl\Enum\src\ExtendedBackedEnumInterface;use K2gl\Enum\Types\ExtendedBackedEnum\ExtendedBackedEnum;

enum CardSuit: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    case HEARTS = 'hearts';
    case DIAMONDS = 'diamonds';
    case CLUBS = 'clubs';
    case SPADES = 'spades';
}

enum ResponseCode: int implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    case HTTP_OK = 200;
    case HTTP_I_AM_A_TEAPOT = 418;
}

$variable = CardSuit::SPADES;
$variable->is(CardSuit::SPADES); // true
$variable->is('spades'); // true
$variable->is(CardSuit::HEARTS); // false

$variable = ResponseCode::HTTP_I_AM_A_TEAPOT;
$variable->isNot(200); // true
$variable->isNot(ResponseCode::HTTP_OK); // true
$variable->isNot(418); // false
$variable->isNot(ResponseCode::HTTP_I_AM_A_TEAPOT); // false

$any = CardSuit::any();
$names = CardSuit::names();
$values = CardSuit::values();
```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

