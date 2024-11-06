<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<meta charset="UTF-8">
<link rel="stylesheet" href="CSS/fillStyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechwiZ</title>
</head>
<body>
    <button class="returnBtn" onclick="document.location='salesDatabase.php'">Return</button>
    <div class="header-container">
		<h1>Are you sure you want to remove this purchase history?</h1>
	</div>
	<?php $getById = getById($pdo, $_GET['customer_id']); ?>
	<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">

		<div class="history-container">
			<p>Customer name: <?php echo $getById['customer_name']; ?></p>
			<p>Customer email: <?php echo $getById['customer_email']; ?></p>
			<p>Customer address: <?php echo $getById['customer_address']; ?></p>
			<p>No. of items purchased: <?php echo $getById['items']; ?></p>
			<p>Purchase total: <?php echo $getById['purchase_total']; ?></p>
			<div class="button">
				<input type="submit" name="deleteBtn" value="Delete">
			</div>
		</div>
	</form>
</body>
</html>