<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=fims_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if sessions table exists
    $result = $pdo->query("SHOW TABLES LIKE 'sessions'");
    $tableExists = $result->rowCount() > 0;
    
    echo "Sessions table exists: " . ($tableExists ? "Yes" : "No") . "\n";
    
    if ($tableExists) {
        // Check table structure
        $result = $pdo->query("DESCRIBE sessions");
        echo "Sessions table structure:\n";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
        }
    } else {
        // Create the sessions table with the correct structure
        $pdo->exec("CREATE TABLE `sessions` (
            `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `user_id` bigint(20) UNSIGNED DEFAULT NULL,
            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
            `last_activity` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `sessions_user_id_index` (`user_id`),
            KEY `sessions_last_activity_index` (`last_activity`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        echo "Sessions table created successfully.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
