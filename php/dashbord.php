<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/dashbord.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Players Dashboard</title>
 
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

    <div class="main-content" id="mainContent">
        <div id="dashboard">
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Players</h3>
                    <div class="stat-value" id="totalPlayers">0</div>
                </div>
                <div class="stat-card">
                    <h3>Nationalities</h3>
                    <div class="stat-value" id="totalNationalities">0</div>
                </div>
                <div class="stat-card">
                    <h3>Clubs</h3>
                    <div class="stat-value" id="totalClubs">0</div>
                </div>
                <div class="stat-card">
                    <h3>Terrains</h3>
                    <div class="stat-value" id="totalTerrains">0</div>
                </div>
            </div>
        </div>

        <div id="playersList" class="players-grid" style="display:none;">
            <!-- Players will be dynamically added here -->
        </div>

      
    </div>
   
  <script src="../assets/js/dashbord.js"></script>
</body>
</html>