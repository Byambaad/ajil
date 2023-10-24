<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <nav class="navbar">
         <a href="../admin/admin.php">Нүүр</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Сайн байна уу? <?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Мэдээллээ шинэчлэх</a>
         <div class="flex-btn">
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Вэбээс гарах уу?');">Гарах</a> 
      </div>

   </section>

</header>