<%-- 
    Document   : Login
    Created on : Mar 9, 2015, 2:13:38 AM
    Author     : Yeah
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
        <header>
            <div id="head">
                <h1>Welcome to Yoshi's Review Page</h1>
            </div>
        </header>
        <div id="wrapper">
          
          <a style="float:left;" href="SignIn.jsp"><h1>Home</h1></a>
          <br><br><br><br>
          
            <div class="mainDiv1">
                <h1>Sign In</h1>
                <form action="Login" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="loginPage"/>
                    
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="loginPage"/>
                    <br><br><br><br><br>
                    <label for="submit"></label>
                    <input type="submit" value="Login" id="loginButton"/>
                </form><br /><br /><br /><br />
            </div>
            
            <div id="cloud" style="position:absolute; top:450px;"><span class="shadow"></span></div>
            <br><br>
            
        </div>
    </body>
</html>
