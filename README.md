PHPNotifier
===========

**PHPNotifier** - is a task scheduler. Allows you to schedule a task that will be executed at any time you wish. 

Installation
------------
add to your composer.json - `"krydos/php-notifier": "dev-master"`
 
Usage
-----
First of all you have to run a script that will be listening for new tasks and execute them when time came.

`php ./vendor/bin/phpnotifier /absolute/path/to/db.file`

or if you want to leave it working in background

`nohup php ./vendor/bin/phpnotifier /absolute/path/to/db.file & >/dev/null 2>&1 &`

Using `nohup` you can see log output in `nohup.out` file. 

How to create new tasks:

```php
use \PHPNotifier\PHPNotifier;

$scheduler = new PHPNotifier(PHPNotifier::FILE_METHOD, '/absolute/path/to/db.file');
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

$scheduler = new PHPNotifier(PHPNotifier::FILE_METHOD, '/absolute/path/to/db.file');
$scheduler->scheduleTaskAtTime(1459382400, 'echo', [
    'Hello world!'
    '>'
    'any_file'
]);  
```

This method accepts unix timestamp as first argument. If you use `DateTime` PHP's object you can get this value by `getTimestamp()` method.

**make sure that binary you're trying to execute is exists in your system**
 
TODO
------
 
* support Redis as task store method
* support as many store methods as possible
* ability to accept DateTime as first argument for `scheduleTaskAtTime` method
* ability to accept any valid date string as first argument of `scheduleTaskAtTime` method
 
 
Contributing
------------
There are no special rules. Just send a pull request or create an issue. 
 
 