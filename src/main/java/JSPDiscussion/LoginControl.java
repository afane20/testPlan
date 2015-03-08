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
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Bryce
 */
@WebServlet(name = "LoginControl", urlPatterns = {"/LoginControl"})
public class LoginControl extends HttpServlet {

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
            
            
            
            // For OPENSHIFT
           // String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
           // Object obj = parser.parse(new FileReader(dataDirectory + "/user.txt"));

            //JSONObject jsonObject = (JSONObject) obj;
 
        //    String FilePassword = (String) jsonObject.get(username);
       //      String FilePassword = newUser.getPassword();
   
                     
            for (User readUser : list) {
                if (readUser.getUsername().equals(username)){
                    if (password.equals(readUser.getPassword())){
                request.getSession().setAttribute("username", username);
                request.getRequestDispatcher("EnterNewPost.jsp").forward(request, response);
                } else {
                response.sendRedirect("InvalidLogin.jsp");
                }
              } 
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
