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
    session_start();
    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'alumni';
    
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    $email = isset($_SESSION['email'])? $_SESSION['email'] : null;
    
    // check user vote for which candidates
    $stmt = $pdo->prepare("SELECT `student_id` FROM `students` WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Fetch the result
    $sid = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = isset($sid) ? $sid['student_id'] : null ;
    $_SESSION['user_id'] = $userId;
    
    $stmt = $pdo->prepare("SELECT `candidate_id` FROM `vote_counts` WHERE student_id = :sid");
    $stmt->bindParam(':sid', $userId);
    $stmt->execute();
    
    $candidateIds = [];
    while ($voteFor = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $candidateIds[] = $voteFor['candidate_id'];
    }
    
    if (!empty($candidateIds)) {    
        // Fetching candidate data from the database
        
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
                </small>';
        
            // Check if the student_id exists in $candidateIds
            if (in_array($row['student_id'], $candidateIds)) {
                $htmlContent .= '<p class="title-sec text-center mt-3"><strong>Already Voted</strong></p>';
            } else {
                $htmlContent .= '<button type="button" class="btn btn-secondary btn-block mt-3 vote-button" data-student-id="' . $row['student_id'] . '">Vote</button>';
            }
        
            // Close the <div>
            $htmlContent .= '</div>';
        }
    }
    // Close the database connection
    $pdo = null;
?>

<?php 
// session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'alumni';

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
// after button click
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sid = isset($_POST['student_id']) ? $_POST['student_id'] : null;
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    if ($sid !== null && $userId !== null) {
        $stmt = $pdo->prepare("INSERT INTO vote_counts (student_id, candidate_id, vote) VALUES (:userId, :sid, 1)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':sid', $sid);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo "Vote recorded successfully!";
            exit;
        } else {
            echo "Error recording vote.";
            exit;
        }
    }else{
        echo "error";
        exit;
    }
}
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
<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
    $('.vote-button').on('click', function() {
        var button = $(this);
        var studentId = $(this).data('student-id');

        // Send a POST request
        $.ajax({
            type: 'POST',
            url: 'vote.php',
            data: { student_id: studentId },
            success: function(response) {
                console.log(response);
                button.replaceWith('<p class="title-sec text-center mt-3"><strong>Already Voted</strong></p>');
            },
            error: function(error) {
                console.log('error');
            }
        });
    });
});
</script>
</body>
</html>
