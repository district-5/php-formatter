# District5 PHP Core Libraries - Formatter

## Installation
Use composer to add this library as a dependency onto your project.

```javascript
composer require district5/formatter
```

## Usage
### Using a formatter
Utility middleware classes are included for the following areas of functionality:
```php
// single object for format
$formatted = MyFormatter::formatSingle($model);

// multiple objects for format
$formatted = MyFormatter::formatMultiple($models);
```

### Creating a formatter
Create your own formatter by extending `FormatterAbstract` and implementing the formatSingle function. The abstract will automatically give you the `formatMultiple` functionality.
```php
use District5\Formatter\FormatterAbstract;

class MyFormatter extends FormatterAbstract
{
    public static function formatSingle($item, array $options = null)
    {
        return [
            'field1' => 'someValue',
            'field2' => 5
        ];
    }
}
```
`FormatterAbstract` also includes a function to aid with more complex decisions for content inclusion:
```php
use District5\Formatter\FormatterAbstract;

class MyComplexFormatter extends FormatterAbstract
{
    public static function formatSingle($item, array $options = null)
    {
        $formatted = array(
            'id' => $item->getIdStr(),
            'created' => $item->getCreatedDateMillis(),
            'title' => $item->getTitle(),
            'text' => $item->getText()
        );
        
        if (false !== static::getOption('includeCoverImage', $options, false)) {
            $formatted['coverImage'] = $item->getCoverImagePath();
        }
        
        if (false !== static::getOption('includeOwnerId', $options, false)) {
            $formatted['ownerId'] = $item->getUserId(true);
        }
        
        return $formatted;
    }
}
```
This could then be called with the following:
```php
// single object for format
$formatted = MyComplexFormatter::formatSingle(
    $model,
    [
        'includeCoverImage' => true
    ]
);

// multiple objects for format
$formatted = MyComplexFormatter::formatMultiple(
    $models,
    [
        'includeCoverImage' => true,
        'includeOwnerId' => true
    ]
);
```
