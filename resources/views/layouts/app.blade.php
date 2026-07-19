<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    

    @yield('styles')
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <aside class="sidebar">
            <h2>Sidebar</h2>
            <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>

            </ul>
        </aside>
    

    <main class="main-content">
        @yield('content')
    </main>
    </div>

    <footer>
        <p>&copy; 2026 My website. All rights reserved.</p>
    </footer>

</body>
@yield('scripts')
</html>