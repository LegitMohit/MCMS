<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';

try {
    $host = env('MYSQLHOST', 'localhost');
    $port = env('MYSQLPORT', '3306');
    $dbname = env('MYSQLDATABASE', 'medical_clinic_db');
    $user = env('MYSQLUSER', 'root');
    $pass = env('MYSQLPASSWORD', '');
    
    echo "Attempting connection with:\n";
    echo "Host: $host\n";
    echo "Port: $port\n";
    echo "Database: $dbname\n";
    echo "Username: $user\n";
    echo "Password: " . (empty($pass) ? "not set" : "is set") . "\n\n";
    
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::ATTR_PERSISTENT => false
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connection successful!\n";
    
    // Test query
    $stmt = $pdo->query('SELECT VERSION() as version');
    $result = $stmt->fetch();
    echo "MySQL Version: " . $result['version'] . "\n";
    
} catch (PDOException $e) {
    echo "Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Error Code: " . $e->getCode() . "\n";
    
    // Additional debugging information
    echo "\nDebug backtrace:\n";
    debug_print_backtrace();
} 