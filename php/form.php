<?php
// Initialisation des variables et des erreurs
$errors = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données
    $data['name'] = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $data['photo'] = !empty($_POST['photo']) ? htmlspecialchars(trim($_POST['photo'])) : null;
    $data['nationality'] = !empty($_POST['nationality']) ? htmlspecialchars(trim($_POST['nationality'])) : null;
    $data['flag'] = !empty($_POST['flag']) ? htmlspecialchars(trim($_POST['flag'])) : null;
    $data['club'] = !empty($_POST['club']) ? htmlspecialchars(trim($_POST['club'])) : null;
    $data['logo'] = !empty($_POST['logo']) ? htmlspecialchars(trim($_POST['logo'])) : null;
    $data['rating'] = !empty($_POST['rating']) ? (int)$_POST['rating'] : null;
    $data['playerType'] = !empty($_POST['playerType']) ? $_POST['playerType'] : null;

    // Champs spécifiques au joueur ou au gardien
    if ($data['playerType'] === 'player') {
        $data['playerPosition'] = !empty($_POST['playerPosition']) ? $_POST['playerPosition'] : null;
        $data['pace'] = !empty($_POST['pace']) ? (int)$_POST['pace'] : null;
        $data['shooting'] = !empty($_POST['shooting']) ? (int)$_POST['shooting'] : null;
        $data['dribbling'] = !empty($_POST['dribbling']) ? (int)$_POST['dribbling'] : null;
        $data['defending'] = !empty($_POST['defending']) ? (int)$_POST['defending'] : null;
        $data['physical'] = !empty($_POST['physical']) ? (int)$_POST['physical'] : null;
    } elseif ($data['playerType'] === 'goalkeeper') {
        $data['diving'] = !empty($_POST['diving']) ? (int)$_POST['diving'] : null;
        $data['handling'] = !empty($_POST['handling']) ? (int)$_POST['handling'] : null;
        $data['reflexes'] = !empty($_POST['reflexes']) ? (int)$_POST['reflexes'] : null;
    }

    // Validation des champs obligatoires
    foreach (['name', 'photo', 'nationality', 'flag', 'club', 'logo', 'rating', 'playerType'] as $field) {
        if (empty($data[$field])) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    if ($data['playerType'] === 'player') {
        foreach (['playerPosition', 'pace', 'shooting', 'dribbling', 'defending', 'physical'] as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . " is required for players.";
            }
        }
    } elseif ($data['playerType'] === 'goalkeeper') {
        foreach (['diving', 'handling', 'reflexes'] as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . " is required for goalkeepers.";
            }
        }
    }

    // Si aucune erreur, afficher les données et réinitialiser
    if (empty($errors)) {
        echo '<h2>Form Data:</h2>';
        echo '<pre>' . print_r($data, true) . '</pre>';

        // Réinitialiser le formulaire
        $data = [];
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
            <form id="paginatedForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Section 1 -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter player's name" value="<?php echo $data['name'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['name'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="url" id="photo" name="photo" placeholder="Enter photo URL" value="<?php echo $data['photo'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['photo'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nationality">Nationality</label>
                        <input type="text" id="nationality" name="nationality" placeholder="Enter player's nationality" value="<?php echo $data['nationality'] ?? ''; ?>">
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
                        <input type="text" id="club" name="club" placeholder="Enter club name" value="<?php echo $data['club'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['club'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="logo">Club Logo</label>
                        <input type="url" id="logo" name="logo" placeholder="Enter logo URL" value="<?php echo $data['logo'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['logo'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" id="rating" name="rating" placeholder="Enter player's rating" value="<?php echo $data['rating'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['rating'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="playerType">Select Player Type:</label>
                        <select id="playerType" name="playerType">
                            <option value="">Select</option>
                            <option value="player" <?php echo ($data['playerType'] === 'player') ? 'selected' : ''; ?>>Field Player</option>
                            <option value="goalkeeper" <?php echo ($data['playerType'] === 'goalkeeper') ? 'selected' : ''; ?>>Goalkeeper</option>
                        </select>
                        <small style="color: red;"><?php echo $errors['playerType'] ?? ''; ?></small>
                    </div>
                </div>

                <!-- Section 3 (Goalkeeper-specific) -->
                <?php if ($data['playerType'] === 'goalkeeper' || $_SERVER['REQUEST_METHOD'] === 'GET'): ?>
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
                <?php endif; ?>

                <!-- Section 3 (Player-specific) -->
                <?php if ($data['playerType'] === 'player' || $_SERVER['REQUEST_METHOD'] === 'GET'): ?>
                <div class="form-section" id="playerFields">
                    <div class="form-group">
                        <label for="playerPosition">Position</label>
                        <select id="playerPosition" name="playerPosition">
                            <option value="">Select</option>
                            <option value="LB" <?php echo ($data['playerPosition'] === 'LB') ? 'selected' : ''; ?>>Left Back (LB)</option>
                            <option value="CBL" <?php echo ($data['playerPosition'] === 'CBL') ? 'selected' : ''; ?>>Center Back Left (CBL)</option>
                            <option value="CBR" <?php echo ($data['playerPosition'] === 'CBR') ? 'selected' : ''; ?>>Center Back Right (CBR)</option>
                            <option value="RB" <?php echo ($data['playerPosition'] === 'RB') ? 'selected' : ''; ?>>Right Back (RB)</option>
                            <option value="CDM" <?php echo ($data['playerPosition'] === 'CDM') ? 'selected' : ''; ?>>Defensive Midfielder (CDM)</option>
                            <option value="CM" <?php echo ($data['playerPosition'] === 'CM') ? 'selected' : ''; ?>>Center Midfielder (CM)</option>
                            <option value="CAM" <?php echo ($data['playerPosition'] === 'CAM') ? 'selected' : ''; ?>>Attacking Midfielder (CAM)</option>
                            <option value="LW" <?php echo ($data['playerPosition'] === 'LW') ? 'selected' : ''; ?>>Left Winger (LW)</option>
                            <option value="ST" <?php echo ($data['playerPosition'] === 'ST') ? 'selected' : ''; ?>>Center Forward (ST)</option>
                            <option value="RW" <?php echo ($data['playerPosition'] === 'RW') ? 'selected' : ''; ?>>Right Winger (RW)</option>
                        </select>
                        <small style="color: red;"><?php echo $errors['playerPosition'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="pace">Pace</label>
                        <input type="number" id="pace" name="pace" placeholder="Enter pace score" value="<?php echo $data['pace'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['pace'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="shooting">Shooting</label>
                        <input type="number" id="shooting" name="shooting" placeholder="Enter shooting score" value="<?php echo $data['shooting'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['shooting'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dribbling">Dribbling</label>
                        <input type="number" id="dribbling" name="dribbling" placeholder="Enter dribbling score" value="<?php echo $data['dribbling'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['dribbling'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="defending">Defending</label>
                        <input type="number" id="defending" name="defending" placeholder="Enter defending score" value="<?php echo $data['defending'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['defending'] ?? ''; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="physical">Physical</label>
                        <input type="number" id="physical" name="physical" placeholder="Enter physical score" value="<?php echo $data['physical'] ?? ''; ?>">
                        <small style="color: red;"><?php echo $errors['physical'] ?? ''; ?></small>
                    </div>
                </div>
                <?php endif; ?>

                <div class="buttons">
                    <button class="btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
