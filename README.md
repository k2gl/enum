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

$suit = CardSuit::any(); // random CardSuit 
$suit = CardSuit::anyoneExcept(CardSuit::CLUBS); // random CardSuit except 'clubs'
$suit = CardSuit::anyoneExcept([CardSuit::HEARTS, CardSuit::DIAMONDS]); // random CardSuit except 'hearts' and 'diamonds'

$suit = CardSuit::SPADES;
$suit->is(CardSuit::SPADES); // true
$suit->is('spades'); // true
$suit->is(CardSuit::HEARTS); // false

$suit = ResponseCode::HTTP_I_AM_A_TEAPOT;
$suit->isNot(200); // true
$suit->isNot(ResponseCode::HTTP_OK); // true
$suit->isNot(418); // false
$suit->isNot(ResponseCode::HTTP_I_AM_A_TEAPOT); // false

CardSuit::names(); // ['HEARTS', 'DIAMONDS', 'CLUBS', 'SPADES'] 
CardSuit::values(); // ['hearts', 'diamonds', 'clubs', 'spades']
```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

