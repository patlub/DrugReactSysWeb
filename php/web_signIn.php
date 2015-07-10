<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="../codebase/dhtmlx.js"></script>
    <link href="../codebase/dhtmlx.css" rel="STYLESHEET" type="text/css"/>
    <style>
html, body{
    width: 100%;
    height: 100%;
    overflow: hidden;
    margin: 0px;
        }

    </style>
</head>
<body>
<span id="fastclick">
<script type="text/javascript">
    dhtmlxEvent(window, "load", function(){
       var layout = new dhtmlXLayoutObject({
           parent:  document.body,
           pattern: "1C",

           offsets:{
               top:     100,
               right:   500,
               bottom:  100,
               left:    500
           },
           cells: [
               {
                   id:             "a",        // id of the cell you want to configure
                   text:           "Drug Reaction Login",     // header text
                   collapsed_text: "Text 2",   // header text for a collapsed cell
                   header:         true,      // hide header on init
                   width:          100,        // cell init width
                   height:         100,        // cell init height
                   fix_size:       [true,null] // fix cell's size, [width,height]
               }
           ]
       });
//        var layout = new dhtmlXLayoutObject(document.body, "1C");
        var loginForm = layout.cells("a").attachForm();
        loginForm.loadStruct("../data/loginForm.xml");

    });

</script>
</span>
</body>
</html>


