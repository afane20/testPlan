/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Yeah
 */
@WebServlet(urlPatterns = {"/ListEvents"})
public class ListEvents extends HttpServlet {

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
        
        
           // JDBC driver name and database URL
   String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
  // String DB_URL = "jdbc:mysql://localhost:3306/";
   String dbName = "planit";
   //  Database credentials
//   String USER = "root";
//   String PASS = "root";
   
   //FOR OPENSHIFT
   String DB_URL = "jdbc:mysql://127.11.251.130/";
   String USER = "adminqvt78mw";
   String PASS = "yR3dXZIcZK8n";
   
   Connection conn = null;
   Statement stmt = null;
   
    List<Event> list = new ArrayList<Event>();
   try{
      //STEP 2: Register JDBC driver
      Class.forName("com.mysql.jdbc.Driver");

      //STEP 3: Open a connection
      System.out.println("Connecting to database...");
      conn = DriverManager.getConnection(DB_URL+dbName,USER,PASS);

      //STEP 4: Execute a query
      System.out.println("Creating statement...");
      stmt = conn.createStatement();
      String sql;
      sql = "SELECT title, location, price, date, startTime, endTime, description FROM event";
      ResultSet rs = stmt.executeQuery(sql);

      //STEP 5: Extract data from result set
      while(rs.next()){
         //Retrieve by column name
        Event event = new Event();
        event.setTitle(rs.getString("Title"));
        event.setPrice(rs.getString("Price"));
        event.setDate(rs.getString("Date"));
        event.setStartTime(rs.getString("StartTime"));
        event.setEndTime(rs.getString("EndTime"));
        event.setLocation(rs.getString("Location"));
        event.setDescription(rs.getString("Description")); 
        list.add(event);
      }
      //STEP 6: Clean-up environment
      rs.close();
      stmt.close();
      conn.close();
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
            stmt.close();
      }catch(SQLException se2){
      }// nothing we can do
      try{
         if(conn!=null)
            conn.close();
      }catch(SQLException se){
         se.printStackTrace();
      }//end finally try

   System.out.println("Goodbye!");
   
            // Pass a list here, then do a for-each statement in the jsp file
            request.setAttribute("list", list);
          for (Event e:list ){
            System.out.println(e.getTitle());
          }
          
          //For Openshift
           String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
             //  FileWriter file = new FileWriter(dataDirectory + "/user.txt");
          //String fileName = "/Users/Yeah/Documents/NetBeansProjects/JavaComments/src/main/webapp/js/Events.js";
          try {
          //FileWriter file = new FileWriter(dataDirectory + "/Events.js");

          PrintWriter writer = new PrintWriter (dataDirectory + "/Events.js", "UTF-8");
          int count = 0;
          
          writer.println("var events = [");
          for (Event items : list){
              writer.println("{");
              writer.println("\"Title\": \""+ items.getTitle() + "\",");
              
              String description = items.getDescription();
              description = description.trim();
              description = description.replaceAll("\r?\n|\r/","");
              System.out.print(description);
              writer.println("\"Description\": \"" + description  + "\",");
              writer.println("\"StartTime\": \""+ items.getStartTime() + "\",");
              writer.println("\"EndTime\": \""+ items.getEndTime() + "\",");
              writer.println("\"Date\": \""+ items.getDate() + "\",");
              writer.println("\"Price\": \""+ items.getPrice() + "\",");
              writer.println("\"Picture\": \""+ "img\\/BYU-Idaho_Medallion_Logo.png" + "\",");
              writer.println("\"Location\": \""+ items.getLocation() + "\",");
              writer.println("\"Email\": null},");
              if (count  == 200){
              break;
              }
              count++;
          }
          writer.println("];");
          //writer.close();
          
                    writer.flush();
                    writer.close();
          
          
          } catch (Exception e){
            e.printStackTrace();
          }
          
           // request.getRequestDispatcher("listEvents.jsp").forward(request,response);
           request.getRequestDispatcher("index.jsp").forward(request,response);
   }
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
