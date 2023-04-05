# Helper package for Laravel

## Installation

You can install this plugin into your Laravel application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require codelife/codelife-helpers
```

### Setting up

Publish migrations using below command: 
```
php artisan vendor:publish --provider="Codelife\CodelifeHelpers\Providers\HelperServiceProvider" --tag="migrations"
```

Then, add the code below to load this package as one of the providers
Go into your config/app.php directory then paste the following in providers group

```
....Above providers
Codelife\CodelifeHelpers\Providers\HelperServiceProvider::class,
....Below Providers
```

Execute artisan command migrate using the below commands to migrate Helpers activity logger table
```
php artisan migrate
```

### Usage 
# You can use this helper in your index view, adding, editing and deleting of model entity using below codes:

# Usage in index function
```php
use App\Models\Todo; // This is the model of target table
use Codelife\CodelifeHelpers\Helper; // namespace of helper
...

...
public function index(){
    ...
    // First use
    // with custom second parameter
    new Helper(new Todo, 'Your custom activity message here');

    // Second use
    // with custom second parameter
    new Helper(new Todo);
    ...
}
...

```

# Usage in add, edit and delete function
```php
use App\Models\Todo; // This is the model of target table
use Codelife\CodelifeHelpers\Helper; // namespace of helper
...


...
public function add(Request $request){
    $todo = Todo::create($request->all());
    ...
    // First use
    // with custom second parameter
    new Helper($todo, 'Your custom activity message here');

    // Second use
    // with custom second parameter
    new Helper($todo);
    ...

    // This will get the json encoded format of the inserted data
}
...

```

### Retrieving data
```php
...
return Helper::getAllActivityLogs()->getData(); // Will return a json encoded response of the data
...

...
Helper::getAllActivityLogs(); // Will return the collactin of the data
...
```

### Truncating table
```php
Helper::setTableEmpty(); // This will return a boolean 
```
