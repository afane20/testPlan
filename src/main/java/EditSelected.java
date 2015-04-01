
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
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
@WebServlet(urlPatterns = {"/EditSelected"})
public class EditSelected extends HttpServlet {

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
        
        Event event = new Event();
        event.setEventId(request.getParameter("eventId"));
        event.setTitle(request.getParameter("title"));
        event.setPrice(request.getParameter("price"));
        event.setDate(request.getParameter("date"));
        event.setStartTime(request.getParameter("startTime"));
        event.setEndTime(request.getParameter("endTime"));
        event.setLocation(request.getParameter("location"));
        event.setDescription(request.getParameter("description"));
        event.setContactInfo(request.getParameter("contactInfo"));
      
      // JDBC driver name and database URL
   String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
//   String DB_URL = "jdbc:mysql://localhost:3306/planit";
//
//   //  Database credentials
//   String USER = "root";
//   String PASS = "root";
   
   //FOR OPENSHIFT
   String DB_URL = "jdbc:mysql://127.11.76.130:3306/planit";
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
      String sql = "UPDATE event SET Title='" + event.getTitle() + "', Description='" +  event.getDescription() + "'"
              + ", StartTime='" + event.getStartTime()+ "', EndTime='" + event.getEndTime() + "'" 
              + ", Date='" + event.getDate() + "', Location='" + event.getLocation() + "', Price='" + event.getPrice() + "'"
              + " WHERE eventId='" + event.getEventId() + "'";
      
      stmt.executeUpdate(sql);
      System.out.println("Edited the event...");
      System.out.println(sql);
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
   event.writeFile();
   request.getRequestDispatcher("EditEvents").forward(request,response);
}//end main
        
    

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
