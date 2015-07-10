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

</span>
<div id="form_container" style="width:250px;height:300px; padding-top: 100px;"></div>
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
        resObj = document.getElementById("res");
        var loginForm = new dhtmlXForm("form_container");
        loginForm = layout.cells("a").attachForm();
        loginForm.loadStruct("../data/loginForm.xml");
        loginForm.attachEvent("onButtonClick", function(buttonId){
            if(buttonId == "signIn") {
                login();
            }
        });

        function login(){
            loginForm.send("login.php", "post", function(response){
                if (response.xmlDoc.responseText) {
                    resObj.innerHTML = "Login successful";
                    resObj.style.color = "green";
                } else {
                    resObj.innerHTML = "Login failed";
                    resObj.style.color = "red";
                }
            });
        }
    });
</script>
</body>
</html>
