
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body><h1>Manage Events</h1>
        <form action ="Manage">     
        <c:forEach items="${list}" var="review">
            <input type = "radio" name = "event" value ="${review.getEventId()}">${review.getTitle()}
                <br /><br />             
            </c:forEach>
            <input type="submit" name="editButton" value="Edit Event">
            <input type="submit" name="deleteButton" value="Delete Event">
        </form> 
        <a href = "CreateEvent.jsp"><input type="button" name="button" value="Create Event"></a>
        <a href = "index.jsp"><input type="button" name="button" value="Back to Homepage"></a>
    </body>
</html>
