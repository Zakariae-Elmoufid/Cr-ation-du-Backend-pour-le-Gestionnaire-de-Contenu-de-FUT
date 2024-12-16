<?php
include 'confige.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'] ?? null;
    $photo = $_POST['photo'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $nationality = $_POST['nationality'] ?? null;
    $flag = $_POST['flag'] ?? null;
    $club = $_POST['club'] ?? null;
    $logo = $_POST['logo'] ?? null;
    $playerType = $_POST['playerType'] ?? null;

    $errors = [];

    // Validate fields
    if (empty($name)) $errors['name'] = "Name is required.";
    if (empty($photo)) $errors['photo'] = "Photo URL is required.";
    if (empty($rating)) $errors['rating'] = "Rating is required.";
    if (empty($nationality)) $errors['nationality'] = "Nationality is required.";
    if (empty($club)) $errors['club'] = "Club is required.";

    if (empty($errors)) {
        // Insert into player table
        $stmt = $conn->prepare("INSERT INTO player (player_name, photo, rating, status_player) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $name, $photo, $rating, $status_player);
        $stmt->execute();
        $stmt->close();
        

      // Insert into nationality table
      $stmtNationality = $conn->prepare("INSERT INTO nationality (name_nationality, flag) VALUES (?, ?)");
      $stmtNationality->bind_param("ss", $nationality, $flag);
      $stmtNationality->execute();
      $stmtNationality->close();

        // Insert into club table
        $stmtClub = $conn->prepare("INSERT INTO club (name_club, logo ) VALUES (?, ?)");
        $stmtClub->bind_param("ss", $club, $logo );
        $stmtClub->execute();
        $stmtClub->close();

         // Insert into player type-specific tables
         if ($playerType === 'goalkeeper') {
            $diving = $_POST['diving'] ?? null;
            $handling = $_POST['handling'] ?? null;
            $reflexes = $_POST['reflexes'] ?? null;

            $stmtGK = $conn->prepare("INSERT INTO gk_position (diving, handling, reflexes, player_id) VALUES (?, ?, ?, ?)");
            $stmtGK->bind_param("iiii", $diving, $handling, $reflexes, $player_id);
            $stmtGK->execute();
            if (isset($stmtGK)) $stmtGK->close();
        } else if ($playerType === 'player') {
            $position = $_POST['playerPosition'] ?? '';
            $pace = $_POST['pace'] ?? null;
            $shooting = $_POST['shooting'] ?? null;
            $dribbling = $_POST['dribbling'] ?? null;
            $defending = $_POST['defending'] ?? null;
            $physical = $_POST['physical'] ?? null;

            $stmtPlayer = $conn->prepare("INSERT INTO other_position (position_player, pace, shooting, dribbling, defending, physical, player_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtPlayer->bind_param("siiiiii", $position, $pace, $shooting, $dribbling, $defending, $physical, $player_id);
            $stmtPlayer->execute();
            if (isset($stmtPlayer)) $stmtPlayer->close();
        }

         

        echo "Player added successfully!";
        
    }




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
            <button>Dashboard</button>
            <button>Players List</button>
            <button>Add Player</button>
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
                        <input type="text" id="nationality" name="nationality" placeholder="Enter player's nationality" value="">
                        <small style="color: red;"><?php echo $errors['nationality'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="flag">National Flag</label>
                        <input type="url" id="flag" name="flag" placeholder="Enter flag URL" value="<?php echo $data['flag'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['flag'] ?? ''; ?></small>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="club">Club</label>
                        <input type="text" id="club" name="club" placeholder="Enter club name" value="">
                        <small style="color: red;"><?php echo $errors['club'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="logo">Club Logo</label>
                        <input type="url" id="logo" name="logo" placeholder="Enter logo URL" value="">
                        <small style="color: red;"><?php echo $errors['logo'] ?? ''; ?></small>
                    </div> 
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" id="rating" name="rating" placeholder="">
                        <small style="color: red;"><?php echo $errors['rating'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="playerType">Select Player Type:</label>
                        <select id="playerType" name="playerType">
                            <option value="">Select</option>
                            <option value="player">Field Player</option>
                            <option value="goalkeeper" >Goalkeeper</option>
                        </select>
                        <small style="color: red;"><?php echo $errors['playerType'] ?? ''; ?></small>
                    </div>
                </div>

                <!-- Section 3 (Goalkeeper-specific) -->

                <div class="form-section" id="goalkeeperFields">
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
                
                <div class="form-section" id="playerFields">
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
                        <label for="dribbling">Dribbling</label>
                        <input type="number" id="dribbling" name="dribbling" placeholder="Enter dribbling score" value="">
                        <small style="color: red;"><?php echo $errors['dribbling'] ?? ''; ?></small>
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
    const playerTypeSelect = document.getElementById('playerType');
    const playerFields = document.getElementById('playerFields');
    const goalkeeperFields = document.getElementById('goalkeeperFields');

    function toggleFields() {
        const selectedType = playerTypeSelect.value;
        if (selectedType === 'player') {
            playerFields.style.display = 'block';
            goalkeeperFields.style.display = 'none';
        } else if (selectedType === 'goalkeeper') {
            playerFields.style.display = 'none';
            goalkeeperFields.style.display = 'block';
        } else {
            playerFields.style.display = 'none';
            goalkeeperFields.style.display = 'none';
        }
    }

    playerTypeSelect.addEventListener('change', toggleFields);
    window.onload = toggleFields; 
</script>


</body>
</html>
