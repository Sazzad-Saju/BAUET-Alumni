<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: admin/adminlogin.php");
    exit(); // Exit the current script
}

// User is logged in, continue with the rest of the code

// Access the email from the session variable
$email = $_SESSION['email'];

// ... Rest of your code ...
?>


<!DOCTYPE html>
<html>
<head>
    <title>Alumni Table</title>
    <link rel="stylesheet" href="event.css" />
  
  <!-- Boxicons CDN Link -->
  <link
    href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
    rel="stylesheet"
  />
  <style>

.section2  {
  position: relative;
  background: #e4e9f7;
  min-height: 50vh;
  display: inline;
  justify-content: center;
  align-items: center;
}

.section2 .card {
  background-color: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin: 20px auto;
  max-width: 400px;
}
        

.section2 .card h2 {
            margin-top: 0;
        }

        .section2 .card form {
            display: flex;
            flex-direction: column;
        }

        .section2 .card label {
            margin-bottom: 10px;
        }

        .section2  .card input[type="text"],
        .section2 .card input[type="file"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .section2  .card input[type="submit"] {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .section2   .card input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Google Font Link */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
.sidebar {
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 78px;
  background: #11101d;
  padding: 6px 14px;
  z-index: 99;
  transition: all 0.5s ease;
}
.sidebar.open {
  width: 250px;
}
.sidebar .logo-details {
  height: 60px;
  display: flex;
  align-items: center;
  position: relative;
}
.sidebar .logo-details .icon {
  opacity: 0;
  transition: all 0.5s ease;
}
.sidebar .logo-details .logo_name {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  opacity: 0;
  transition: all 0.5s ease;
}
.sidebar.open .logo-details .icon,
.sidebar.open .logo-details .logo_name {
  opacity: 1;
}
.sidebar .logo-details #btn {
  position: absolute;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  font-size: 22px;
  transition: all 0.4s ease;
  font-size: 23px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s ease;
}
.sidebar.open .logo-details #btn {
  text-align: right;
}
.sidebar i {
  color: #fff;
  height: 60px;
  min-width: 50px;
  font-size: 28px;
  text-align: center;
  line-height: 60px;
}
.sidebar .nav-list {
  margin-top: 20px;
  height: 100%;
}
.sidebar li {
  position: relative;
  margin: 8px 0;
  list-style: none;
}
.sidebar li .tooltip {
  position: absolute;
  top: -20px;
  left: calc(100% + 15px);
  z-index: 3;
  background: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 15px;
  font-weight: 400;
  opacity: 0;
  white-space: nowrap;
  pointer-events: none;
  transition: 0s;
}
.sidebar li:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  transition: all 0.4s ease;
  top: 50%;
  transform: translateY(-50%);
}
.sidebar.open li .tooltip {
  display: none;
}
.sidebar input {
  font-size: 15px;
  color: #fff;
  font-weight: 400;
  outline: none;
  height: 50px;
  width: 100%;
  width: 50px;
  border: none;
  border-radius: 12px;
  transition: all 0.5s ease;
  background: #1d1b31;
}
.sidebar.open input {
  padding: 0 20px 0 50px;
  width: 100%;
}
.sidebar .bx-search {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  font-size: 22px;
  background: #1d1b31;
  color: #fff;
}
.sidebar.open .bx-search:hover {
  background: #1d1b31;
  color: #fff;
}
.sidebar .bx-search:hover {
  background: #fff;
  color: #11101d;
}
.sidebar li a {
  display: flex;
  height: 100%;
  width: 100%;
  border-radius: 12px;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
  background: #11101d;
}
.sidebar li a:hover {
  background: #fff;
}
.sidebar li a .links_name {
  color: #fff;
  font-size: 15px;
  font-weight: 400;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: 0.4s;
}
.sidebar.open li a .links_name {
  opacity: 1;
  pointer-events: auto;
}
.sidebar li a:hover .links_name,
.sidebar li a:hover i {
  transition: all 0.5s ease;
  color: #11101d;
}
.sidebar li i {
  height: 50px;
  line-height: 50px;
  font-size: 18px;
  border-radius: 12px;
}
.sidebar li.profile {
  position: fixed;
  height: 60px;
  width: 78px;
  left: 0;
  bottom: -8px;
  padding: 10px 14px;
  background: #1d1b31;
  transition: all 0.5s ease;
  overflow: hidden;
}
.sidebar.open li.profile {
  width: 250px;
}
.sidebar li .profile-details {
  display: flex;
  align-items: center;
  flex-wrap: nowrap;
}
.sidebar li img {
  height: 45px;
  width: 45px;
  object-fit: cover;
  border-radius: 6px;
  margin-right: 10px;
}
.sidebar li.profile .name,
.sidebar li.profile .job {
  font-size: 15px;
  font-weight: 400;
  color: #fff;
  white-space: nowrap;
}
.sidebar li.profile .job {
  font-size: 12px;
}
.sidebar .profile #log_out {
  position: absolute;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  background: #1d1b31;
  width: 100%;
  height: 60px;
  line-height: 60px;
  border-radius: 0px;
  transition: all 0.5s ease;
}
.sidebar.open .profile #log_out {
  width: 50px;
  background: none;
}

    </style>
    <style>
        /* CSS styling for the card */
        .card {
            max-width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #B2BEB5;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            font-family: Arial, sans-serif;
            height: 400px;
            overflow: auto;
            margin-bottom: 20px;
        }
        .card table {
            width: 100%;
            border-collapse: collapse;
        }
        .card th, .card td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .card th {
            background-color: #f7f7f7;
            font-weight: bold;
        }
        .card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card .delete-btn {
            background-color: #ff5c5c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .card .delete-btn:hover {
            background-color: #ff3333;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"] {
            padding: 5px;
        }
        .search-form input[type="submit"] {
            padding: 5px 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<?php
  include 'sidebar.php';
  ?>

    <div class="card">
        <h2>Alumni Table</h2>
        <form class="search-form" method="get">
            <input type="text" name="search" placeholder="Search by Student ID" />
            <input type="submit" value="Search" />
        </form>
        <table>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father's Name</th>
                <th>Mother's Name</th>
                <th>Date of Birth</th>
                <th>Batch</th>
                <th>Department</th>
                <th>Session Year</th>
                <th>Photo</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "alumni";

            $conn_students = new mysqli($servername, $username, $password, $dbname);
            if ($conn_students->connect_error) {
                die("Connection failed: " . $conn_students->connect_error);
            }

            // Delete the row if the delete button is clicked
            if (isset($_POST['delete_id_students'])) {
                $delete_id_students = $_POST['delete_id_students'];

                // Delete the row from the "students" table
                $sql = "DELETE FROM students WHERE student_id = $delete_id_students";
                if ($conn_students->query($sql) === TRUE) {
                    echo "Row deleted successfully.";
                } else {
                    echo "Error deleting row: " . $conn_students->error;
                }
            }

            // Fetch data from the "students" table
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql_students = "SELECT * FROM students";
            if (!empty($search)) {
                $sql_students .= " WHERE student_id LIKE '%$search%'";
            }
            $result_students = $conn_students->query($sql_students);

            if ($result_students->num_rows > 0) {
                while ($row = $result_students->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['student_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['father_name'] . "</td>";
                    echo "<td>" . $row['mother_name'] . "</td>";
                    echo "<td>" . $row['date_of_birth'] . "</td>";
                    echo "<td>" . $row['batch'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['session_year'] . "</td>";
                    echo "<td><img src='" . $row['photo'] . "'></td>";

                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>";
                    echo "<form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>";
                    echo "<input type='hidden' name='delete_id_students' value='" . $row['student_id'] . "' />";
                    echo "<input class='delete-btn' type='submit' value='Delete' />";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No records found.</td></tr>";
            }

            $conn_students->close();
            ?>
        </table>
    </div>
<!-- ===================================verify table========================= -->
    <div class="card">
        <h2>Verify Table</h2>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Date of Birth</th>
                <th>Session Year</th>
                <th>Action</th>
            </tr>
            <?php
            $conn_verify = new mysqli($servername, $username, $password, $dbname);
            if ($conn_verify->connect_error) {
                die("Connection failed: " . $conn_verify->connect_error);
            }

            // Delete the row if the delete button is clicked
            if (isset($_POST['delete_id_verify'])) {
                $delete_id_verify = $_POST['delete_id_verify'];

                // Delete the row from the "verify" table
                $sql_verify = "DELETE FROM verify WHERE student_id = $delete_id_verify";
                if ($conn_verify->query($sql_verify) === TRUE) {
                    echo "Row deleted successfully.";
                } else {
                    echo "Error deleting row: " . $conn_verify->error;
                }
            }

            // Fetch data from the "verify" table
            $sql_verify = "SELECT * FROM verify";
            $result_verify = $conn_verify->query($sql_verify);

            if ($result_verify->num_rows > 0) {
                while ($row_verify = $result_verify->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_verify['student_id'] . "</td>";
                    echo "<td>" . $row_verify['date_of_birth'] . "</td>";
                    echo "<td>" . $row_verify['session_year'] . "</td>";
                    echo "<td>";
                    echo "<form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>";
                    echo "<input type='hidden' name='delete_id_verify' value='" . $row_verify['student_id'] . "' />";
                    echo "<input class='delete-btn' type='submit' value='Delete' />";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found.</td></tr>";
            }

            $conn_verify->close();
            ?>
        </table>
    </div>

    <div class="card">
    <h2>Notice Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>PDF Filename</th>
            <th>Action</th>
        </tr>
        <?php
        $conn_notice = new mysqli($servername, $username, $password, $dbname);
        if ($conn_notice->connect_error) {
            die("Connection failed: " . $conn_notice->connect_error);
        }

        // Delete the row if the delete button is clicked
        if (isset($_POST['delete_id_notice'])) {
            $delete_id_notice = $_POST['delete_id_notice'];

            // Delete the row from the "notice" table
            $sql_notice = "DELETE FROM notice WHERE id = $delete_id_notice";
            if ($conn_notice->query($sql_notice) === TRUE) {
                echo "Row deleted successfully.";
            } else {
                echo "Error deleting row: " . $conn_notice->error;
            }
        }

        // Fetch data from the "notice" table
        $sql_notice = "SELECT * FROM notice";
        $result_notice = $conn_notice->query($sql_notice);

        if ($result_notice->num_rows > 0) {
            while ($row_notice = $result_notice->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_notice['id'] . "</td>";
                echo "<td>" . $row_notice['title'] . "</td>";
                echo "<td>" . $row_notice['date'] . "</td>";
                echo "<td>" . $row_notice['pdf_filename'] . "</td>";
                echo "<td>";
                echo "<form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>";
                echo "<input type='hidden' name='delete_id_notice' value='" . $row_notice['id'] . "' />";
                echo "<input class='delete-btn' type='submit' value='Delete' />";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found.</td></tr>";
        }

        $conn_notice->close();
        ?>
    </table>
</div>
<div class="card">
    <h2>Event Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Event Title</th>
            <th>Event Banner</th>
            <th>Event Description</th>
            <th>Action</th>
        </tr>
        <?php
        $conn_event = new mysqli($servername, $username, $password, $dbname);
        if ($conn_event->connect_error) {
            die("Connection failed: " . $conn_event->connect_error);
        }

        // Delete the row if the delete button is clicked
        if (isset($_POST['delete_id_event'])) {
            $delete_id_event = $_POST['delete_id_event'];

            // Delete the row from the "event" table
            $sql_event = "DELETE FROM event WHERE id = $delete_id_event";
            if ($conn_event->query($sql_event) === TRUE) {
                echo "Row deleted successfully.";
            } else {
                echo "Error deleting row: " . $conn_event->error;
            }
        }

        // Fetch data from the "event" table
        $sql_event = "SELECT * FROM event";
        $result_event = $conn_event->query($sql_event);

        if ($result_event->num_rows > 0) {
            while ($row_event = $result_event->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_event['id'] . "</td>";
                echo "<td>" . $row_event['event_title'] . "</td>";
                echo "<td>" . $row_event['event_banner'] . "</td>";
                echo "<td>" . $row_event['event_description'] . "</td>";
                echo "<td>";
                echo "<form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>";
                echo "<input type='hidden' name='delete_id_event' value='" . $row_event['id'] . "' />";
                echo "<input class='delete-btn' type='submit' value='Delete' />";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found.</td></tr>";
        }

        $conn_event->close();
        ?>
    </table>
</div>
<script src="sidebar.js"></script>
</body>
</html>
