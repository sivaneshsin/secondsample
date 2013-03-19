<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script type="text/javascript">

      google.load('visualization', '1', {'packages':['corechart']});
      
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var jsonData = $.ajax({
                    url: "chart_div_atten.php",
                    dataType:"json",
                    async: false
                }).responseText;
                
                         
          
//           function drawChart() {
//        var data = google.visualization.arrayToDataTable([
//          ['Task', 'Hours per Day'],
//          ['Qustion 1',     11],
//          ['Qustion 2',     10],
//          ['Qustion 3',     16],
//          ['Qustion 4',     8],
//        ]);
                
                
var data = new google.visualization.DataTable(jsonData);
            var options = {
                title: 'Pie Chart For attendance',
                legend: 'bottom',
                width: 120,
                height: 150
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div_atten'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">

      google.load('visualization', '1', {'packages':['corechart']});
      
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var jsonData = $.ajax({
                    url: "chart_div_error.php",
                    dataType:"json",
                    async: false
                }).responseText;
var data = new google.visualization.DataTable(jsonData);
            var options = {
                title: 'Pie Chart For attendance',
                legend: 'bottom',
                width: 120,
                height: 150
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div_error'));
            chart.draw(data, options);
        }
    </script>
      <?php
    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['name'])) {
        header("location:Adminlogin.php");
    }
    ?>
    <?php
    
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh:3; URL=$url");
    ?>

    <?php
    $id = $_GET['id'];
    $name = $_SESSION['name'];
    require_once 'include/config.php';

    require_once 'Database.php';

    $db = new Database();

    $db->db_connection($config);
//    echo '<center>';

    echo "<div style='display:block'>
        <div id='chart_div_atten' style='width: 100px; height: 120px; float:left; '>
</div> ";
    echo "
        <div id='chart_div_error' style='width: 100px; height: 120px; float:left; '>
</div> </div> ";
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';

    $query = "Select distinct name from users where quiz_id_fk = '$_SESSION[quiz_id_users]'";

    $result = $db->db_query($query);
    echo "<div id='frame_table'>";

    echo "<table id='table_back' border=1 width=220> <th> Users </th><th>Status </th>";

    while ($row = mysql_fetch_array($result)) {

        echo "<tr><td> $row[name] </td>";
        $query_1 = "Select count(r.name) as count from result r WHERE r.id='$_SESSION[question_id_users]' AND r.name = '$row[name]' AND r.quiz_id ='$_SESSION[quiz_id_users]' ";
          
        $result_1 = $db->db_query($query_1);


        while ($row_1 = mysql_fetch_row($result_1)) {
           
            if ($row_1[0] > 0) {
                echo "<td><img src='images/green.jpg' height=50 id='red'/></td></tr>";
            } else {
                echo "<td><img src='images/red.jpg' height=50 id='red'/></td></tr>";
            }
        }
    }
    echo "</table>";
    echo "</div>";