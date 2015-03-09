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
        
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        
        // Read Users File
        User newUser = new User();
        try {
            
         List<User> list = new ArrayList<User>();
            try {
                //OPENSHIFT
                String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
                BufferedReader reader = new BufferedReader(new FileReader(dataDirectory + "/users.txt"));
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
