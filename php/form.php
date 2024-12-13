

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Manager</title>
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>


<body>
    
<div class="form-container" >
<h2>Player Form</h2>
<form id="paginatedForm" method="POST">
 

    <!-- Section 1 -->
    <div class="form-section hidden">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text"  id="name" name="name" placeholder="Enter player's name">
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="url" id="photo" name="photo" placeholder="Enter photo URL" >
        </div>
        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" id="nationality" placeholder="Enter nationality">
        </div>
        <div class="form-group">
            <label for="flag">National Flag</label>
            <input type="url" id="flag" placeholder="Enter flag URL">
        </div>
    </div>

    <!-- Section 2 -->
    <div class="form-section hidden">
        <div class="form-group">
            <label for="club">Club</label>
            <input type="text" id="club" placeholder="Enter club name">
        </div>
        <div class="form-group">
            <label for="logo">Club Logo</label>
            <input type="url" id="logo" placeholder="Enter logo URL">
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" id="rating" placeholder="Enter rating">
        </div>
          <!-- Type Selection -->
       
        <div class="form-group">
            <label for="playerType">Select Player Type:</label>
            <select id="playerType">
                <option value=""></option>
                <option value="player">Field Player</option>
                <option value="goalkeeper">Goalkeeper</option>
            </select>
        </div>
    
    </div>

     <!-- Section 3 (Goalkeeper-specific) -->
    <div class="form-section hidden" id="goalkeeperFields">
        <div class="form-group">
            <label for="diving">Diving</label>
            <input type="number"  id="diving" placeholder="Enter diving score">
        </div>
        <div class="form-group">
            <label for="handling">Handling</label>
            <input type="number"  id="handling" placeholder="Enter handling score">
        </div>
        <div class="form-group">
            <label for="reflexes">Reflexes</label>
            <input type="number"  id="reflexes" placeholder="Enter reflexes score">
        </div>
    </div>

    <!-- Section 3 (Player-specific) -->
    <div class="form-section hidden" id="playerFields">
        <div class="form-group">
            <label for="playerPosition">position</label>
    
            <select id="playerPosition">
                
                <!-- Defenders -->
                 <option value="">select</option>
                 <option value="gk" style="display: none;"></option>
                <option value="LB">Left Back (LB)</option>
                <option value="CBL">Center Back Left (CBL)</option>
                <option value="CBR">Center Back Right (CBR)</option>
                <option value="RB">Right Back (RB)</option>
            
                <!-- Midfielders -->
                <option value="CDM">Defensive Midfielder (CDM)</option>
                <option value="CM">Center Midfielder (CM)</option>
                <option value="CAM">Attacking Midfielder (CAM)</option>
            
                <!-- Forwards -->
                <option value="LW">Left Winger (LW)</option>
                <option value="ST">Center Forward (ST)</option>
                <option value="RW">Right Winger (RW)</option>
        
            </select>
            
        </div>
        <div class="form-group">
            <label for="pace">Pace</label>
            <input type="number"  id="pace" placeholder="Enter pace score">
        </div>
        <div class="form-group">
            <label for="shooting">Shooting</label>
            <input type="number"  id="shooting" placeholder="Enter shooting score">
        </div>
        <div class="form-group">
            <label for="dribbling">Dribbling</label>
            <input type="number" id="dribbling" placeholder="Enter dribbling score">
        </div>
        <div class="form-group">
            <label for="defending">Defending</label>
            <input type="number" id="defending" placeholder="Enter defending score">
        </div>
        <div class="form-group">
            <label for="physical">Physical</label>
            <input type="number" id="physical" placeholder="Entre physical score">
        </div>
       
    </div>

    

    <div class="buttons">

        <button class="btn" type="button" id="prevBtn">Previous</button>
        <button class="btn" type="button" id="nextBtn">Next</button>
         <input type="submit" id="submit" class="btn hidden" value="Submit">
        <button class="btn hidden" type="button" id="savechange">save changes</button>
    </div>
</form>
</div>



Welcome <?php echo $_POST["name"]; ?><br>

Your email address is: <?php echo $_POST["photo"]; ?>



<script src="../assets/js/validation.js"></script>
</body>

</html>