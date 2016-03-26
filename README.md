PHPNotifier
===========

**PHPNotifier** - is a task scheduler. Allows you to schedule a task that will be executed at any time you wish. 

Installation
------------
add to your composer.json - `"krydos/php-notifier": "dev-master"`
 
Usage
-----
```php
use \PHPNotifier\PHPNotifier;

$scheduler = new PHPNotifier(PHPNotifier::FILE_METHOD, '/absolute/path/where/tasks/will/be/stored');
$scheduler->scheduleTaskIn(10, 'echo', [
    'Hello world!'
    '>'
    'any_file'
]);  
```

This task will be executed in 10 seconds. Command that will be executed is `echo Hello world! > any_file`

Since sometimes you know exact time when you want to run a task and you don't want to calculate how many time is remaining
there is another method exists - `scheduleTaskAtTime` with same signature.

```php
use \PHPNotifier\PHPNotifier;

$scheduler = new PHPNotifier(PHPNotifier::FILE_METHOD, '/absolute/path/where/tasks/will/be/stored');
$scheduler->scheduleTaskAtTime(1459382400, 'echo', [
    'Hello world!'
    '>'
    'any_file'
]);  
```

This method accepts unix timestamp as first argument. If you use `DateTime` PHP's object you can get this value by `getTimestamp()` method.
 
TODO
------
 
* support Redis as task store method
* ability to accept DateTime as first argument for `scheduleTaskAtTime` method
* ability to accept any valid date string as first argument of `scheduleTaskAtTime` method
 
 
Contributing
------------
There are no special rules. Just send a pull request or create an issue. 
 
 