<?php

session_start();

if(!isset($_SESSION['name']))
{
    header("location:Adminlogin.php");
}

?>

<?php require_once 'include/template/header.php'; ?>

<?php require_once 'include/template/menu.php'; ?>

<?php require_once 'Admin.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
       <!--  <link href="css/style.css" rel="stylesheet" media="all" type="text/css" />
          <link href="css/jquery.ui.all.css" rel="stylesheet" media="all" type="text/css" />
         <script src="js/jquery.js" type="text/javascript"></script>
         <script src="js/jquery.ui.js" type="text/javascript"></script>
         <script src="jqgrid/js/jquery.ui.sortable.js" type="text/javascript"></script> -->
        <!--  <script src="jqgrid/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script> -->
         <script src="js/ui.datepicker.js" type="text/javascript"></script> 
         <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
        <script type="text/javascript">
            
             $("#quizmgmt").addClass('current');
              
              $("#usermgmt").removeClass('current');
              
              $("#categorymgmt").removeClass('current');
                          
         $(function(){ 
            
                $("#list").jqGrid({
                    
                    sortable:true,
                    url:'quizdetails.php',
                    datatype: 'xml',
                    mtype: 'GET',
                  
                    colNames:['Id','Quiz Date','Quiz Number','Quiz Name','Quiz Type','Quiz Category','Quiz SubCategory','Quiz Topic','Trainer Name','No.of Questions','Action'],
                    colModel :[  
                        {name:'id', index:'id', width:'100%',hidden:true,editable:false,editrules:{required:true}},
                        {name:'quiz_date', id:'qdate',index:'quiz_date',sortable:true, width:'100%',align:'center',editable:true,editoptions:{size:70,dataInit:function(el)
                            {
                             
                             $(el).datepicker({dateFormat:'yy-mm-dd'},{yearRange: "2012:2020"});
                             
                            }},editrules:{date:true},editrules:{required:true}},
                        {name:'quiz_number', index:'quiz_number',align:'center', width:'100%',editable:false,editrules:{required:true}}, 
                        {name:'quiz_name', index:'quiz_name', align:'center', width:'100%',editable:true,editoptions:{size:70},editrules:{required:true}},
                       {name:'quiz_type', id:'quiz_type',index:'quiz_type',align:'center', width:'100%',editable:true,edittype:"select",editoptions:{value:"select:Select;Technical:Technical;Nontechnical:NonTechnical",
                                dataEvents :[
                          {
                           
                            type:'change', fn:function(e)
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
                        {name:'technology_id', id:'technology_id',index:'technlogy_id',align:'center', width:'100%',editable:true,edittype:"select",
                        editoptions:{dataUrl:'c.php',
                        
           
                        dataEvents :[
                          {
                           
                           type:'change',fn:function(e)
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
                        {name:'subcategory_name', index:'subcategory_name', align:'center',width:'100%',editable:true,edittype:"select",editoptions:{dataUrl:'sub.php'},editrules:{required:true}},
                        {name:'quiz_topic', index:'quiz_topic',align:'center', width:'100%',editable:true,editoptions:{size:70},editrules:{required:true}},
                        {name:'trainername',align:'center', index:'trainername', width:'100%',editable:true,editoptions:{size:70},editrules:{required:true}},
                        {name:'noofquestions',align:'center',index:'noofquestions',width:'100%'},
                        {name:'copyquiz',align:'center',index:'copyquiz',width:'100%'
                        }
        
                    ],  
                    onCellSelect:function(rowid,iCol,cellcontent,e){
                                      
                                   $.ajax({
                               
                                 url:'Copy.php?id='+rowid
   
                               });   
                                   if(iCol==11){
                                   $("#modelwindow").slideDown();
                                   $("#copy_id").val(rowid);
                                   
                               }
                    },
                    pager:'#pager',
                    rowNum:10,
                    rowList:[10,20,30,40,50],
                    sortname: 'quiz_name',
                    sortorder: "desc",
                    altRows:true,
                    altclass:'myAltRowClass',
                    viewrecords:true,
                    gridview: true,
                    editable: true,
                    toolbar: [true,"top"],
                    width :1220,
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
                      colNames: ['Question','Option 1','Option 2','Option 3','Option 4','Correct Answer'],
                      colModel: [ 
                      {name:"question",index:"question",width:'100%',editable:true,editoptions:{size:120},editrules:{required:true}},
                      {name:"option1",index:"option1",width:'100%',editable:true,editoptions:{size:120},editrules:{required:true}},
                      {name:"option2",index:"option2",width:'100%',editable:true,editoptions:{size:120},editrules:{required:true}}, 
                      {name:"option3",index:"option3",width:'100%',editable:true,editoptions:{size:120},editrules:{required:true}},
                      {name:"option4",index:"option4",width:'100%',editable:true,editoptions:{size:120},editrules:{required:true}}, 
                      {name:"correctanswer",index:"correctanswer",width:'100%',editable:true,edittype:'select',editoptions:{value:"select:Select;option1:Option 1; option2:Option 2;option3:Option 3;option4:Option 4"}
                      
                      }], 
                      rowNum:5, pager: "#"+pager_id,rowList:[5,10,15,20,25],viewrecords:true,width:1185,sortname: 'question', sortorder: "desc", height: '100%',
                      editurl:'questionsbackend.php?qid='+row_id,
                      width:1185
                      
                         });
                      
                      jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:true,add:true,del:true},

                      {editCaption:"Edit Question",modal:true,closeAfterEdit:true,recreateForm:true,reloadAfterSubmit:true,width:1185},
                      {addCaption:"Add Question",closeAfterAdd:true,modal:true,recreateForm:true,reloadAfterSubmit:true,width:1185},
                      {deleteCaption:"Delete Question",closeAfterDelete:true,modal:true,reloadAfterSubmit:true}, {multipleSearch:true}).trigger("reloadGrid");
               
                         jQuery("#msl").click( function(){
                    
                         var s=new Array();
       
                         s= jQuery("#"+subgrid_table_id).jqGrid('getGridParam','selarrrow');
                        
                        window.location="conductquiz?id="+s;
   
                   });
 
                   }   
                      
                });
  
                jQuery("#list").jqGrid('navGrid','#pager',{edit:true,add:true,del:true,search:true},
                {editCaption:"Edit Quiz",closeAfterEdit:true,modal:true,reloadAfterSubmit:true,width:1185,beforeShowForm:function(formid){
                    
                    thisval=document.getElementById('quiz_type').value;
                    test(thisval);  
                },afterSubmit:function(response)
                {
                   location.href='/Quizonsession/quizdetailsgrid.php';
                  
                },onClose:function(){
                    location.href='/Quizonsession/quizdetailsgrid.php';
                }
                },
                {addCaption:"Add Quiz",modal:true,closeAfterAdd:true,reloadAfterSumbit:true,width:1185},
                {deleteCaption:"Delete Quiz",modal:true,closeAfterDelete:true,reloadAfterSubmit:true}, {multipleSearch:true}).trigger("reloadGrid");
               
            });
      
           function dosearch()
            {
                
             
                var key=jQuery("#bytype").val();
                
                var c=jQuery("#bystatus").val();
                
                var newurl="quizdetails.php?status="+c+"&id="+key
                
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
            
        
            function qquicksearch()
             
            {
             
                 var key=jQuery("#qsearch").val();
                
            
                 var newurl="quizdetails.php?qsearch="+key
            
              
                jQuery("#list").jqGrid("setGridParam",{url:newurl});
                
               
                jQuery("#list").trigger("reloadGrid");
                
                
            }
            
            function dostatus()
            {
                
                var key=jQuery("#bystatus").val();
                
                var c=jQuery("#bytype").val();
                    
                var newurl="quizdetails.php?id="+c + "&status="+key
                
                jQuery("#list").jqGrid("setGridParam",{url:newurl});
                
                jQuery("#list").trigger("reloadGrid");
                
            }
            
             
        </script>
        
    </head>
    <body>
        <div id="modelwindow"> 
             
             <form action="copy.php" method="post">

            <table bgcolor="skyblue" width="300" height="100">
                <input type="hidden" id="copy_id" name="copy_id"></input>
                <tr> <td> Quiz date</td><td> <input type="text" name="date" id="datepicker"> </td> </tr>
                
                <tr> <td> </td><td> <input type="submit" value="Submit"> </td>  </tr>
            </table>    
        </form>
                   </div>
            
        <div id="tsearch" >
            
            Search By Type <select id="bytype" onchange="dosearch()"> 
            
             <option > All </option> 
       
            <option value="Technical">Technical </option> 
            
            <option value="Nontechnical"> NonTechnical </option> 
           
            </select>
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            Search By Status <select id="bystatus" onchange="dostatus()"> 
                
                <option value=2>All</option>
                
                <option value="1">Active </option> 
                
                <option value="0"> InActive </option> 
           
            </select>
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
             <input type="text" placeholder="Quick Search" name="qsearch" id="qsearch" onchange="qquicksearch()" />
            
        </div> 

        <table id="list"><tr><td/></tr></table> 

        <div id="pager"></div>
        
    </body>
    
</html>
