


<?php require_once 'include/template/header.php'; ?>

<?php require_once 'include/template/menu.php'; ?>

<?php require_once 'Admin.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
<link href="css/style.css" rel="stylesheet" media="all" type="text/css" />
    <script src="jqgrid/js/jquery.ui.sortable.js" type="text/javascript"></script>
        <script src="jqgrid/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
        <script type="text/javascript">
              
              $("#quizmgmt").removeClass('current');
              
              $("#usermgmt").addClass('current');
              
              $("#categorymgmt").removeClass('current');
             
            $(function(){ 
                $("#trainer").jqGrid({
                    sortable:true,
                    url:'trainerdetails.php',
                    datatype: 'xml',
                    mtype: 'GET',
                    colNames:['TrainerName','Email-Id'],
                    colModel :[      
                        {name:'username', index:'trainername', width:100,editable:true}, 
                        {name:'email', index:'email', width:100,editable:true},
                    ],
                    pager:jQuery('#tpager'),
                    rowNum:10,
                    rowList:[10,20,30,40,50],
                    altRows:true,
                    altclass:'myAltRowClass',
                    sortname: 'username',
                    sortorder: 'desc',
                    viewrecords: true,
                    gridview: true,
                    editable: true,
                    toolbar: [true,"top"],                            
                    multikey: "ctrlKey",
                    width :1180,
                    height:'100%',
                    
                    height:'100%',
                    caption: 'Trainer Details'
                });
  
                jQuery("#trainer").jqGrid('navGrid','#tpager',{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});

            });
             function quicksearch()
            {
               
                
                var se=jQuery("#qsearch").val();
                

                var newurl="trainerdetails.php?sear="+se
           
                jQuery("#trainer").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#trainer").trigger("reloadGrid");
                
                
            }
        </script>
    </head>
    <body>       
        <div id="search">
             <input type="text" placeholder="Quick Search" name="search" id="qsearch" onchange="quicksearch()"/> 
        </div>
        
            <table id="trainer"><tr><td/></tr></table>       
            <div id="tpager"></div>
    </body>
</html>

