<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Selected</title>
        <link rel="stylesheet" href="createEvent_1.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body id="wrapper">
        <div class="register" ><h2>Planit- Edit Selected Event</h2></div>
       
        <form action ="EditSelected"> 
         <c:forEach items="${event}" var="review">
             <input type="hidden" name ="eventId" value="${review.getEventId()}">
             <p><br>   
                 Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="event-input" name="title" value="${review.getTitle()}"><br></p>
          <!--  Contact Information:<input class="event-input" name="contactInfo" value="${review.getContactInfo()}"><br> -->
             <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="event-input" name="price" value="${review.getPrice()}"><br></p>
             <p> Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="event-input" name="date" value="${review.getDate()}"><br></p>
             <p>Start Time:&nbsp;<input class="event-input" name="startTime" value="${review.getStartTime()}"><br></p>
             <p>End Time:&nbsp;&nbsp;<input class="event-input" name="endTime" value="${review.getEndTime()}"><br></p>
             <p>Location:&nbsp;&nbsp;&nbsp;&nbsp;<input class="event-input" name="location" value="${review.getLocation()}"><br></p>
             <p>Description:<input class="event-input" name="description" value="${review.getDescription()}"><br></p>
                <br /><br />             
            </c:forEach>
                <div id="createEvent">
            <input type="submit" class="btn btn-primary" name="editButton" value="Submit Edit">
                </div>
        </form> 
    </body>
</html>
