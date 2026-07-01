# PHP BackedEnum spiced with syntactic sugar.

[![CI](https://img.shields.io/github/actions/workflow/status/k2gl/enum/ci.yml?branch=main&label=CI&logo=github)](https://github.com/k2gl/enum/actions/workflows/ci.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/k2gl/enum?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/enum)
[![Total Downloads](https://img.shields.io/packagist/dt/k2gl/enum?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/enum)
[![PHPStan Level](https://img.shields.io/badge/PHPStan-level%209-2a5ea7?logo=php&logoColor=white)](https://phpstan.org)
[![License](https://img.shields.io/packagist/l/k2gl/enum?color=yellowgreen)](https://packagist.org/packages/k2gl/enum)

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require k2gl/enum
```

## Usage

```php
use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;

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

// Set membership — is()/isNot() for a list of cases or raw values.
$suit = CardSuit::SPADES;
$suit->in(CardSuit::HEARTS, CardSuit::SPADES); // true
$suit->in('hearts', 'clubs');                  // false
$suit->in(...[CardSuit::HEARTS, CardSuit::SPADES]); // true (spread an array)
$suit->notIn(CardSuit::HEARTS, CardSuit::CLUBS);    // true

CardSuit::names(); // ['HEARTS', 'DIAMONDS', 'CLUBS', 'SPADES'] 
CardSuit::values(); // ['hearts', 'diamonds', 'clubs', 'spades']

// Resolve a case by its name — the counterpart of the native from()/tryFrom(),
// which only resolve by backing value.
CardSuit::fromName('SPADES');    // CardSuit::SPADES
CardSuit::tryFromName('SPADES'); // CardSuit::SPADES
CardSuit::tryFromName('joker');  // null
CardSuit::fromName('joker');     // throws \ValueError
```

### Labels and form options

Attach a human-readable label to a case with `#[Label]`. `label()` returns it,
falling back to the raw case name when the attribute is absent; `options()`
builds a `value => label` map ready for a dropdown; `labels()` lists every
label; and `fromLabel()`/`tryFromLabel()` resolve a case back from its label.

```php
use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Label;

enum OrderStatus: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    #[Label('Awaiting payment')]
    case PENDING = 'pending';

    #[Label('Paid')]
    case PAID = 'paid';

    case SHIPPED = 'shipped'; // no #[Label] — label() falls back to the name
}

OrderStatus::PENDING->label(); // 'Awaiting payment'
OrderStatus::SHIPPED->label(); // 'SHIPPED'

OrderStatus::options();
// ['pending' => 'Awaiting payment', 'paid' => 'Paid', 'shipped' => 'SHIPPED']

// Render an HTML <select>:
foreach (OrderStatus::options() as $value => $label) {
    echo "<option value=\"{$value}\">{$label}</option>";
}

// Symfony ChoiceType expects label => value, so flip it:
// 'choices' => array_flip(OrderStatus::options())

OrderStatus::labels();
// ['Awaiting payment', 'Paid', 'SHIPPED']

// Reverse of label() — resolve a case from a (form-submitted) label:
OrderStatus::fromLabel('Awaiting payment'); // OrderStatus::PENDING
OrderStatus::tryFromLabel('Paid');          // OrderStatus::PAID
OrderStatus::tryFromLabel('Refunded');      // null
OrderStatus::fromLabel('Refunded');         // throws \ValueError
```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

