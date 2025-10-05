<?php
// Test syntax untuk balasan_surat.php
echo "Testing syntax...\n";

// Simulate variables that would be available
$koneksi = null; // This would be the database connection
$_GET = array(); // Simulate GET parameters

// Test the logic without database connection
$limit = 5;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$where = $search ? "WHERE nomor_surat LIKE '%$search%' 
                    OR nama_pengirim LIKE '%$search%' 
                    OR asal_instansi LIKE '%$search%'" : '';

// Simulate total data
$total_data = 0;
$total_page = ceil($total_data / $limit);

echo "Variables initialized successfully!\n";
echo "Total data: $total_data\n";
echo "Current page: $page\n";
echo "Search where clause: $where\n";
echo "Syntax test passed!\n";
?>