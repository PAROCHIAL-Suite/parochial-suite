<?php
header('Content-Type: application/json');

// Database configuration - UPDATE THESE VALUES
$host = 'localhost';
$dbname = 'parochial_cloud';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        
        // Validate date format (YYYY-MM-DD)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception('Invalid date format');
        }
        
        $stmt = $db->prepare("SELECT id, title, description, event_time FROM events WHERE event_date = ? ORDER BY event_time");
        $stmt->execute([$date]);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'date' => $date,
            'events' => $events
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'No date specified'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>