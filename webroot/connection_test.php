<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';

use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;

echo "Environment Variables:\n";
echo "--------------------\n";
echo "MYSQLHOST: " . env('MYSQLHOST', 'not set') . "\n";
echo "MYSQLPORT: " . env('MYSQLPORT', 'not set') . "\n";
echo "MYSQLUSER: " . env('MYSQLUSER', 'not set') . "\n";
echo "MYSQLPASSWORD: " . (env('MYSQLPASSWORD') ? 'is set' : 'not set') . "\n";
echo "MYSQLDATABASE: " . env('MYSQLDATABASE', 'not set') . "\n";
echo "MYSQL_URL: " . env('MYSQL_URL', 'not set') . "\n\n";

echo "Database Configuration:\n";
echo "---------------------\n";
$config = ConnectionManager::getConfig('default');
echo "Host: " . ($config['host'] ?? 'not set') . "\n";
echo "Port: " . ($config['port'] ?? 'not set') . "\n";
echo "Username: " . ($config['username'] ?? 'not set') . "\n";
echo "Database: " . ($config['database'] ?? 'not set') . "\n";
echo "URL: " . ($config['url'] ?? 'not set') . "\n\n";

try {
    $connection = ConnectionManager::get('default');
    echo "Attempting connection...\n";
    $connected = $connection->getDriver()->connect();
    
    if ($connected) {
        echo "Successfully connected to the database!\n";
        // Test a simple query
        try {
            $result = $connection->execute('SELECT VERSION() as version')->fetch();
            echo "MySQL Version: " . $result['version'] . "\n";
        } catch (\Exception $e) {
            echo "Connected but query failed: " . $e->getMessage() . "\n";
        }
    }
} catch (\Exception $e) {
    echo "Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    
    // Show PDO connection string (without password)
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']}";
    echo "\nAttempted DSN: " . $dsn . "\n";
} 