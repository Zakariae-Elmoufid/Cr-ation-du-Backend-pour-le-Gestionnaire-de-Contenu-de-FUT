
<?php include('confige.php'); ?>

<?php 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}    
    
  
    $query = "SELECT *  FROM `player` 
    JOIN nationality ON player.id_nationality = nationality.id 
    JOIN club ON  player.id_club = club.id
    left join  other_position on other_position.player_id = player.id
    left join  gk_position on gk_position.player_id  = player.id
    WHERE player.id = '$id' ";
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("query failed". mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
  
    if(isset($_POST['update'])){

        $name = $_POST['name'] ?? null;
        $photo = $_POST['photo'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $nationality = $_POST['nationality'] ?? null;
        $club = $_POST['club'] ?? null;
        $playerType = $_POST['playerType'] ?? null;
        
    
    
        $errors = [];
       // Pattern for text fields (letters and spaces only)
    $patterText = "/^[a-zA-Z\s]+$/";
    
    // Pattern for numeric fields (numbers between 10 and 100)
    $patterNumber = "/^(10|[1-9][0-9]|100)$/";
    
    // Pattern for URLs
    $patterURL = "/^(https?:\/\/)?([\w\-]+)+([\w\-.\/?%&=]*)$/";
    
    // Validate name
    if (isset($name)) {
        if (!preg_match($patterText, $name)) {
            $errors['name'] = "Invalid name format. Only letters and spaces are allowed.";
        }
    }
    
    // Validate rating
    if (isset($rating)) {
        if (!preg_match($patterNumber, $rating)) {
            $errors['rating'] = "Rating must be between 10 and 100.";
        }
    }
    
    // Validate photo
    if (isset($photo)) {
        if (!preg_match($patterURL, $photo)) {
            $errors['photo'] = "Invalid photo URL.";
        }
    }
    
    
    
    
    
    
    if ($playerType === '0') {
        $diving = $_POST['diving'] ?? null;
        $handling = $_POST['handling'] ?? null;
        $reflexes = $_POST['reflexes'] ?? null;
    
    
        if (isset($diving)) {
            if (!preg_match($patterNumber, $diving)) {
                $errors['diving'] = "Diving must be between 10 and 100.";
            }
        }
        if (isset($handling)) {
            if (!preg_match($patterNumber, $handling)) {
                $errors['handling'] = "Handling must be between 10 and 100.";
            }
        }
        if (isset($reflexes)) {
            if (!preg_match($patterNumber, $reflexes)) {
                $errors['reflexes'] = "Reflexes must be between 10 and 100.";
            }
        }
    
    
        
        if(empty($diving)) $errors['diving'] = "Name is required.";
        if(empty($handling)) $errors['handling'] = "handling is required.";
        if(empty($reflexes)) $errors['reflexes'] = "reflexes is required."; 
    
    } elseif ($playerType === '1') {
        $position = $_POST['playerPosition'] ?? null;
        $pace = $_POST['pace'] ?? null;
        $shooting = $_POST['shooting'] ?? null;
        $defending = $_POST['defending'] ?? null;
        $physical = $_POST['physical'] ?? null;
    
        if (isset($pace)) {
            if (!preg_match($patterNumber, $pace)) {
                $errors['pace'] = "Pace must be between 10 and 100.";
            }
        }
        if (isset($shooting)) {
            if (!preg_match($patterNumber, $shooting)) {
                $errors['shooting'] = "Shooting must be between 10 and 100.";
            }
        }
    
        if (isset($defending)) {
            if (!preg_match($patterNumber, $defending)) {
                $errors['defending'] = "Defending must be between 10 and 100.";
            }
        }
        if (isset($physical)) {
            if (!preg_match($patterNumber, $physical)) {
                $errors['physical'] = "Physical must be between 10 and 100.";
            }
        }
    
    
        if(empty($pace)) $errors['pace'] = "pace is required";
        if(empty($shooting)) $errors['shooting'] = "shooting is required" ;
        if(empty($defending)) $errors['defending'] = "defending is required";
        if(empty($physical)) $errors['physical'] = "physical is required";
        
       
      
    }
       
       
    
    
    
        if (empty($name)) $errors['name'] = "Name is required.";
        if (empty($photo)) $errors['photo'] = "Photo URL is required.";
        if (empty($rating)) $errors['rating'] = "Rating is required.";
        if (empty($club)) $errors['club'] = "Club is required.";
        // if (empty($playerType)) $errors["playerType"] = "Player Type is required";
    
       
        
        if (empty($errors)) {
    
            $query = "UPDATE  `player`  set  `player_name` = '$name' , `photo` = '$photo' , `rating` = '$rating',
             `status_player` = '$playerType' ,`id_nationality` = '$nationality', `id_club` = '$club' where `id` = '$id' ";

            $result = mysqli_query($conn,$query);
    
            if($result){
             echo "kolchi tamam";
                
            }else{
               echo "3ndk error";
            }
    
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashbord.css">
    <title>FUT Champions</title>
</head>
<body >
<?php include ('sidbar.php'); ?>

<main class="ml-64 p-8">
        <div class="w-xl  mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Add New Player</h2>
            <form id="paginatedForm" action="update.php?id=<?php echo $id;?>" method="POST" class="space-y-6">
                <!-- Section 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                    <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-200">Player Name</label>                      
                  <input type="text" id="name"
                   name="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter player's name" value="<?php echo $row['player_name'] ;?>">
                    </div>
                    <div class="space-y-2">
                            <label for="photo" class="text-sm font-medium text-gray-700 dark:text-gray-200">Photo
                                URL</label>
                            <input type="url" id="photo" name="photo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter photo URL" value="<?php echo $row['photo'] ;?>">
                            <small class="text-red-500"><?php echo $errors['photo'] ?? '' ; ?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="rating"
                                class="text-sm font-medium text-gray-700 dark:text-gray-200">Rating</label>
                            <input type="number" id="rating" name="rating"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter rating" value="<?php echo $row['rating'] ;?>">
                            <small class="text-red-500"><?php echo $errors['rating'] ?? ''; ?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="nationality"
                                class="text-sm font-medium text-gray-700 dark:text-gray-200">Nationality</label>
                            <select id="nationality" name="nationality"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select nationality</option>
                                <?php
                                $query = "SELECT * FROM `nationality`";
                                $result = mysqli_query($conn, $query);
                                while ($rows = mysqli_fetch_assoc($result)) {
                                      if($rows['id']== $row['id_nationality']){
                                          echo "<option selected value='{$rows['id']}'>{$rows['name_nationality']}</option>";
                                      }else{
                                          echo "<option  value='{$rows['id']}'>{$rows['name_nationality']}</option>";
                                      }
                                    
                                    
                                }
                                ?>
                            </select>
                            <small class="text-red-500"><?php echo $errors['nationality'] ?? ''; ?></small>
                        </div>
                       


                        <div class="space-y-2">
                            <label for="club" class="text-sm font-medium text-gray-700 dark:text-gray-200">Club</label>
                            <select id="club" name="club"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select club</option>
                                <?php
                                $query = "SELECT * FROM `club`";
                                $result = mysqli_query($conn, $query);
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    if($rows['id'] == $row['id_club']){
                                        echo "<option selected value='{$rows['id']}'>{$rows['name_club']}</option>";
                                    }else{
                                        echo "<option value='{$rows['id']}'>{$rows['name_club']}</option>";
                                    }
                                     }
                                     
                                ?>
                            </select>
                            <small class="text-red-500"><?php echo $errors['club'] ?? ''; ?></small>
                        </div>

                    
                        <div class="space-y-2">
                            <label for="playerType" class="text-sm font-medium text-gray-700 dark:text-gray-200">Player
                                Type</label>
                            <select id="playerType" name="playerType"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <?php 
                                  $query = "SELECT * FROM `player`";
                                  $result = mysqli_query($conn, $query);
                                  
                                    if($row["status_player"] == '0'){
                                        echo "<option selected value='0' >Goalkeeper</option>";
                                    }else if ($row["status_player"] == '1'){
                                        echo "<option selected value='1'>Field Player</option>";
                                    }

                                    if($row["status_player"] !== '0'){
                                        echo "<option  value='0' >Goalkeeper</option>";
                                    }else if ($row["status_player"] !== '1'){
                                        echo "<option value='1'>Field Player</option>";
                                    }

                                
                                ?>
                              
                            </select>
                            <small class="text-red-500"><?php echo $errors['playerType'] ?? ''; ?></small>
                        </div>
                    </div>

                 <!-- Section 3 (Goalkeeper-specific) -->

                 <div id="goalkeeperFields" class="hidden space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="diving"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Diving</label>
                                <input type="number" id="diving" name="diving"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter diving score"  value="<?php echo $row['diving'] ;?>">
                                <small class="text-red-500"><?php echo $errors['diving'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="handling"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Handling</label>
                                <input type="number" id="handling" name="handling"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter handling score"  value="<?php echo $row['handling'] ;?>">
                                <small class="text-red-500"><?php echo $errors['handling'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="reflexes"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Reflexes</label>
                                <input type="number" id="reflexes" name="reflexes"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter reflexes score"  value="<?php echo $row['reflexes'] ;?>">
                                <small class="text-red-500"><?php echo $errors['reflexes'] ?? ''; ?></small>
                            </div>
                        </div>
                    </div>



                <!-- Section 3 (Player-specific) -->
                
                <div id="playerFields" class=" hidden space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="playerPosition"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Position</label>
                                <select id="playerPosition" name="playerPosition"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select position</option>
                                    <option value="LB">Left Back (LB)</option>
                                    <option value="CBL">Center Back Left (CBL)</option>
                                    <option value="CBR">Center Back Right (CBR)</option>
                                    <option value="RB">Right Back (RB)</option>
                                    <option value="CDM">Defensive Midfielder (CDM)</option>
                                    <option value="CM">Center Midfielder (CM)</option>
                                    <option value="CAM">Attacking Midfielder (CAM)</option>
                                    <option value="LW">Left Winger (LW)</option>
                                    <option value="ST">Striker (ST)</option>
                                    <option value="RW">Right Winger (RW)</option>
                                </select>
                                <small class="text-red-500"><?php echo $errors['playerPosition'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="pace"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Pace</label>
                                <input type="number" id="pace" name="pace"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter pace score"  value="<?php echo $row['pace'] ;?>">
                                <small class="text-red-500"><?php echo $errors['pace'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="shooting"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Shooting</label>
                                <input type="number" id="shooting" name="shooting"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter shooting score"  value="<?php echo $row['shooting'] ;?>">
                                <small class="text-red-500"><?php echo $errors['shooting'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="defending"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Defending</label>
                                <input type="number" id="defending" name="defending"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter defending score"  value="<?php echo $row['defending'] ;?>">
                                <small class="text-red-500"><?php echo $errors['defending'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="physical"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Physical</label>
                                <input type="number" id="physical" name="physical"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter physical score"  value="<?php echo $row['physical'] ;?>">
                                <small class="text-red-500"><?php echo $errors['physical'] ?? ''; ?></small>
                            </div>
                        </div>
                    </div>
             

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Add Player
                        </button>
                    </div>
            </form>
        </div>
</main>


              
    
    <script>
    document.getElementById('playerType').addEventListener('change', function() {
    const playerFields = document.getElementById('playerFields');
    const goalkeeperFields = document.getElementById('goalkeeperFields');

    if (this.value === '0') {
        playerFields.classList.add('hidden');
        goalkeeperFields.classList.remove('hidden');
    } else if (this.value === '1') {
        goalkeeperFields.classList.add('hidden');
        playerFields.classList.remove('hidden');
    } else {
        playerFields.classList.add('hidden');
        goalkeeperFields.classList.add('hidden');
    }
     });
    </script>

</body>
</html>
