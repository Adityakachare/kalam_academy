<?php

require('operations.php');


$start = $_GET['start'];
$length = $_GET['length'];
$orderColumnIndex = $_GET['order'][0]['column'];
$orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
$orderDirection = $_GET['order'][0]['dir'];


$query = "SELECT * FROM crm_lead_master_data ORDER BY $orderColumnName $orderDirection LIMIT $start, $length";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}


$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}


$totalRecordsQuery = "SELECT COUNT(*) AS total FROM crm_lead_master_data";
$totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
$totalRecords = ($totalRecordsResult) ? mysqli_fetch_assoc($totalRecordsResult)['total'] : 0;


$response = array(
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
);

echo json_encode($response);

mysqli_close($conn);
?>
