<!-- resources/views/layouts/master.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your common head content goes here -->
</head>
<body>
    <!-- Common header with the logo -->
    <header>
        <img src="{{ asset('images/logo.JPG') }}" alt="Logo">
    </header>

    <!-- Main content section -->
    <main>
        @yield('content') <!-- Content from child views will be inserted here -->
    </main>

    <!-- Your common footer content goes here -->
</body>
</html>
