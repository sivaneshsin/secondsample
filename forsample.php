<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
       
        <link href="css/style.css" rel="stylesheet" media="all" type="text/css" />
        
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="jqgrid/js/jquery.ui.sortable.js" type="text/javascript"></script>
        <script src="jqgrid/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
        <script src="js/ui.datepicker.js" type="text/javascript"></script>
        <script type="text/javascript">
categories = ["sport", "science"];
var subcategories = ["football", "formel 1", "physics", "mathematics"];
var mydata = [
    {Name:"Lukas Podolski",     Category:0, Subcategory:0},
    {Name:"Michael Schumacher", Category:0, Subcategory:1},
    {Name:"Albert Einstein",    Category:1, Subcategory:2},
    {Name:"Blaise Pascal",      Category:1, Subcategory:3}
];
var subcategoriesOfCategory = [
    ["football", "formel 1"],
    ["physics", "mathematics"]
];

$(function(){  jQuery("#list").jqGrid({
    data: mydata,
    datatype: 'local',
    colModel: [
        { name: 'Name', width: 200 },
        { name: 'Category', width: 200, editable:true, formatter:'select',
          edittype:'select', editoptions: {
              value: categories,
              dataInit : function (elem) {
                  var v = $(elem).val();
                  grid.setColProp('Subcategory', {
                                  editoptions:{value:subcategoriesOfCategory[v]}});
              },
              dataEvents: [
                  { type: 'change',
                    data: { id: 7 },
                    fn: function(e) {
                        var v=$(e.target).val();
                        var sel = grid.getGridParam('selrow');
                        grid.setColProp('Subcategory', { editoptions:
                                              {value:subcategoriesOfCategory[v]}});
                        var res = '';
                        var sc = subcategoriesOfCategory[v];
                        for (var i=0; i<sc.length; i++) {
                            res += '<option role="option" value="' + i + '">' +
                                   sc[i] + '</option>';
                        }
                        $("select#"+sel+"_Subcategory").html(res);
                    }
                  }
              ]
          }
        },
        { name: 'Subcategory', width: 200, editable:true, formatter:'select',
          edittype:'select', editoptions: {value: subcategories} }
    ],
    onSelectRow: function(id) {
        if (id && id !== lastSel) {
            grid.restoreRow(lastSel);
            lastSel = id;
        }
    },
    ondblClickRow: function(id, ri, ci) {
        if (id && id !== lastSel) {
            grid.restoreRow(lastSel);
            lastSel = id;
        }
        grid.editRow(id, true);
        return;
    },
    editurl: 'clientArray',
    sortname: 'Name',
    viewrecords: true,
    rownumbers: true,
    sortorder: "desc",
    pager: '#pager',
    caption: "Inline Editing example"
}).navGrid('#pager', { edit: false, add: false, del: false,
                       search: false, view: false });
                

</script>
    </head>
    <body>

    <table id="list"><tr><td/></tr></table> 

        <div id="pager"></div>
        
    </body>
    
</html>
