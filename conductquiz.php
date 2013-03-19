<?php

session_start();
ini_set('display_errors', 1);
if (!isset($_SESSION['name'])) {
    header("location:trainerlogin.php");
}
if ($_GET['id']) {
    $_SESSION['quiz_id_users'] = $_GET['id'];
}
?>
<?php

$url = $_SERVER['REQUEST_URI'];
//header("Refresh: 5; URL=$url");
?>

<?php require_once 'include/template/header.php'; ?>

<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();


if (!isset($_GET['flag']))
    $flag = 1;
else
    $flag = $_GET['flag'];
$j = 1;

$db->db_connection($config);

//$query= "SELECT distinct u.name FROM quizdetails q JOIN users u ON q.id='$_GET[id]' WHERE u.quiznumber=q.quiz_number";
//
//$db->db_query($SQL);

$SQL = "UPDATE questiondetails SET is_active=0";

$db->db_query($SQL);

$query = "SELECT * from questiondetails WHERE quiz_id='$_GET[id]'";

$result = $db->db_query($query);

$count = mysql_num_rows($result);

$query = "SELECT * from quizdetails where id='$_GET[id]'";

$quizresult = $db->db_query($query);

$quiznumber = mysql_fetch_row($quizresult);

echo "<h1> Question Number: $flag </h1> ";

echo "<div id='quiz_number'>";
echo "<h1> Quiz Number: $quiznumber[3] </h1>";

echo "<div id='right'> <Iframe src='Text.php' width='250' height='400';> 
</Iframe>";
echo "</div>";
echo "</div>";

$query = "SELECT * from questiondetails WHERE quiz_id='$_GET[id]'";

$result = $db->db_query($query);

$count = mysql_num_rows($result);

while ($row = mysql_fetch_array($result)) {
    $_SESSION['question_id_users'] = $row['id'];
    if ($j == $flag) {
        echo "<div id='cont_question'";
        echo "<center> <h1> $row[question]</h1> ";
        echo "</center>";

        echo "<center><h3> A) $row[option1] </h3> ";

        echo "<h3> B) $row[option2] </h3> ";

        echo "<h3> C) $row[option3] </h3> ";

        echo "<h3> D) $row[option4] </h3>  </center>";

        $query = "UPDATE questiondetails SET is_active=1 WHERE id='$row[id]'";

        $db->db_query($query);


        echo "<center>";

        echo "<a href='conductquiz.php?flag=" . ($flag + 1) . "&id=" . $_GET['id'] . "'> <img src='images/next.jpg' width=100 height=100 id='next' alt='NEXT'/> </a>";

        // echo "<a href='#' id='result'> <img src='images/graph.jpeg' alt= Graph width=100 height=100 id='next'/> </a>";
        echo "</center>";

        echo "</div>";
        exit;
    }

    $j++;

    if ($j > $count) {

        header("Location:thankyou.php?id=" . $_GET['id']);
    }
}
?>
