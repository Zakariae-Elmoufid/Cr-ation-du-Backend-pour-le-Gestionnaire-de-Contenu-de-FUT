<?php include('confige.php'); ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/dashbord.css">
  <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>list player </title>
</head>
<body>

<div class="sidebar ">
        <h1>Players Management</h1>
        <div class="sidebar-menu">
            <button><a href="dashbord.php">Dashboard</a></button>
            <button><a href="player.php">Players List</a></button>
            <button><a href="form.php">Add Player</a></button>
        </div>
    </div>

<div class="main ">
    <h2>Players List</h2>
    <table class="w-full border-collapse">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-4 py-2 border-b border-gray-700 text-left">ID</th>
            <th class="px-4 py-2 border-b border-gray-700 text-left">Player Name</th>
            <th class="px-4 py-2 border-b border-gray-700 text-left">Photo</th>
            <th class="px-4 py-2 border-b border-gray-700 text-left">Rating</th>
            <th class="px-4 py-2 border-b border-gray-700 text-left">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white text-gray-900">
        <?php 
        $query = 'SELECT player.id , rating , player_name , photo , flag , logo , diving , handling , reflexes , pace , shooting, defending , physical 
         FROM `player` 
         JOIN nationality ON player.id_nationality = nationality.id 
         JOIN club ON  player.id_club = club.id
         left join  other_position on other_position.player_id = player.id
         left join  gk_position on gk_position.player_id  =player.id
         ';
        $result = mysqli_query($conn, $query);

        if(!$result){
            die("query failed". mysqli_error($conn));
        } else {
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr class="hover:bg-gray-100 transition duration-300">
        <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['id']; ?></td>

        <td class="px-4 py-2 border-b border-gray-300">
                <img src="<?php echo $row['logo']; ?>" alt="logo" class="w-6 h-6 object-cover rounded-full">
            </td>
            <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['rating']; ?></td>
            <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['player_name']; ?></td>
            <td class="px-4 py-2 border-b border-gray-300">
                <img src="<?php echo $row['photo']; ?>" alt="Player Photo" class="w-16 h-16 object-cover rounded-md">
            </td>
            <td class="px-4 py-2 border-b border-gray-300">
                <img src="<?php echo $row['flag']; ?>" alt="Flag" class="w-6 h-6 object-cover rounded-full">
            </td>
            <td class="px-4 py-2 border-b border-gray-300 space-x-2">
              <a href="update.php?id=<?php echo $row['id'];?>"class="bx bxs-pencil text-blue-500 cursor-pointer hover:text-blue-700" >
              </a>
            </td>
            <td lass="px-4 py-2 border-b border-gray-300 space-x-2">
               <a href="delet.php?id=<?php echo $row['id'];?>" class="bx bx-trash text-red-500 cursor-pointer hover:text-red-700"></a>
            </td>
        </tr>
        <?php 
            }
        }
        ?>
    </tbody>
</table>



</div>


  
</body>
</html>
