<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
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
                <h1>Register</h1>
                <form action="NewUser" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="loginPage"/>
                    
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="loginPage"/>
                    
                    <label for="password2">Verify Password:</label>
                    <input type="password" name="password2" class="loginPage"/>
                    <br><br>
                    <label for="submit"></label>
                    <input type="submit" value="Create New User" id="loginButton"/>
                </form>
            </div>
          <br><br><br><br><br>
        <div id="image"><img src="yoshis-story.jpg" width="500" height="250" style="margin-left: 70px;margin-top: 30px;"></div>

        </div>
    </body>
</html>
