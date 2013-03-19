<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("location:Adminlogin.php");
}
?>

<?php require_once 'include/template/header.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

        <link href="css/style.css" rel="stylesheet" media="all" type="text/css" />

        <script src="js/jquery.js" type="text/javascript"></script>

        <script src="jqgrid/js/jquery.ui.sortable.js" type="text/javascript"></script>

        <script src="js/ui.datepicker.js" type="text/javascript"></script>

        <script type="text/javascript">
            
             
                   
            $(function(){ 
                
                $("#list").jqGrid({
                    sortable:true,
                    url:'conductquizdetails.php',
                    datatype: 'xml',
                    mtype: 'POST',
                    colNames:['Id','Quiz Date','Quiz Number','Quiz Name','Quiz Type','Quiz Category','Quiz SubCategory','Quiz Topic','Trainer Name','No.of Questions','Action'],
                    colModel :[  
                        {name:'id', index:'id', width:'100%',hidden:true,editable:false,editrules:{required:true}},
                        {name:'quiz_date', index:'quiz_date', width:'100%',editable:true,editoptions:{size:50,dataInit:function(el)
                                {
                             
                                    $(el).datepicker({dateFormat:'yy-mm-dd'});
                             
                                }},editrules:{date:true},editrules:{required:true}},
                        {name:'quiz_number', index:'quiz_number', width:'100%',editable:false,editrules:{required:true}}, 
                        {name:'quiz_name', index:'quiz_name', width:'100%',editable:true,editoptions:{size:50},editrules:{required:true}},
                        {name:'quiz_type', id:'quiz_type',index:'quiz_type', width:'100%',editable:true,edittype:"select",editoptions:{value:"select:Select;Technical:Technical;Nontechnical:NonTechnical",
                                dataEvents :[
                                    {
                           
                                        type : 'change' , fn:function(e)
                                        {
                                            var thisval=$(e.target).val();
                               
                                            $.get('c.php?id='+thisval,function(data)
                                            {
                                                var res= $(data).html();
                                                $("#technology_id").html(res);
                                            });
                                        }
                                    }  
                                ] 
                            },editrules:{required:true}  
                        },
                        {name:'technology_id', index:'technlogy_id', width:'100%',editable:true,edittype:"select",
                            editoptions:{dataUrl:'c.php',
                                dataEvents :[
                                    {
                           
                                        type : 'change' , fn:function(e)
                                        {
                                            var thisval=$(e.target).val();
                               
                                            $.get('sub.php?id='+thisval,function(data)
                                            {
                                                var res= $(data).html();
                                                $("#subcategory_name").html(res);
                                            });
                                        }
                                    }  
                                ] 
                            },editrules:{required:true}  
                        },
                        {name:'subcategory_name', index:'subcategory_name', width:'100%',editable:true,edittype:"select",editoptions:{dataUrl:'sub.php'},editrules:{required:true}},
                        {name:'quiz_topic', index:'quiz_topic', width:'100%',editable:true,editoptions:{size:50},editrules:{required:true}},
                        {name:'trainername', index:'trainername', width:'100%',editable:true,editoptions:{size:50},editrules:{required:true}},
                        {name:'noofquestions',index:'noofquestions',width:'100%',editable:false},
                        {name:'startquiz',align:'center',index:'startquiz',width:'100%',formatter:'showlink',formatoptions:{baseLinkUrl:'conductquiz.php'}}
                        
  
                    ],  
                 
                    pager:jQuery('#pager'),
                    rowNum:10,
                    rowList:[10,20,30,40,50],
                    sortname: 'quiz_topic',
                    sortorder: 'desc',
                    viewrecords:true,
                    gridview: true,
                    editable: true,
                    altRows:true,
                    altclass:'myAltRowClass',
                    toolbar: [true,"top"],
                    width :1185,
                    height:'100%',
                    editurl:'quizcreationbackend.php',
                    caption: 'Quiz Details',
                    subGrid:true,
                    subGridOptions: { "plusicon" : "ui-icon-triangle-1-e", 
                        "minusicon" : "ui-icon-triangle-1-s", 
                        "openicon" : "ui-icon-arrowreturn-1-e",
                        "selectOnExpand" : true,
                        "reloadOnExpand" : true
     
                    },
                    
                    subGridRowExpanded: function(subgrid_id,row_id) 
                    { 
                        var subgrid_table_id, pager_id;
                        subgrid_table_id = subgrid_id +"_t";
                        pager_id = "p_"+subgrid_table_id; 
                        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
                        jQuery("#"+subgrid_table_id).jqGrid({
                            url:"questions.php?id="+row_id,
                            datatype: "xml", 
                            recreateForm:true,
                            colNames: ['Question','Option1','Option2','Option3','Option4','CorrectAnswer'],
                            colModel: [ 
                                {name:"question",index:"question",width:'100%',editable:true,editoptions:{size:100},editrules:{required:true}},
                                {name:"option1",index:"option1",width:'100%',editable:true,editoptions:{size:100},editrules:{required:true}},
                                {name:"option2",index:"option2",width:'100%',editable:true,editoptions:{size:100},editrules:{required:true}}, 
                                {name:"option3",index:"option3",width:'100%',editable:true,editoptions:{size:100},editrules:{required:true}},
                                {name:"option4",index:"option4",width:'100%',editable:true,editoptions:{size:100},editrules:{required:true}}, 
                                {name:"correctanswer",index:"correctanswer",width:'100%',editable:true,edittype:'select',editoptions:{value:"select:Select;option1:Option 1; option2:Option 2;option3:Option 3;option4:Option 4"}
                                            
                                },
                      
                            ], 
                            rowNum:20, pager: pager_id, sortname: 'Question',sortorder: "asc", height: '100%',
                            editurl:'questionsbackend.php?qid='+row_id,
                            width:1185
                      
                        });
                      
                        jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:true,add:true,del:true,refresh:true},
                        {editCaption:"Edit Question",modal:true,closeAfterEdit:true,reloadAfterSubmit:true,width:1000},
                        {addCaption:"Add Question",closeAfterAdd:true,modal:true,reloadAfterSubmit:true,width:1000},
                        {deleteCaption:"Delete Question",closeAfterDelete:true,modal:true,reloadAfterSubmit:true}, {multipleSearch:true}).trigger("reloadGrid");
                    
                    }   

                });
  
                jQuery("#list").jqGrid('navGrid','#pager',{edit:true,add:true,del:true,search:true},
                {editCaption:"Edit Quiz",closeAfterEdit:true,modal:true,reloadAfterSubmit:true,width:1000,beforeShowForm:function(formid){
                    
                        thisval=document.getElementById('quiz_type').value;
                        test(thisval);  
                    },afterSubmit:function(response)
                    {
                        location.href='/Quizonsession/conductquizdetailsgrid.php';
                  
                    },onClose:function(){
                        location.href='/Quizonsession/conductquizdetailsgrid.php';
                    }},
                {addCaption:"Add Quiz",closeAfterAdd:true,modal:true,reloadAfterSumbit:true,width:1000},
                {deleteCaption:"Delete Quiz",closeAfterDelete:true,modal:true,reloadAfterSubmit:true}, {multipleSearch:true}).trigger("reloadGrid");
             
            });
         
            function dosearch()
            {
                
             
                var key=jQuery("#bytype").val();
                
              
                
                var newurl="conductquizdetails.php?id="+key
                
              
              
                jQuery("#list").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#list").trigger("reloadGrid");
                
               
                
            }           
            
            function quicksearch()
            {
                
                var key=jQuery("#qsearch").val();
                
              
                
                var newurl="conductquizdetails.php?search="+key
            
              
                jQuery("#list").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#list").trigger("reloadGrid");
                
                
            }
            function test(thisval)
            {
                thisval=thisval;
     
                $.get('c.php?id='+thisval,function(data)
                {
                                   
                    var res= $(data).html();
                  
                    $("#technology_id").html(res);
                  
                });
              
            }
            
            function dostatus()
            {
                
                var key=jQuery("#bystatus").val();
                
                var c=jQuery("#bytype").val();
                
                
                var newurl="conductquizdetails.php?id="+ c +"&status="+key
                
              
              
                jQuery("#list").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#list").trigger("reloadGrid");
                
            }
        </script>
    </head>
    <body>
        <br> 
            <div id="trsearch" >

                Search By Type <select id="bytype" onchange="dostatus()"> 

                    <option value="3"> All </option> 

                    <option value="Technical">Technical </option> 

                    <option value="Nontechnical"> NonTechnical </option> 



                </select>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Search By Status <select id="bystatus" onchange="dostatus()"> <option value="2">All</option><option value=1>Active </option> <option value=0> InActive </option>  </select>  

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <input type="text" width="200" placeholder="Quick Search" name="search" id="qsearch" onchange="quicksearch()"/> 



            </div> 
            <div id="sessionname">

                <b> <?php echo "welcome :" . " " . $_SESSION['name']; ?>

                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;

                    <a href="trainerlogout.php"> Logout </a>

            </div>
            <br> <br> <br>
                        <table id="list"><tr><td/></tr></table> 

                        <div id="pager"></div>

                        </body>

                        </html>

