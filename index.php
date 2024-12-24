<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
}

include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sim RS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        a {
            text-decoration: none;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-align: center;
            display: inline-block;
            margin: 10px 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .logout-button {
            background-color: #f44336;
        }
        .logout-button:hover {
            background-color: #e53935;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            color: #2196F3;
            margin: 0 5px;
            font-weight: bold;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Alat Elektromedis</h1>
        <div>
            <a href="add.php" class="button">Tambah Alat</a>
            <a href="logout.php" class="button logout-button">Logout</a>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Tahun</th>
                <th>Merek</th>
                <th>Lokasi</th>
                <th>Status Kalibrasi</th>
                <th>Aksi</th>
            </tr>
            <?php  
            $i = 1;
            while($user_data = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$user_data['nama_alat']."</td>";
                echo "<td>".$user_data['tahun']."</td>";
                echo "<td>".$user_data['merek']."</td>";    
                echo "<td>".$user_data['lokasi']."</td>";    
                echo "<td>".$user_data['status_kalibrasi']."</td>"; 
                echo "<td class='actions'><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td>"; 
                echo "</tr>";
                $i++;
            }
            ?>
        </table>
    </div>
</body>
</html>