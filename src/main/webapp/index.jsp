<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.Calendar"%>
<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.text.DateFormat"%>
<%@include file="facebook.jsp" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> 
<!DOCTYPE html>
<html>
    <head>
        <title>PLANIT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/swiper.min.css">
        <link rel="stylesheet" href="css/planit.css">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.x.x/js/swiper.jquery.min.js"></script>
        <!--<script src="js/swiper.min.js"></script>-->
        <script src="js/Events.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.x.x/js/swiper.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.0.6/js/swiper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.x.x/js/swiper.jquery.js"></script>

        <script src="js/planit.js">
        </script>

    </head>
    <body onload="myFunction()">
        <script src="path/to/swiper.min.js"></script>


        <header>
            <div id='nav'>
                <div>
                    <fb:login-button scope="public_profile,email" class="btn btn-primary" onlogin="checkLoginState();">
                    </fb:login-button>
                    
                    <p> <span id="status"></span> Rexburg, ID</p>
                </div>
               <!-- <a href="CreateEvent.jsp">Create an Event</a>
               Ashlie's code 
               
               -->
                 <form action="Home" method="post">  
                    <input type="hidden" name="name" id="name" value="response.name">
                    <input type="hidden" name="emailId" id="emailId" value="response.email">
                    <input class="btn btn-primary" type="Submit" value="Manage Events">
                </form>
                <p></p>
                <div id='sort-button-container'>
                    <input type='radio' name='sorting-buttons' class='sorting-buttons' id='sort-time'><label for='sort-time' class='glyphicon glyphicon-time sorting-buttons'></label>
                    <input type='radio' name='sorting-buttons' class='sorting-buttons' id='sort-price'><label for='sort-price' class='glyphicon glyphicon-usd sorting-buttons'></label>
                    <input type='radio' name='sorting-buttons' class='sorting-buttons' id='sort-map'><label for='sort-map' class='glyphicon glyphicon-map-marker sorting-buttons'></label>
                </div>
            </div>
            <div id='date-slider'>
                <!-- Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- put a for loop for this with real values -->
                         <%
                                // The date format that is stored as the value
                                DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                                // The day of the week (separate for the first instance of "Today"
                                SimpleDateFormat dateFormat2 = new SimpleDateFormat("E");
                                // The date itself
                                SimpleDateFormat dateFormat3 = new SimpleDateFormat("dd");

                                Calendar cal = Calendar.getInstance();
                                boolean first = false;

                                for (int i = 0; i < 14; i++) {
                                    // Manupulate a, b, and c in the display to get desired results
                                    String dataBase = (dateFormat.format(cal.getTime()));
                                    String dayOfWeek = (dateFormat2.format(cal.getTime()));
                                    String dateNum = (dateFormat3.format(cal.getTime()));                                  
                                    
                                    // Format the option tag
                                    String optionOpen = "<div class=\"swiper-slide text-center\">";
                                    String optionClose = "<br><span class=\"date-num\">";
                                    String closingTag = "</span><div class=\"hidden date-hidden\">";
                                    String end = "</div></div>";
                                        
                                    // If it is the first day, write "Today" instead of the day of the week
                                    if (first == false) {                    
                                        out.write(optionOpen + "Today" + optionClose + dateNum + closingTag + dataBase + end);
                                        first = true;
                                    } else {
                                        out.write(optionOpen + dayOfWeek + optionClose + dateNum + closingTag + dataBase + end);
                                    }
                                        
                                    // Add to go to the next day
                                    cal.add(Calendar.DATE, 1);
                                }
                            %>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                
            </div>
        </header>
        <div class="container-fluid">
            <main>
                <div class="row events-container">   ${review.getTitle()}
                    <c:forEach items="${list}" var="event">
                        <div class="col-xs-12 col-md-6 event"><div class="col-xs-4 col-md-2 event-img"><img src=" + ${event.getPicture()} + " 
                    + alt="event" class="img-responsive"></div><div class="col-xs-5 col-md-7 event-title"><h1 class="text-muted event-title"> 
                    + ${event.getTitle()} + </h1></div><div class="col-xs-3 col-md-3 event-info"><p class="event-info event-info-highlight"><span class="glyphicon glyphicon-time"></span>' 
                    + ${event.getStartTime()} + </p><p class="event-info"><span class="glyphicon glyphicon-usd"></span>' 
                    + ${event.getPrice()} + '</p><p class="event-info"><span class="glyphicon glyphicon-map-marker"></span>' 
                    + '2mi' + '</p></div><div class="col-xs-12 event-description"><span class="glyphicon glyphicon-time"></span><h2 class="event-time text-muted">' 
                    + ${event.getStartTime()} + ' <span>-</span> ' 
                    + ${event.getEndTime()} + '</h2><span class="glyphicon glyphicon-map-marker"></span><h2 class="event-location text-muted">' 
                    + ${event.getLocation()} + '</h2><p>' 
                    + ${event.getDescription()} + '</div></div>
                    </c:forEach>
                                   
                </div>
            </main>
        </div>
    </body>
</html>
