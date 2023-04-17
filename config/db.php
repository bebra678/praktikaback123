<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
return [
   'driver' => 'mysql',
   'host' => '109.95.210.102',
   'database' => 'u147175_zalypa',
   'username' => 'u147175_zalypa',
   'password' => 'wcd1Jb',
   'charset' => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix' => '',
];

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();