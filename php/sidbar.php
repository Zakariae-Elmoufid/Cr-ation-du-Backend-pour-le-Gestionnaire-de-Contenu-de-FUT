<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<aside class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-dark-bg-secondary shadow-lg transition-colors duration-200">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Players Management</h1>
                <button onclick="toggleDarkMode()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bx-moon text-xl dark:hidden'></i>
                    <i class='bx bx-sun text-xl hidden dark:inline text-white'></i>
                </button>
            </div>
            <nav class="mt-6 space-y-2">
                <a href="dashboard.php" class="block px-4 py-2 text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg">Dashboard</a>
                <a href="player.php" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg">Players List</a>
                <a href="form.php" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg">Add Player</a>
            </nav>
        </div>
    </aside>

    
    <script>
        
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }

        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', isDark);
        }
    </script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            'bg-primary': '#1a1a1a',
                            'bg-secondary': '#2d2d2d',
                        }
                    }
                }
            }
        }
    </script>
  
</body>
</html>