
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Enter New Post</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
            <header>
                <div id="wrapper">
                    <h2>Welcome ${sessionScope.username}</h2>
                </div>
            </header>
            <div id="wrapper">
                <div>
                    <h2>Make a comment, talk about Pikachu if you want</h2>
                    <h4><i style="color:red">No commas!(due to internal functionality)</i></h4>
                </div>
                
                <form action="CreatePost" method="POST" name="newComment">
                    <label for="newReview"></label>
                    <textarea autofocus name="newPost" id="TextArea"></textarea><br />
                    
                    <input type="hidden" name="username" value="${sessionScope.username}">
                   
                    <label for="submit"></label>
                    <input type="submit" name="submit" value="Submit New Post" class="Button">

                </form>

                <br><br><br>
                <div><img src="fat-pikachu.png" width="300" height="300"></div>
               <button onclick="window.location.href='LoadComments'" class="Button" >View Posts</button>
               <button onclick="window.location.href='SignIn.jsp'" class="Button" style="margin-left: 20px;">Logout</button>

            </div>
    </body>
</html>
