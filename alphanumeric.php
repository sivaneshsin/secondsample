<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
        <script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
        
        <script type="text/javascript">
            
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"date",
			dateFormat:"%Y-%m-%d",
                        isStripped:true
                       
			
		});
	};
     
    </script>
   
    </head>
    <body>
        
        <form method="post" action="alpha.php">
            
            <input type="text" name="date" id="date">
            
            <select name="type">
                
                <option value=""> Select </option> 
                <option value="Technical"> Technical </option>
                
                <option value="Nontechnical"> NonTechnical </option>
                
            </select>
            
            <input type="submit" value="Ok">
            
        </form>
    </body>
</html>
