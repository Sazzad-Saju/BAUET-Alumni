<!DOCTYPE html>
<html>
<head>
    <title>Vote for Clubs</title>
    <link rel="stylesheet" href="hf.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        .card-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .view-details {
            margin-top: 10px;
            text-align: right;
        }
        .view-details a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        /* Full screen image modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: hidden;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .modal-image {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

 </style>
</head>
<body>
<?php
include 'nav.php';
?>
<div class="container py-3 text-center">
        <h2>Vote For Clubs</h2>
</div>
<?php
    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'alumni';
    
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    // Fetching candidate data from the database
    // $sql = "SELECT * FROM `vote-candidates`";
    // $result = mysqli_query($connection, $sql);
    
    $stmt = $pdo->query("SELECT * FROM `vote_candidates`");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $htmlContent = '';
    foreach ($rows as $row) {
        $htmlContent .= '
        <div class="col-md-3">
                <img src="uploads/voting/' . $row['image'] . '" class="img-fluid" alt="">
                <p class="fullname">' . $row['name'] . '</p>
                <small class="title-sec" style="color: grey">' . $row['post'] . '</small><br>
                <small class="title-sec" style="color: grey">' . $row['club'] . '</small>
                <div class="social-links">
                    <small><i class="fa fa-facebook-f"></i></small>
                    <small><i class="fa fa-twitter"></i></small>
                    <small><i class="fa fa-linkedin"></i></small>
                </div>
                <small class="description">
                    Vote wisely! One vote per candidate, no changes allowed. Your participation is crucial in this varsity club election. Make your mark and shape our future together.
                </small>
                <button type="button" class="btn btn-secondary btn-block mt-3">Vote</button>
                <p class="title-sec text-center"><strong>Already Voted</strong></p>
            </div>
        ';
    }
    
    
    
    // Close the database connection
    $pdo = null;
?>

<!-- Voting Options -->
<div class="container teamSection" id="team">
        <div class="row">
        <?php echo $htmlContent; ?>
        </div>
    </div>

  
</div>

<script>
</script>

<?php
include 'footter.php';
?>
</body>
</html>
