<html>
    <head>
           <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
   
            google.load('visualization', '1', {'packages':['corechart']});
      
            google.setOnLoadCallback(drawChart);
      
            function drawChart() {
                var jsonData = $.ajax({
                    url: "/Quizonsession/Answer_check.php",
                    dataType:"json",
                    async: false
                }).responseText;
                var data = new google.visualization.DataTable(jsonData);
                var options = {
                    title: 'Quiz Performance(Attendees wise)',
                    vAxis: {title: 'Score',  titleTextStyle: {color: 'red'}},
                    hAxis: {title: 'No.of Attendees',  titleTextStyle: {color: 'red'} },
                    bar: {groupWidth:25}

                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      
                chart.draw(data, options,{width:150,height:500});
      
            }
    
        </script>

        <script type="text/javascript">
   
            google.load('visualization', '1', {'packages':['corechart']});
      
            google.setOnLoadCallback(drawChart);
      
            function drawChart() {
                var jsonData = $.ajax({
                    url: "/Quizonsession/Answer_check1.php",
                    dataType:"json",
                    async: false
                }).responseText;
                var data = new google.visualization.DataTable(jsonData);
                var options = {
                    title: 'Quiz Performance(Question Wise)',
                    vAxis: {title: 'Score',  titleTextStyle: {color: 'red'}},
                    hAxis: {title: 'Question number',  titleTextStyle: {color: 'red'} },
                    bar: {groupWidth:25}

                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
      
                chart.draw(data, options,{width:50,height:200});
      
            }
    
        </script>
        <script type="text/javascript">
   
            google.load('visualization', '1', {'packages':['corechart']});
      
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var jsonData = $.ajax({
                    url: "Answer_check2.php",
                    dataType:"json",
                    async: false
                }).responseText;
          
//          
//           function drawChart() {
//        var data = google.visualization.arrayToDataTable([
//          ['Task', 'Hours per Day'],
//          ['Qustion 1',     11],
//          ['Qustion 2',     10],
//          ['Qustion 3',     16],
//          ['Qustion 4',     8],
//        ]);

                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable(jsonData);


                var options = {
                    title: 'Quiz Performance(Question Wise)'
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
                chart.draw(data, options,{width:50,height:300});
            }

    
        </script>
    </head>
    <body>

        <div id="chart_div"></div>
        <br>

        <div id="chart_div1"></div>
        <br>
        <div id="chart_div2"></div>

        <a href="thankyou.php">Back </a>

    </body>
</html>

