<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
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
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'alumni';

    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    $email = isset($_SESSION['email'])? $_SESSION['email'] : null;
    
    $stmt = $pdo->prepare("SELECT `student_id` FROM `students` WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $sid = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = isset($sid) ? $sid['student_id'] : null ;
    
    $stmt = $pdo->prepare("SELECT `candidate_id` FROM `vote_counts` WHERE student_id = :sid");
    $stmt->bindParam(':sid', $userId);
    $stmt->execute();
    
    $candidateIds = [];
    while ($voteFor = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $candidateIds[] = $voteFor['candidate_id'];
    }
    
    if (!empty($candidateIds)) {
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
            if (in_array($row['student_id'], $candidateIds)) {
                $htmlContent .= '<p class="title-sec text-center mt-3"><strong>Already Voted</strong></p>';
            } else {
                $htmlContent .= '<button type="button" class="btn btn-secondary btn-block mt-3 vote-button" data-student-id="' . $row['student_id'] . '">Vote</button>';
            }
            $htmlContent .= '</div>';
        }
    }
    $pdo = null;
?>
<?php 
session_start();
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
        $pdo = new PDO("mysql:host=localhost;dbname=alumni", "root", "");
        $stmt = $pdo->prepare("INSERT INTO vote_counts (student_id, candidate_id, vote) VALUES (:userId, :sid, 1)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':sid', $sid);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo "Vote recorded successfully!";
        } else {
            echo "Error recording vote.";
        }
    }else{
        echo "error";
    }
}
?>

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
<script src="js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
    $('.vote-button').on('click', function() {
        var studentId = $(this).data('student-id');
        $.ajax({
            type: 'POST',
            url: 'vote.php',
            data: { student_id: studentId },
            success: function(response) {
                console.log('response');
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
