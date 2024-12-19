<?php include("confige.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Players Dashboard</title>
 
</head>
<body >
    
   <?php include("sidbar.php"); ?>


   <main class="ml-64 p-8 dark:bg-dark-bg-secondary h-[100vh] ">
        <!-- <div class="max-w-7xl mx-auto"></div> -->
    
    <div id="dashboard" class="  mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <div class="flex  flex-wrap justify-center gap-6">
        <!-- Total Players -->
        <div class=" stat-card w-[15rem] flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="icon-container bg-blue-100 text-blue-500 p-3 rounded-full">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-gray-700">Total Players</h3>
                <div class="stat-value text-2xl font-semibold text-gray-800" id="totalPlayers">
                    <?php 
                        $query = "SELECT COUNT(*) FROM player";
                        $result = mysqli_query($conn,$query);
                        $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                        echo $count;
                    ?>
                </div>
            </div>
        </div>

        <!-- Nationalities -->
        <div class="stat-card w-[15rem] flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="icon-container bg-green-100 text-green-500 p-3 rounded-full">
                <i class="fas fa-flag text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-gray-700">Nationalities</h3>
                <div class="stat-value text-2xl font-semibold text-gray-800" id="totalNationalities">
                    <?php 
                        $query = "SELECT COUNT(*) FROM nationality";
                        $result = mysqli_query($conn,$query);
                        $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                        echo $count;
                    ?>
                </div>
            </div>
        </div>

        <!-- Clubs -->
        <div class="stat-card w-[15rem] flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="icon-container bg-red-100 text-red-500 p-3 rounded-full">
                <i class="fas fa-futbol text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-gray-700">Clubs</h3>
                <div class="stat-value text-2xl font-semibold text-gray-800" id="totalClubs">
                    <?php 
                        $query = "SELECT COUNT(*) FROM club";
                        $result = mysqli_query($conn,$query);
                        $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                        echo $count;
                    ?>
                </div>
            </div>
        </div>

        <!-- Terrains -->
        <div class="stat-card w-[15rem] flex items-center p-4 bg-white rounded-lg shadow-md">
            <div class="icon-container bg-yellow-100 text-yellow-500 p-3 rounded-full">
                <i class="fas fa-map-marker-alt text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-gray-700">Terrains</h3>
                <div class="stat-value text-2xl font-semibold text-gray-800" id="totalTerrains">
                    0
                </div>
            </div>
        </div>
    </div>
</div>


        <div id="playersList" class="players-grid" style="display:none;">
            <!-- Players will be dynamically added here -->
        </div>

      
    </div>
   </main>
  <script src="../assets/js/dashbord.js"></script>
</body>
</html>