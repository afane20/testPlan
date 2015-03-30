/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package JSPDiscussion;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
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

@WebServlet(name = "Login", urlPatterns = {"/Login"})
public class Login extends HttpServlet {

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
   String DB_URL = "jdbc:mysql://localhost:3306/";
   String dbName = "planit";
   //  Database credentials
   String USER = "root";
   String PASS = "root";
   
   Connection conn = null;
   Statement stmt = null;
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
      sql = "SELECT title, location FROM byui";
      ResultSet rs = stmt.executeQuery(sql);

      //STEP 5: Extract data from result set
      while(rs.next()){
         //Retrieve by column name
         String title  = rs.getString("title");
         //int age = rs.getInt("age");
         String first = rs.getString("location");
         //String last = rs.getString("last");

         //Display values
         System.out.print("ID: " + title + "\n");
        // System.out.print(", Age: " + age);
         System.out.print(", Name: " + first + "\n");
//         System.out.println(", Last: " + last);
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
   }//end try
   System.out.println("Goodbye!");
//end of Query
   
            
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        
        // Read Users File
        User newUser = new User();
        try {
            
         List<User> list = new ArrayList<User>();
            try {
                //OPENSHIFT
                String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
                BufferedReader reader = new BufferedReader(new FileReader(dataDirectory + "/user.txt"));
                //LOCALLY
                // BufferedReader reader = new BufferedReader(new FileReader("/Users/Yeah/Documents/NetBeansProjects/JavaProject-master/src/main/java/JSPDiscussion/users.txt"));

               String line;

               while ((line = reader.readLine()) != null) {
                    User user = new User();
                    user.loadFromFileString(line);
                    list.add(user);
               }

          } catch (IOException e) {
               e.printStackTrace();
          }
   
            boolean userFound = false;
            for (User readUser : list) {
                if (readUser.getUsername().equals(username)){
                    userFound = true;
                    if (password.equals(readUser.getPassword())){
                request.getSession().setAttribute("username", username);
                request.getRequestDispatcher("EnterPost.jsp").forward(request, response);
                } else {
                response.sendRedirect("InvalidLogin.jsp");
                }
              } 
            }
            
            if (userFound == false){
                response.sendRedirect("InvalidLogin.jsp");
            }
            
           
        } catch (Exception e) {
            e.printStackTrace();
             response.sendRedirect("SignIn.jsp");
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
