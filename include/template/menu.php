<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Demo</title>
        <link href="css/webwidget_menu_glide.css" rel="stylesheet" type="text/css"></link>
        
<!--        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
        
        <script type="text/javascript" src="js/webwidget_menu_glide.js"></script>
    </head>

    <body>
        
        <br></br>
        
        <table width="600">

            <tr>

                <script language="javascript" type="text/javascript">
                    $(function() {
                        $("#webwidget_menu_glide3").webwidget_menu_glide({menu_width:"220", menu_height:"30", menu_text_size:"18", menu_text_color:"brown", menu_sprite_color:"#86C7EF", menu_background_color:"bisque", menu_margin:"0", sprite_speed:"normal", container:"webwidget_menu_glide3" });
                    });
                </script>
                <div id="webwidget_menu_glide3" class="webwidget_menu_glide">
                    <div class="webwidget_menu_glide_sprite"></div>
                    <ul>
                        <li id="quizmgmt"><a href="quizdetailsgrid.php" >Quiz Management</a></li>

                        <li id="categorymgmt"><a href="addcategory.php" id="trainermgmt">Category Management</a></li>

                        <li id="usermgmt"><a href="trainergrid.php">User Management</a></li>
                    </ul>

                    <div style="clear: both"></div>

                </div></td>
            </tr>
        </table>
        <br>


