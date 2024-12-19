<?php include('confige.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>
<body class="bg-gray-100 dark:bg-dark-bg-primary transition-colors duration-200">
    <!-- Sidebar -->
     <?php include ('sidbar.php'); ?>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Players List</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search player..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-dark-bg-secondary dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class='bx bx-search absolute left-3 top-2.5 text-gray-400'></i>
                    </div>
                    <a href="form.php" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class='bx bx-plus mr-2'></i>
                        Add Player
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white dark:bg-dark-bg-secondary rounded-lg shadow overflow-hidden transition-colors duration-200">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Photo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Club</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Country</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        <?php
                        $query = 'SELECT player.id, rating, player_name, photo, flag, logo, diving, handling, reflexes, pace, shooting, defending, physical
                                 FROM `player`
                                 JOIN nationality ON player.id_nationality = nationality.id
                                 JOIN club ON player.id_club = club.id
                                 LEFT JOIN other_position ON other_position.player_id = player.id
                                 LEFT JOIN gk_position ON gk_position.player_id = player.id';
                        
                        $result = mysqli_query($conn, $query);

                        if(!$result) {
                            die("Query failed" . mysqli_error($conn));
                        }

                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="<?php echo htmlspecialchars($row['photo']); ?>" 
                                     alt="Player photo" 
                                     class="h-12 w-12 rounded-full object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    <?php echo htmlspecialchars($row['player_name']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-full">
                                    <?php echo htmlspecialchars($row['rating']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="<?php echo htmlspecialchars($row['logo']); ?>" 
                                     alt="Club logo" 
                                     class="h-6 w-6 object-contain">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="<?php echo htmlspecialchars($row['flag']); ?>" 
                                     alt="Country flag" 
                                     class="h-6 w-6 object-contain">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-3">
                                    <a href="update.php?id=<?php echo $row['id']; ?>" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                        <i class='bx bx-edit-alt text-xl'></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" 
                                       class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                       onclick="return confirm('Are you sure you want to delete this player?');">
                                        <i class='bx bx-trash text-xl'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>