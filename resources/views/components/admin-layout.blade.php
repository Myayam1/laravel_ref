<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdown = document.getElementById('dropdown-data-master');

            // Check sessionStorage for the saved dropdown state
            const dropdownState = sessionStorage.getItem('dropdownState');

            // Set the dropdown visibility based on the saved state
            if (dropdownState === 'open') {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }

            // Toggle dropdown visibility and save the state in sessionStorage
            dropdownButton.addEventListener('click', function () {
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden'); // Make it visible
                    sessionStorage.setItem('dropdownState', 'open'); // Save state
                } else {
                    dropdown.classList.add('hidden'); // Hide it
                    sessionStorage.setItem('dropdownState', 'closed'); // Save state
                }
            });
        });
    </script>


    <title>{{ $title }}</title> <!-- Use the slot for the title -->
</head>
<body class="h-full">
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-admin-navbar></x-admin-navbar>
        <x-admin-sidebar></x-admin-sidebar>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 mt-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
