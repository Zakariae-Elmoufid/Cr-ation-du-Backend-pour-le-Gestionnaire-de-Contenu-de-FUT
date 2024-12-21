<?php
include 'confige.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ;
    $photo = $_POST['photo'] ;
    $rating = $_POST['rating'] ;
    $nationality = $_POST['nationality'] ;
    $club = $_POST['club'] ;
    $playerType = $_POST['playerType'] ;



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
        $diving = $_POST['diving'] ;
        $handling = $_POST['handling'] ;
        $reflexes = $_POST['reflexes'] ;


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



        if (empty($diving))
            $errors['diving'] = "Name is required.";
        if (empty($handling))
            $errors['handling'] = "handling is required.";
        if (empty($reflexes))
            $errors['reflexes'] = "reflexes is required.";

    } elseif ($playerType === '1') {
        $position = $_POST['playerPosition'] ;
        $pace = $_POST['pace'] ;
        $shooting = $_POST['shooting'] ;
        $defending = $_POST['defending'] ;
        $physical = $_POST['physical'] ;

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


        if (empty($pace))
            $errors['pace'] = "pace is required";
        if (empty($shooting))
            $errors['shooting'] = "shooting is required";
        if (empty($defending))
            $errors['defending'] = "defending is required";
        if (empty($physical))
            $errors['physical'] = "physical is required";



    }





    if (empty($name))
        $errors['name'] = "Name is required.";
    if (empty($photo))
        $errors['photo'] = "Photo URL is required.";
    if (empty($rating))
        $errors['rating'] = "Rating is required.";
    if (empty($nationality))
        $errors["nationality"] = "nationality is required." ;
    if (empty($club))
        $errors['club'] = "Club is required.";
     if (empty($playerType)) $errors["playerType"] = "Player Type is required";



    if (empty($errors)) {

        $query = mysqli_query($conn, "INSERT INTO player(player_name, photo, rating , status_player ,id_nationality, id_club) VALUES ('$name','$photo','$rating',' $playerType ', '$nationality', '$club');");

        if ($query) {
            $last_id = mysqli_insert_id($conn);

            if ($playerType === '0') {
                $queryGK = mysqli_query($conn, "INSERT INTO gk_position  (diving, handling, reflexes, player_id) VALUES ('$diving', '$handling' ,'$reflexes','$last_id')");
                if ($queryGK) {
                    echo " $last_id";
                    echo "gk added successfully!";

                } else {
                    echo "3ndk error";
                }


            } else if ($playerType === '1') {
                $queryPlayer = mysqli_query($conn, "INSERT INTO other_position  (position_player, pace, shooting, defending , physical , player_id)
                 VALUES ('$position', '$pace' ,'$shooting', '$defending','$physical','$last_id');");
                if ($queryPlayer) {
                    echo " $last_id";
                    echo "Player added successfully! ";
                } else {
                    echo "3ndk error";
                }
            }

        } else {
            echo "3ndk error";
        }

        header("Location: " . $_SERVER['PHP_SELF']); 

    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player - FUT Champions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <?php include('sidbar.php'); ?>

    <main class="ml-64 p-8">
        <div class="w-xl  mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Add New Player</h2>

                <form action="" method="POST" class="space-y-6">
                    <!-- Basic Information Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-200">Player
                                Name</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter player's name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                            <small class="text-red-500"><?php echo $errors['name'] ?? ''?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="photo" class="text-sm font-medium text-gray-700 dark:text-gray-200">Photo
                                URL</label>
                            <input type="url" id="photo" name="photo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter photo URL" value="<?php echo isset($_POST['photo']) ? $_POST['photo'] : ''; ?>">
                            <small class="text-red-500"><?php echo $errors['photo'] ?? '' ; ?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="nationality"
                                class="text-sm font-medium text-gray-700 dark:text-gray-200">Nationality</label>
                            <select id="nationality" name="nationality"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white" >
                                <option value="">Select nationality</option>
                                <?php
                                $query = "SELECT * FROM `nationality`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['name_nationality']}</option>";
                                }
                                ?>
                            </select>
                            <small class="text-red-500"><?php echo $errors['nationality'] ?? ''; ?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="rating"
                                class="text-sm font-medium text-gray-700 dark:text-gray-200">Rating</label>
                            <input type="number" id="rating" name="rating"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter rating" value="<?php echo isset($_POST['rating']) ? $_POST['rating'] : ''; ?>">
                            <small class="text-red-500"><?php echo $errors['rating'] ?? ''; ?></small>
                        </div>

                        <div class="space-y-2">
                            <label for="club" class="text-sm font-medium text-gray-700 dark:text-gray-200">Club</label>
                            <select id="club" name="club"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select club</option>
                                <?php
                                $query = "SELECT * FROM `club`";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['name_club']}</option>";
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
                                <option value="">Select type</option>
                                <option value="0">Goalkeeper</option>
                                <option value="1">Field Player</option>
                            </select>
                            <small class="text-red-500"><?php echo $errors['playerType'] ?? ''; ?></small>
                        </div>
                    </div>

                    <!-- Goalkeeper Fields -->
                    <div id="goalkeeperFields" class="hidden space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="diving"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Diving</label>
                                <input type="number" id="diving" name="diving"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter diving score" value="<?php echo isset($_POST['diving']) ? $_POST['diving'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['diving'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="handling"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Handling</label>
                                <input type="number" id="handling" name="handling"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter handling score" value="<?php echo isset($_POST['handling']) ? $_POST['handling'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['handling'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="reflexes"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Reflexes</label>
                                <input type="number" id="reflexes" name="reflexes"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter reflexes score" value="<?php echo isset($_POST['reflexes']) ? $_POST['reflexes'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['reflexes'] ?? ''; ?></small>
                            </div>
                        </div>
                    </div>

                    <!-- Field Player Fields -->
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
                                    placeholder="Enter pace score" value="<?php echo isset($_POST['pace']) ? $_POST['pace'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['pace'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="shooting"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Shooting</label>
                                <input type="number" id="shooting" name="shooting"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter shooting score" value="<?php echo isset($_POST['shooting']) ? $_POST['shooting'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['shooting'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="defending"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Defending</label>
                                <input type="number" id="defending" name="defending"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter defending score" value="<?php echo isset($_POST['defending']) ? $_POST['defending'] : ''; ?>">
                                <small class="text-red-500"><?php echo $errors['defending'] ?? ''; ?></small>
                            </div>

                            <div class="space-y-2">
                                <label for="physical"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-200">Physical</label>
                                <input type="number" id="physical" name="physical"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Enter physical score" value="<?php echo isset($_POST['physical']) ? $_POST['physical'] : ''; ?>">
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
        </div>
    </main>



    <script>
        document.getElementById('playerType').addEventListener('change', function () {
            const playerFields = document.getElementById('playerFields');
            const goalkeeperFields = document.getElementById('goalkeeperFields');

            if (this.value === '0') {
                playerFields.classList.add('hidden');
                goalkeeperFields.classList.remove('hidden');
            } else if (this.value === '1') {
                goalkeeperFields.classList.add('hidden');
                playerFields.classList.remove('hidden');
            } 
        });
    </script>
</body>

</html>