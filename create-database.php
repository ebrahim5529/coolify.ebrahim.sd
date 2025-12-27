<?php
try {
    $pdo = new PDO('mysql:host=31.97.37.248;port=5432', 'mysql', 'akaqMbAlYEUyNe2RBRXa8ki7R5cG4PGhwbZnVfXjZPOX401FKbfHSiWLff2LvmR1');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS MYWebsite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "Database MYWebsite created successfully!\n";
    
    // Check if it was created
    $databases = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    if (in_array('MYWebsite', $databases)) {
        echo "MYWebsite database exists!\n";
    } else {
        echo "Warning: MYWebsite database was not created. Available databases:\n";
        foreach($databases as $db) {
            echo "- $db\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

