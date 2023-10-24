<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

// Fetch the administrator's profile information
$select_admin_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$select_admin_profile->execute([$admin_id]);

if($select_admin_profile->rowCount() > 0){
   $fetch_profile = $select_admin_profile->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Удирдлагын хэсэг</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">Удирдлагын хэсэг</h1>

   <div class="box-container">

      <div class="box">
         <h3>Сайн уу?</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Мэдээллээ шинэчлэх</a>
      </div>

      <div class="box">
        

         <?php
            $payment_statuses = ['Шинэ', 'Pending'];
            $placeholders = implode(', ', array_fill(0, count($payment_statuses), '?'));
            $sql = "SELECT * FROM `orders` WHERE payment_status IN ($placeholders)";
            $select_pendings = $conn->prepare($sql);
            $select_pendings->execute($payment_statuses);
            $number_of_pendings = $select_pendings->rowCount();
         ?>
         <h3><?= $number_of_pendings; ?></h3>
         <p>Шинэ захиалга</p>
         <a href="placed_orders.php" class="btn">Захиалгууд харах</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Нэмэгдсэн бараанууд</p>
         <a href="products.php" class="btn">бараанууд үзэх</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Хэрэглэгчид</p>
         <a href="users_accounts.php" class="btn">Хэрэглэгчдийг харах</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>Админууд</p>
         <a href="admin_accounts.php" class="btn">Админуудыг харах</a>
      </div>


   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>