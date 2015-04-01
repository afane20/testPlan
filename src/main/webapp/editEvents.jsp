
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<!doctype html>
<html>
    <head>
        <!-- Style Links -->
        <link rel="stylesheet" href="createEvent_1.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Manage Events</title>
    </head>
    <body id="wrapper">
      <div class="register">
      <h1>Manage Events</h1>
        </div>
      <div>
        <h3>Select Your Event</h3>
        <form action ="Manage">     
        <c:forEach items="${list}" var="review">
            <input style="margin-left:30px;" type = "radio" name = "event" value ="${review.getEventId()}">${review.getTitle()}
                <br /><br />             
            </c:forEach>
                          <h3>Actions</h3>

            <div class="buttons">
            <input style="margin-left:50px;" type="submit" name="editButton" class="btn btn-primary" value="Edit Event">
            <input style="margin-left:70px;" type="submit" name="deleteButton" class="btn btn-danger" value="Delete Event"><br><br>
        </form> 
        
        <a href = "CreateEvent.jsp"><input style="margin-left:50px;" type="button" class="btn btn-primary" name="button" value="Create Event"></a>
        <a href = "index.jsp"><input style="margin-left:50px" type="button" name="button" class="btn btn-primary" value="Back to Homepage"></a>
        </div>
    </body>
</html>
