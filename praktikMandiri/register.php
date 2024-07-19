<?php
include 'config.php';

$registered = false;
$error = false;
$details = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $appointment_date = date('Y-m-d'); // Tanggal kunjungan adalah hari ini

    // Periksa apakah jumlah pendaftaran sudah mencapai 10 untuk hari ini
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM appointments WHERE appointment_date = ?");
    $stmt->bind_param("s", $appointment_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] >= 10) {
        $error = true;
        $errorMessage = "Kouta Antrian Hari Ini Sudah Penuh. Mohon Untuk Mengambil Antrian Pada Hari Besok";
    } else {
        $stmt = $conn->prepare("INSERT INTO patients (name, phone, address) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $address);
        $stmt->execute();
        $patient_id = $stmt->insert_id;

        $queue_number = $row['count'] + 1;
        $arrival_time = date('H:i:s', strtotime('10:00') + (($queue_number - 1) * 20 * 60)); // Waktu kedatangan diatur dari 10:00, dengan interval 30 menit

        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, appointment_date, queue_number, arrival_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $patient_id, $appointment_date, $queue_number, $arrival_time);
        $stmt->execute();

        $details = [
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'queue_number' => $queue_number,
            'appointment_date' => $appointment_date,
            'arrival_time' => $arrival_time
        ];

        $registered = true;
    }
}

include 'register_form.php';
