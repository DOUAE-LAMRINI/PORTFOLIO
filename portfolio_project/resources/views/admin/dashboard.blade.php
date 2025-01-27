<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css">
    <style>
        /* Styling for sidebar and content */
        body {
            background-color: #F1F1F1;
            color: #270102;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            background-color: #E3E2E3;
            padding: 20px;
            position: fixed;
            width: 80px;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: #804E50;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 0;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .sidebar a i {
            font-size: 26px;
        }

        .sidebar a span {
            font-size: 12px;
            margin-top: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #F1F1F1;
            border-radius: 8px;
        }

        .content {
            margin-left: 100px;
            padding: 20px;
        }

        .welcome-title {
            color: #8E1B21;
            font-size: 40px;
            font-weight: 600;
            text-align: center;
        }

        .profile-section,
        .statistics,
        .contact-section {
            display: none;
            text-align: justify;
        }

        .info-container {
            background-color: #E3E2E3;
            padding: 20px;
            margin-bottom: 20px;
            text-align: justify;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .table-container table {
            width: 100%;
            margin-top: 20px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function showSection(section) {
            document.querySelector('.welcome-title').style.display = 'none';
            document.querySelector('.profile-section').style.display = 'none';
            document.querySelector('.statistics').style.display = 'none';
            document.querySelector('.contact-section').style.display = 'none';

            document.querySelector(`.${section}`).style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('statisticsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Visitors', 'Unique Visitors', 'Page Views'],
                    datasets: [{
                        label: 'Statistics',
                        data: [1234, 567, 890],
                        backgroundColor: ['#e74c3c', '#c0392b', '#e67e22'],
                        borderColor: '#444',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</head>

<body>
    <div class="sidebar">
        <a href="{{ url('/') }}"><i class="bi bi-house-door"></i><span>Home</span></a>
        <a href="#" onclick="showSection('contact-section')"><i class="bi bi-envelope"></i><span>Contact</span></a>
    </div>

    <div class="content">
        <center>
            <h1 class="welcome-title"><br><br>👨🏻‍💻 Welcome to the Admin Space 👨🏻‍💻</h1>
        </center>

        <!-- Profile Section -->
        <div class="profile-section">
            <h3>Profile Section</h3>
            <!-- Profile Content Here -->
        </div>

        <!-- Statistics Section -->
        <div class="statistics">
            <h3>Statistics</h3>
            <canvas id="statisticsChart"></canvas>
            <br><br>
            <button class="btn btn-primary" onclick="showSection('profile-section')">Back to Profile</button>
            <button class="btn btn-secondary" onclick="showSection('home')">Back to Home</button>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h3>Contact Messages</h3>
            <div class="table-container">
                <table class="table table-bordered">
                    <center>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Received At</th>
                            </tr>
                        </thead>
                    </center>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>