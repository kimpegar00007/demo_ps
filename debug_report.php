<?php
// This is a debug script to see what's happening with the ReportController

// Set error reporting to show all errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the ReportController
require_once __DIR__ . '/controllers/ReportController.php';

// Create test data similar to what the JavaScript would send
$testData = [
    'reportType' => 'payroll',
    'dateRange' => 'current_month',
    'startDate' => '',
    'endDate' => '',
    'employee' => 'all'
];

// Create a controller instance
$controller = new ReportController();

try {
    // Try to generate the report
    $result = $controller->generateReport($testData);
    
    // Output as JSON with proper headers
    header('Content-Type: application/json');
    echo json_encode($result);
} catch (Exception $e) {
    // Output any errors
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
?>
