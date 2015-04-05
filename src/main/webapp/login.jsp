<%-- 
    Document   : login
    Created on : Apr 4, 2015, 3:47:30 AM
    Author     : Yeah
--%>
<%@include file="facebook.jsp" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <script type = "text/javascript">
setTimeout('document.login.submit()',2000);
        </script>
    </head>
    <body> <!--onload="document.login.submit()"-->
        <h1>Hello World!</h1>
        
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>
         <div id="status" ></div>
         <form action="Home" method="post" name="login"    >  
            <input type="hidden" name="name" id="name" value="response.name">
            <input type="hidden" name="emailId" id="emailId" value="response.email">
            <input type="submit" name ="Home">
         </form>

<script>
  
</script>
    </body>
</html>
