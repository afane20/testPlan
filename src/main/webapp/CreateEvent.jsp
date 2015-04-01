<!doctype html>
<html>
    <head>
        <!-- Style Links -->
        <link rel="stylesheet" href="createEvent_1.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
<body>
<div id="wrapper">

    <!-- Creating an Event-->
  <div>
    <div>
       <div class="register">
          <h1 class="h1">Planit-Create Event</h1>
        </div>
          <form action="CreateEvent" method="post">                  
              <br>
              <p>
              <label>Title:  &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input name="title"><br>
      
              
               <p><label>Contact Information: &nbsp;</label>
               <input name="contactInfo" placeholder="Email recomended"><br></p>
            
              <p>
               <label>Price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
               <input name="price" placeholder="5.30 or 10" /><br></p>
              
               <p><label>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                <input name="date" placeholder="2015-04-10"/><br></p>
  

  
  
                <p><label>Start Time: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                   <input name="startTime" placeholder="5:00:00 or 15:00:00"/></p>
               
                   <p><label> End Time: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input name="endTime" placeholder="10:00:00 or 13:45:00"/><br></p>

                     <p><label>Location: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                     <textarea name="location"></textarea><br></p>

                      <p><label>Description: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <textarea name="description"></textarea><br><br></p>

        <div id="createEvent" >    
            <input type="submit" class="btn btn-primary" value="Create Event"></div>
           </form>
        </div>
</div>

</div>
</body>
</html>
<!--<html>
    <head>
        <link rel="stylesheet" href="css/swiper.min.css">
        
    </head>
<body>
    <style>
        .col-xs-4 {
            padding: 4px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="logo">Planit</h1>
                <p class="text-center logo">Local Events Search</p>
                <h2>Create Your Event</h2>
                <form action="CreateEvent" method="post">                  
                    <div class="clearfix"></div>
                       Title:<input class="event-input" name="title"><br>
                       Contact Information:<input class="event-input" name="contactInfo"><br>
                       Price:<input class="event-input" name="price"><br>
                       Date:<input class="event-input" name="date"><br>
                       Start Time:<input class="event-input" name="startTime"><br>
                       End Time:<input class="event-input" name="endTime"><br>
                       Location:<textarea class="event-input" name="location"></textarea><br>
                       Description:<textarea class="event-input" name="description"></textarea><br>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Create Event">
                </form>
            </div>
        </div>
    </div>
</body>
</html>-->
