<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Visitor Locations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: #2c3e50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav {
            background: #34495e;
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #1abc9c;
        }

        main {
            flex: 1;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        main h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background: #34495e;
            color: #ecf0f1;
        }

        table th,
        table td {
            padding: 10px 15px;
            text-align: left;
        }

        table th {
            font-weight: bold;
        }

        table tbody tr:nth-child(odd) {
            background: #f9f9f9;
        }

        table tbody tr:hover {
            background: #f1f1f1;
        }

        table iframe {
            border: none;
            border-radius: 5px;
        }

        footer {
            background: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 10px 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-user-shield"></i> Admin Dashboard</h1>
        </header>
        <nav>
            <ul>
                <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="http://localhost/demo1/view_location.php"><i class="fas fa-users"></i> Visitors</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <main>
            <h2>Visitor Locations</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Visit Type</th>
                        <th>Visit Date</th>
                        <th>Location Map</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'db_connection.php';
                    $sql = "SELECT v.id, v.name, v.age, v.visit_type, v.visit_date, l.latitude, l.longitude
                            FROM visitors v
                            JOIN visitor_location l ON v.id = l.visitor_id
                            ORDER BY v.visit_date DESC";
                    $result = $conn->query($sql);
                    $i = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                   <td>" . $i++ . "</td> 
                                    <td>{$row['name']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['visit_type']}</td>
                                    <td>{$row['visit_date']}</td>
                                    <td>
                                        <iframe src='https://www.google.com/maps?q={$row['latitude']},{$row['longitude']}&hl=en;z=14&output=embed' 
                                                width='200' height='150' allowfullscreen loading='lazy'></iframe>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No visitor records found.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
        <footer>
            <p>&copy; 2025 Visitor Tracking System. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
