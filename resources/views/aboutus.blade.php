@extends('layouts.app')

@section('styles')
    <style>
        body{
            font-family: Arial,sans-serif;
            margin: 0;
            padding:0;
            display:flex;
            flex-direction: column;
            min-height: 100vh;
        }
        nav ul{
            list-style-type: none;
            padding: 0;
            background: #005bb5;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
        nav ul li{
            padding: 14px 20px;
        }
        nav ul li a{
            color: white;
            text-decoration: nono;
        }
        .container{
            display: flex;
            flex: 1;
        }
        .sidebar{
            width: 250px;
            background: #f4f4f4;
            padding: 15px;
        }
        .main-content{
            flex: 1;
            padding: 20px;
        }
        .footer{
            background: #004080;
            color: white;
            text-align: center;
            padding: 10px;
            bottom: 0;
            width: 100%;
        }

    </style>
    @endsection
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
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 1</a></li>

            </ul>
        </aside>
    
    @section('content')

    <main class="main-content">
        <section>
            <h2>About Us</h2>
            <p>This is a simple HTML and CSS template to start your project</p>
        </section>
    </main>
    @endsection
    </div>

    <footer>
        <p>&copy; 2026 My website. All rights reserved.</p>
    </footer>
</body>
</html>




<html>
    <body>
        <h1>About us</h1>
    {{-- <h2>Name : {{$name}}</h2>
    <h2>ID : {{$id}}</h2> --}}

    <h2>Name : {{$name}}</h2>
    <h2>Email : {{ $email }}</h2>

        {{-- subview and view catching --}}
        @include('Subview.input',[
            'myname'=> $name,
        ])
    </body>
</html>

