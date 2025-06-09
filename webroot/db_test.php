<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';

use Cake\Datasource\ConnectionManager;

try {
    $connection = ConnectionManager::get('default');
    $connected = $connection->connect();
    if ($connected) {
        echo "Successfully connected to the database!\n";
        echo "Database details:\n";
        echo "Host: " . env('MYSQLHOST', 'not set') . "\n";
        echo "Port: " . env('MYSQLPORT', 'not set') . "\n";
        echo "Database: " . env('MYSQLDATABASE', 'not set') . "\n";
        echo "Username: " . env('MYSQLUSER', 'not set') . "\n";
    }
} catch (\Exception $e) {
    echo "Failed to connect to the database.\n";
    echo "Error: " . $e->getMessage() . "\n";
    
    // Check if we have a DATABASE_URL
    echo "\nChecking DATABASE_URL:\n";
    $dbUrl = env('DATABASE_URL', 'not set');
    echo $dbUrl === 'not set' ? "DATABASE_URL is not set\n" : "DATABASE_URL is set\n";
    
    // Check individual credentials
    echo "\nChecking individual credentials:\n";
    echo "MYSQLHOST: " . (env('MYSQLHOST', 'not set')) . "\n";
    echo "MYSQLPORT: " . (env('MYSQLPORT', 'not set')) . "\n";
    echo "MYSQLDATABASE: " . (env('MYSQLDATABASE', 'not set')) . "\n";
    echo "MYSQLUSER: " . (env('MYSQLUSER', 'not set')) . "\n";
    echo "MYSQLPASSWORD: " . (env('MYSQLPASSWORD', '') ? 'is set' : 'not set') . "\n";
} 