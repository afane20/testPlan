/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author Ashlie
 */
@WebServlet(urlPatterns = {"/Manage"})
public class Manage extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

         HttpSession session = request.getSession(true);
        
        String event = request.getParameter("event");
        String deleteButton = request.getParameter("deleteButton");
        String editButton = request.getParameter("editButton");
        System.out.println("Event: " + event);
        System.out.println("Delete: " + deleteButton);
        System.out.println("Edit: " + editButton);
      
      // JDBC driver name and database URL
      String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
     // String DB_URL = "jdbc:mysql://localhost:3306/planit";

   //  Database credentials
//   String USER = "root";
//   String PASS = "root";
      
      //FOR OPENSHIFT
   String DB_URL = "jdbc:mysql://127.11.76.130/planit";
   String USER = "adminJINwHhB";
   String PASS = "lrUe_5DxE1eK";
   
   Connection conn = null;
   Statement stmt = null;
   try{
      //STEP 2: Register JDBC driver
      Class.forName("com.mysql.jdbc.Driver");

      //STEP 3: Open a connection
      System.out.println("Connecting to a selected database...");
      conn = DriverManager.getConnection(DB_URL, USER, PASS);
      System.out.println("Connected database successfully...");
      
      //STEP 4: Execute a query
      System.out.println("Inserting records into the table...");
      stmt = conn.createStatement();

      // Add price to this!
      
      // DELETE FROM BOTH USER AND USER_EVENTS TABLE
      if (deleteButton != null) {
          String sql = "DELETE FROM user_event WHERE eventId='" + event + "'";
          stmt.executeUpdate(sql);
          System.out.println("Deleted records from the user_events table...");
          
          String sql2 = "DELETE FROM event WHERE eventId='" + event + "'";
          stmt.executeUpdate(sql2);
          System.out.println("Deleted records from the user table...");
          request.getRequestDispatcher("EditEvents").forward(request,response); 
      }

      if (editButton != null) {
      
          String sql = "SELECT eventId, title, location, price, date, startTime, endTime, description FROM event"
                  + " WHERE eventId = '" + event + "'";
        ResultSet rs = stmt.executeQuery(sql);

      //STEP 5: Extract data from result set
      Event e = new Event();
       List<Event> list = new ArrayList<Event>();
      while(rs.next()){
         //Retrieve by column name
        e.setEventId(rs.getString("eventId"));
        e.setTitle(rs.getString("Title"));
        e.setPrice(rs.getString("Price"));
        e.setDate(rs.getString("Date"));
        e.setStartTime(rs.getString("StartTime"));
        e.setEndTime(rs.getString("EndTime"));
        e.setLocation(rs.getString("Location"));
        e.setDescription(rs.getString("Description")); 
        list.add(e);
        e.writeFile();
      }
         request.setAttribute("event", list);
         request.getRequestDispatcher("editSelected.jsp").forward(request,response); 
      } 
         
      
   }catch(SQLException se){
      //Handle errors for JDBC
      se.printStackTrace();
   }catch(Exception e){
      //Handle errors for Class.forName
      e.printStackTrace();
   }finally{
      //finally block used to close resources
      try{
         if(stmt!=null)
            conn.close();
      }catch(SQLException se){
      }// do nothing
      try{
         if(conn!=null)
            conn.close();
      }catch(SQLException se){
         se.printStackTrace();
      }//end finally try
   }//end try
   
   System.out.println("Goodbye!");
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
