<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Hello World!</h1>
        <form action ="EditSelected"> 
         <c:forEach items="${event}" var="review">
             <input type="hidden" name ="eventId" value="${review.getEventId()}">
          Title:<input class="event-input" name="title" value="${review.getTitle()}"><br>
          <!--  Contact Information:<input class="event-input" name="contactInfo" value="${review.getContactInfo()}"><br> -->
          Price:<input class="event-input" name="price" value="${review.getPrice()}"><br>
          Date:<input class="event-input" name="date" value="${review.getDate()}"><br>
          Start Time:<input class="event-input" name="startTime" value="${review.getStartTime()}"><br>
          End Time:<input class="event-input" name="endTime" value="${review.getEndTime()}"><br>
          Location:<input class="event-input" name="location" value="${review.getLocation()}"><br>
          Description:<input class="event-input" name="description" value="${review.getDescription()}"><br>
                <br /><br />             
            </c:forEach>
            <input type="submit" name="editButton" value="Submit Edit">
        </form> 
    </body>
</html>
