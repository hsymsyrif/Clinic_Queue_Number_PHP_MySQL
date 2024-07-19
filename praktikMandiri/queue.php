<?php
include 'config.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$stmt = $conn->prepare("SELECT a.queue_number, p.name, a.arrival_time FROM appointments a JOIN patients p ON a.patient_id = p.id WHERE a.appointment_date = ? ORDER BY a.queue_number ASC");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();


include 'queue_view.php';
