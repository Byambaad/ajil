<header class="header">

   <section class="flex">

      <nav class="navbar">
         <a href="home.php">Нүүр</a>
         <a href="orders.php">Захиалга</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
        
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p> Сайн байна уу? <?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">Мэдээллээ шинэчлэх</a>
         <div class="flex-btn">
           
           
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Веб сайтаас гарах уу?');">гарах</a> 
         <?php
            }else{
         ?>
         <p>Нэвтэрнэ үү</p>
         <div class="flex-btn">
            <a href="user_login.php" class="option-btn">Нэвтрэх</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>