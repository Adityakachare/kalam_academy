<?php require('operations.php'); ?>

<?php
// Query for fetching data from crm_lead_master_data
$queryLeadMaster = "SELECT * FROM crm_lead_master_data";
$resultLeadMaster = mysqli_query($conn, $queryLeadMaster);

if (!$resultLeadMaster) {
    die("Query failed: " . mysqli_error($conn));
}

// Query for fetching the last DOR from crm_calling_status
$querySummaryDOR = "SELECT MAX(DOR) AS SummaryDOR FROM crm_calling_status";
$resultSummaryDOR = mysqli_query($conn, $querySummaryDOR);
$summaryDOR = ($resultSummaryDOR) ? mysqli_fetch_assoc($resultSummaryDOR)['SummaryDOR'] : '';

// Query for fetching the name from crm_admin
$queryCallerName = "SELECT Name FROM crm_admin";
$resultCallerName = mysqli_query($conn, $queryCallerName);
$callerName = ($resultCallerName) ? mysqli_fetch_assoc($resultCallerName)['Name'] : '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
   <style>
     body {
     font-family: Arial, sans-serif;
 }

 .container {
     max-width: 100%;
     margin: auto;
 }

 h1.center-content {
     text-align: center;
 }

 table {
     width: 100%;
     border-collapse: collapse;
     margin-top: 20px;
 }

 th,
 td {
     border: 1px solid #ddd;
     padding: 8px;
     text-align: left;
 }

 th {
     background-color: #f2f2f2;
 }

 tr:nth-child(even) {
     background-color: #f9f9f9;
 }

 .center-content {
     text-align: center;
 }
   </style>
    <title>Test</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="center-content">Lead Data Management System</h1>
    <table id="leadDataTable" class="table">
        <thead>
            <tr>
                <td colspan="14" class="center-content">CRM LEAD MASTER DATA</td>
                <td class="center-content">CRM CALLING STATUS</td>
                <td class="center-content">CRM ADMIN</td>
            </tr>
            <tr>
                <th>Lead ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Alternate Mobile</th>
                <th>WhatsApp</th>
                <th>Email</th>
                <th>Interested_In</th>
                <th>Source</th>
                <th>Status</th>
                <th>DOR</th>
                <th>Caller</th>
                <th>State</th>
                <th>City</th>
                <th>Caller Id</th>
                <th>Summary DOR</th>
                <th>Caller</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($resultLeadMaster) {
                while ($row = mysqli_fetch_assoc($resultLeadMaster)) {
                    ?>
                    <tr>
                        <td><?php echo $row['Lead_ID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Mobile']; ?></td>
                        <td><?php echo $row['Alternate_Mobile']; ?></td>
                        <td><?php echo $row['Whatsapp']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Interested_In']; ?></td>
                        <td><?php echo $row['Source']; ?></td>
                        <td><?php echo $row['Status']; ?></td>
                        <td><?php echo $row['DOR']; ?></td>
                        <td><?php echo $row['Caller']; ?></td>
                        <td><?php echo $row['State']; ?></td>
                        <td><?php echo $row['City']; ?></td>
                        <td><?php echo $row['Caller_ID']; ?></td>
                        <td><?php echo $summaryDOR; ?></td>
                        <td><?php echo $callerName; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='14'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#leadDataTable').DataTable({
            "serverSide": true,
            "ajax": "server_processing.php",
            "columns": [
                {"data": "Lead_ID"},
                {"data": "Name"},
                {"data": "Mobile"},
                {"data": "Alternate_Mobile"},
                {"data": "Whatsapp"},
                {"data": "Email"},
                {"data": "Interested_In"},
                {"data": "Source"},
                {"data": "Status"},
                {"data": "DOR"},
                {"data": "Caller"},
                {"data": "State"},
                {"data": "City"},
                {"data": "Caller_ID"},
                {"data": "DOR"},
                {"data": "Caller"}
            ],
            "pageLength": 10
        });
    });
</script>

</body>
</html>
