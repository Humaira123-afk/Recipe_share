<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RecipeShare')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* BODY - Clean & Gray Background */
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #111827;
        }

        main {
            margin-top: 80px; /* Adjusted for fixed navbar */
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 16px;
        }

        /* NAVBAR - Fixed & Sharp */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f97316;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            z-index: 100;
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
            color: #ffffff !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-actions .nav-link {
            padding: 8px 15px;
            border-radius: 0; /* Sharp edges */
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: none !important; /* No hover animation */
        }

        /* Fixed Nav Links (No Hover Color Change) */
        .nav-actions .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Very subtle overlay, no color change */
            color: #ffffff;
        }

        /* GLOBAL BUTTONS - Sharp & Fixed */
        .btn {
            display: inline-block;
            background-color: #f97316 !important;
            color: white !important;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 0 !important; /* Sharp edges */
            text-decoration: none;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 14px;
            transition: none !important;
            outline: none !important;
        }

        /* Forcing buttons to stay static */
        .btn:hover, .btn:active, .btn:focus {
            background-color: #f97316 !important;
            box-shadow: none !important;
        }

        /* Global Container for content alignment */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Sharp utility for any card or box */
        .sharp-card {
            background: white;
            border-radius: 0;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    @include('include.navbar') {{-- Common navbar --}}

    <main>
        @yield('content')
    </main>

</body>
</html>