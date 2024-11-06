<?php
require_once 'core/dbConfig.php'; 
require_once 'core/handleForms.php';
require_once 'core/models.php';
if (!isset($_SESSION['username'])) {
	header("Location: userLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="CSS/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechwiZ</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary custom-navbar">
  <a class="navbar-brand" href="index.php">
    <img class="navbar-logo" src="media/Images/techwiz.png" alt="TechwiZ" style="height: 30px; margin-bottom: 0.5rem;">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addCustomer.php">Add new customer/purchase</a>
      </li>
    </ul>
    <form class="d-flex" role="search">
      <?php if (isset($_SESSION['username'])) { ?>
          <a class="btn btn-outline-dark m-2" href="core/handleForms.php?logoutAUser=1">Logout</a>
      <?php } else { echo "<h1>No user logged in</h1>";} ?>
    </form>
  </div>
</nav>
    <?php $seeAllRecords = seeAllRecords($pdo); ?>
    
<table class="table table-striped table-hover my-2" style="border-collapse: collapse;">
    <tr class ="table-rows">
        <th class ="table-header">Customer ID</th>
        <th class ="table-header">Customer Name</th>
        <th class ="table-header">Number of Items</th>
        <th class ="table-header">Purchase Total</th>
        <th class ="table-header">Purchase Date</th>
        <th class ="table-header">Added By</th>
        <th class ="table-header">Added At</th>
        <th class ="table-header">Last Updated By</th>
        <th class ="table-header">Last Updated At</th>
        <th class ="table-header">Actions</th>
    </tr>

    <?php foreach($seeAllRecords as $row) { ?>
    <tr class="table-rows">
        <td class="table-data"><?php echo $row['customer_id']; ?></td>
        <td class="table-data"><?php echo $row['customer_name']; ?></td>
        <td class="table-data"><?php echo $row['items']; ?></td>
        <td class="table-data"><?php echo $row['purchase_total']; ?></td>
        <td class="table-data"><?php echo $row['purchase_date']; ?></td>
        <td class="table-data"><?php echo $row['added_by']; ?></td>
        <td class="table-data"><?php echo $row['added_at']; ?></td>
        <td class="table-data"><?php echo $row['last_updated_by']; ?></td>
        <td class="table-data"><?php echo $row['last_updated_at']; ?></td>
        <td class="table-data">
            <a href="editHistory.php?customer_id=<?php echo $row['customer_id']; ?>">Edit</a> | 
            <a href="deleteHistory.php?customer_id=<?php echo $row['customer_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?> 
</table>
</body>
</html>