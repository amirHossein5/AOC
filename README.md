Advent Of Code's codes.

## Usage

Clone repository and:

```sh
composer install
```

Run it:

```sh
php aoc run 2021 1 1   //year day part
```

> Put your puzzle in `puzzle.php` of day folder.

## Creaing New Day

Simply By running:

```sh
php aoc make:day 2021 3     //year day
```

Intended day will be create.

## Testing

Test file for each year is on `tests/Feature` folder, and for testing, put the answer on the appropriate test file.

For example answer of **Year 2021** **day 6** **part 1** becomes `456`, and for **part 2** becomes `654`, So put answer in `tests/Feature/Y2021_Test.php`:

```php
//tests/Feature/Y2021_Test.php
// ...
    private array $answers = [
        'D6' => [
            'part_1' => 456,
            'part_2' => 654,
        ],
        //...
    ]
```

Then run tests:

```sh
./vendor/bin/phpunit
```
