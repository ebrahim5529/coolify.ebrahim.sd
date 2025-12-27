<?php
try {
    $pdo = new PDO('mysql:host=31.97.37.248;port=5432', 'mysql', 'akaqMbAlYEUyNe2RBRXa8ki7R5cG4PGhwbZnVfXjZPOX401FKbfHSiWLff2LvmR1');
    $databases = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    echo "Available databases:\n";
    foreach($databases as $db) {
        echo "- $db\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

