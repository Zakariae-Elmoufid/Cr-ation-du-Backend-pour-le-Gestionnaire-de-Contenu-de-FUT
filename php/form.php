<?php
include 'confige.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

        $query  = mysqli_query(  $conn, "INSERT INTO player(player_name, photo, rating , status_player ,id_nationality, id_club) VALUES ('$name','$photo','$rating',' $playerType ', '$nationality', '$club');") ;

        if($query){
            $last_id = mysqli_insert_id($conn);

            if ($playerType === '0') {
                $queryGK  = mysqli_query($conn,"INSERT INTO gk_position  (diving, handling, reflexes, player_id) VALUES ('$diving', '$handling' ,'$reflexes','$last_id')");
                if($queryGK){
                    echo " $last_id";
                    echo "gk added successfully!";
                   
                }else{
                   echo "3ndk error";
                }
            
         
        } else if ($playerType === '1') {
                $queryPlayer  = mysqli_query($conn,"INSERT INTO other_position  (position_player, pace, shooting, defending , physical , player_id)
                 VALUES ('$position', '$pace' ,'$shooting', '$defending','$physical','$last_id');");
                if($queryPlayer){
                    echo " $last_id";
                    echo "Player added successfully! ";
                }else{
                   echo "3ndk error";
                }
        }
            
        }else{
           echo "3ndk error";
        }

    }
    unset($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashbord.css">
    <title>FUT Champions</title>
</head>
<body style="display:flex">
    <div class="sidebar">
        <h1>Players Management</h1>
        <div class="sidebar-menu">
            <button><a href="dashbord.php">Dashboard</a></button>
            <button><a href="player.php">Players List</a></button>
            <button><a href="form.php">Add Player</a></button>
        </div>
    </div>
    <div class="main">
        <div class="form-container">
            <h2>Player Form</h2>
            <form id="paginatedForm" action="form.php" method="POST" >
                <!-- Section 1 -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter player's name" value="">
                        <small style="color: red;"><?php echo $errors['name'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="url" id="photo" name="photo" placeholder="Enter photo URL" value="">
                        <small style="color: red;"><?php echo $errors['photo'] ?? ''; ?></small>
                    </div>
                     <div class="form-group">
                        <label for="nationality">Nationality</label>
                        <!-- <input type="text" id="nationality" name="nationality" placeholder="Enter player's nationality" value=""> -->
                        <select id="nationality" name="nationality">
                            <option value="">nationality?</option>
                            <?php   $query = "select *from `nationality`";
                                $result = mysqli_query($conn, $query);

                            if(!$result){
                             die("query failed". mysqli_error($conn));
                             }else {
                               while($row = mysqli_fetch_assoc($result)){
                                   ?>
                                <option value="<?php echo $row['id']; ?>"  ><?php echo $row['name_nationality']; ?></option>
                                   <?php
                               }
                            }
                               ?>
                        </select>
                        
                        <small style="color: red;"><?php echo $errors['nationality'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" id="rating" name="rating" placeholder="rating">
                        <small style="color: red;"><?php echo $errors['rating'] ?? ''; ?></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="club">Club</label>
                        <select   id="club" name="club">
                            <option value="">select club</option>
                            <?php  $query = "select * from `club`";
                            $result = mysqli_query($conn, $query);
                            if(!$result){
                                die("query failed". mysqli_error($conn));
                                }else {
                                  while($row = mysqli_fetch_assoc($result)){
                                      ?>
                                   <option value="<?php echo $row['id']; ?>" ><?php echo $row['name_club']; ?></option>
                                      <?php
                                  }
                               }
                                  ?>
                        </select>
                        <small style="color: red;"><?php echo $errors['club'] ?? ''; ?></small>
                    </div>
                   
                    <div class="form-group">
                        <label for="playerType">Select Player Type:</label>
                        <select id="playerType" name="playerType">
                            <option value="">Select</option>
                            <option value="0" >Goalkeeper</option>
                            <option value="1">Field Player</option>
                        </select>
                        <small style="color: red;"><?php echo $errors['playerType'] ?? ''; ?></small>
                    </div>
                </div>

                <!-- Section 3 (Goalkeeper-specific) -->

                <div class="form-section hidden" id="goalkeeperFields">
                    <div class="form-group">
                        <label for="diving">Diving</label>
                        <input type="number" id="diving" name="diving" placeholder="Enter diving score" value="<?php echo $data['diving'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['diving'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="handling">Handling</label>
                        <input type="number" id="handling" name="handling" placeholder="Enter handling score" value="<?php echo $data['handling'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['handling'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="reflexes">Reflexes</label>
                        <input type="number" id="reflexes" name="reflexes" placeholder="Enter reflexes score" value="<?php echo $data['reflexes'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['reflexes'] ?? ''; ?></small>
                    </div>
                </div>


                <!-- Section 3 (Player-specific) -->
                
                <div class="form-section hidden" id="playerFields">
                    <div class="form-group">
                        <label for="playerPosition">Position</label>
                        <select id="playerPosition" name="playerPosition">
                            <option value="">Select</option>
                            <option value="LB" >Left Back (LB)</option>
                            <option value="CBL" >Center Back Left (CBL)</option>
                            <option value="CBR" >Center Back Right (CBR)</option>
                            <option value="RB" >Right Back (RB)</option>
                            <option value="CDM" >Defensive Midfielder (CDM)</option>
                            <option value="CM" >Center Midfielder (CM)</option>
                            <option value="CAM" >Attacking Midfielder (CAM)</option>
                            <option value="LW" >Left Winger (LW)</option>
                            <option value="ST" >Center Forward (ST)</option>
                            <option value="RW" >Right Winger (RW)</option>
                        </select>
                        <small style="color: red;"><?php echo $errors['playerPosition'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="pace">Pace</label>
                        <input type="number" id="pace" name="pace" placeholder="Enter pace score" value="">
                        <small style="color: red;"><?php echo $errors['pace'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="shooting">Shooting</label>
                        <input type="number" id="shooting" name="shooting" placeholder="Enter shooting score" value="">
                        <small style="color: red;"><?php echo $errors['shooting'] ?? ''; ?></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="defending">Defending</label>
                        <input type="number" id="defending" name="defending" placeholder="Enter defending score" value="">
                        <small style="color: red;"><?php echo $errors['defending'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="physical">Physical</label>
                        <input type="number" id="physical" name="physical" placeholder="Enter physical score" value="">
                        <small style="color: red;"><?php echo $errors['physical'] ?? ''; ?></small>
                    </div>
                </div>
             

                <div class="buttons">
                    <button class="btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
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
