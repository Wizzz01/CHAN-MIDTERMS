<?php require_once 'core/dbConfig.php';?>
<?php require_once 'core/handleForms.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/fillStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechwiZ</title>
</head>
    <body>
    <?php $getById = getById($pdo, $_GET['customer_id']); ?>
    <button class="returnBtn" onclick="document.location='salesDatabase.php'">Return</button>
<div class="container">
    <div class="title">Add a customer</div>
    <div class="content">
      <form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
        <div class="user-details">

          <div class="input-box">
            <span class="details">Customer Name</span>
            <input type="text" name="customerName" placeholder="Edit customer name" value="<?php echo $getById['customer_name'];?>">
          </div>

          <div class="input-box">
            <span class="details">Customer email</span>
            <input type="text" name="customerEmail" placeholder="Edit customer email" value="<?php echo $getById['customer_email'];?>">
          </div>
         
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="customerAddress" placeholder="Edit customer address" value="<?php echo $getById['customer_address'];?>">
          </div>
        
          <div class="input-box">
            <span class="details">No. of items purchased</span>
            <input type="number" name="itemsPurchased" placeholder="Edit no. of items purchased" value="<?php echo $getById['items'];?>">
          </div>
         
          <div class="input-box">
            <span class="details">Purchase Total</span>
            <input type="number" name="purchaseTotal" placeholder="Edit purchase total" value="<?php echo $getById['purchase_total'];?>">
          </div>
        </div>
        <div class="button">
          <input type="submit" name="editBtn" value="Edit" onclick="alert('Update success!')">
        </div>
    </div>
</div>
        </form>
</body>
</html>