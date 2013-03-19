
<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("location:Adminlogin.php");
}
?>

<?php require_once 'include/template/header.php'; ?>

<?php require_once 'include/template/menu.php'; ?>

<?php require_once 'Admin.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link href="css/style.css" rel="stylesheet" media="all" type="text/css" />
        <script src="jqgrid/js/jquery.ui.sortable.js" type="text/javascript"></script>
        <script src="jqgrid/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <script type="text/javascript">
            
              $("#quizmgmt").removeClass('current');
              
              $("#usermgmt").removeClass('current');
              
              $("#categorymgmt").addClass('current');
            $(function(){ 
                $("#add").jqGrid({
                    sortable:true,
                    url:'category.php',
                    datatype: 'xml',
                    mtype: 'GET',
                    colNames:['Id','Quiz Type','Category Name'],
                    colModel :[
                        {name:'id',index:'id', width:'100%',hidden:true,editable:false},
                  
                        {name:'type',index:'type',width:'100%',editable:true,edittype:"select",
                    
                            editoptions:{value:"select:Select;Technical:Technical;NonTechnical:NonTechnical"},editrules:{required:true}},
               
                        {name:'tname', index:'tname', width:'100%',editable:true,editrules:{required:true}}
            
                    ],
                    pager:'#page',
                    rowNum:10,
                    rowList:[10,20,30,40,50],
                    sortname: 'tname',
                    sortorder: "desc",
                    viewrecords:true,
                    gridview: true,
                    editable: true,                        
                    width :1220,
                    altRows:true,
                    altclass:'myAltRowClass',
                    height:'100%',
                    editurl:'categorybackend.php',
                    caption: 'Category Details',
                    subGrid:true,
                    subGridOptions: { "plusicon" : "ui-icon-triangle-1-e", 
                        "minusicon" : "ui-icon-triangle-1-s", 
                        "openicon" : "ui-icon-arrowreturn-1-e",
                        "selectOnExpand" : true,
                        "reloadOnExpand" : false
     
                    },
                    subGridRowExpanded: function(subgrid_id, row_id) 
                    { 
                     
                        var currentrow=$('#add').jqGrid('getRowData',row_id);
                        var col=currentrow.id;
                        var subgrid_table_id, pager_id;
                        subgrid_table_id = subgrid_id+"_t";
                        pager_id = "p_"+subgrid_table_id; 
                        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
                        jQuery("#"+subgrid_table_id).jqGrid({
                            url:"subcategory.php?pid="+col+"&id="+row_id,
                            datatype: "xml", 
                            mtype:'GET',  
                            colNames: ['SubCategory Name'],
                            colModel: [ 
                                {name:"subcategory_name",index:"subcategory_name",width:'100%',editable:true,editrules:{required:true}}], 
                            rowNum:20,
                            pager:pager_id,
                            sortname: 'num', 
                            sortorder: "asc",
                            height: '100%',
                            width:1185,
                            editurl:'subcategorybackend.php?pid='+col
                     
                        });
                        jQuery("#"+subgrid_table_id).jqGrid('navGrid','#'+pager_id,{edit:true,add:true,del:true,refresh:true},
                        { editCaption:"Edit SubCategory",
                            closeAfterEdit:true,
                            reloadAfterSubmit:true,
                            width:1185},
                        {addCaption:"Add SubCategory",
                            closeAfterAdd:true,
                            reloadAfterSubmit:true,width:1185},
                        {deleteCaption:"Delete SubCategory",closeAfterDelete:true,reloadAfterSubmit:true}, {multipleSearch:true}).trigger("reloadGrid");
                    }
                    
                    
                    
                });
  
                jQuery("#add").jqGrid('navGrid','#page',{edit:true,add:true,del:true,search:true},
                
                {
                    editCaption:"Edit Category",
                    closeAfterEdit:true,
                    modal:true,
                    reloadAfterSubmit:true,
                    width:1185
                },
                {addCaption:"Add Category",
                    closeAfterAdd:true,
                    modal:true,
                    reloadAfertSubmit:true,
                    width:1185
                },
                {deleteCaption:"Delete Category",
                    closeAfterDelete:true,
                    modal:true,
                    reloadAfterSubmit:true
                },
                {multipleSearch:true});
              
            }).trigger("reloadGrid");
            
            function categorysearch()
            {
                
             
                var key=jQuery("#byctype").val();
                
              
                
                var newurl="category.php?id="+key
                
              
              
                jQuery("#add").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#add").trigger("reloadGrid");
                
               
                
            }      
            function cquicksearch()
            {
                
                var key=jQuery("#qsearch").val();
                
              
                
                var newurl="category.php?search="+key
            
              
                jQuery("#add").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#add").trigger("reloadGrid");
                
                
            }
        </script>
    </head>
    <body>
        <div id="tsearch" >

            Search By Type <select id="byctype" onchange="categorysearch()"> 

                <option value="">All</option>

                <option value="Technical">Technical </option> 

                <option value="NonTechnical"> NonTechnical </option> 

            </select>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <input type="text" width="150" placeholder="Quick Search" name="search" id="qsearch" onchange="cquicksearch()"/> 

        </div> 
        <table id="add"><tr><td/></tr></table> 
        <div id="page"></div>
    </body>
</html>
