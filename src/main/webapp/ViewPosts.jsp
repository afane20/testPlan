
<%
if(null == session.getAttribute("username")){  
  response.sendRedirect("SignIn.jsp");
}
%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Comments... </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <div id="head">
                <h1>Comments</h1>
            </div>
        </header>
        

        <div id="wrapper">
            <div><button onclick="window.location.href='SignIn.jsp'" class="Button">Logout</button>

            <br><br><br>
            <c:forEach items="${reviews}" var="review">
                <div><strong>${review.username}</strong> <span>${review.currentDateTime}</span></div>
                ${review.reviewText}<br /><br />
                
            </c:forEach>
            <button onclick="window.location.href='EnterPost.jsp'" class="Button">New Post</button>
        </div>
    </body>
</html>
