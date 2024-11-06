<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/fillStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechwiZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<button class="returnBtn" onclick="document.location='salesDatabase.php'">Return</button>
<div class="container">
    <div class="title">Add a customer</div>
    <div class="content">
      <form action="core/handleForms.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Customer Name</span>
            <input type="text" name="customerName" placeholder="Enter customer name" required>
          </div>

          <div class="input-box">
            <span class="details">Customer email</span>
            <input type="text" name="customerEmail" placeholder="Enter customer email" required>
          </div>
         
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="customerAddress" placeholder="Enter customer address" required>
          </div>
        
          <div class="input-box">
            <span class="details">Age</span>
            <input type="number" name="customerAge" placeholder="Enter customer age" required>
          </div>

          <div class="input-box">
            <span class="details">No. of items purchased</span>
            <input type="number" name="itemsPurchased" placeholder="Enter no. of items purchased" required>
          </div>
         
          <div class="input-box">
            <span class="details">Purchase Total</span>
            <input type="number" name="purchaseTotal" placeholder="Enter purchase total" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submitBtn" value="Submit" onclick="alert('Updated purchase history!')">
        </div>
    </div>
</div>
        </form>
</body>
</html>