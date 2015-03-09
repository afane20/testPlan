
package JSPDiscussion;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(name = "NewUser", urlPatterns = {"/NewUser"})
public class NewUser extends HttpServlet {

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
        String password2 = request.getParameter("password2");
       
        
        if (password.equals(password2)){
            // Read Users File
            User newUser = new User();
            newUser.setUsername(username);
            newUser.setPassword(password);
            String fileContent = "";
        try {
                
            List<User> list = new ArrayList<User>();
            
          try {
                // LOCALLY
               //BufferedReader reader = new BufferedReader(new FileReader("/Users/Yeah/Documents/NetBeansProjects/JavaProject-master/src/main/java/JSPDiscussion/users.txt"));
              
              // OPENSHIFT
                String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
                BufferedReader reader = new BufferedReader(new FileReader(dataDirectory + "/users.txt"));
               // End of openshift
                String line;
               while ((line = reader.readLine()) != null) {
                    fileContent += line + "\n";
                    User user = new User();
                    user.loadFromFileString(line);
                    list.add(user);
               }

          } catch (IOException e) {
               e.printStackTrace();
          }
          
               list.add(newUser);
               // FOR LOCAL!!!          
               //FileWriter file = new FileWriter("/Users/Yeah/Documents/NetBeansProjects/JavaProject-master/src/main/java/JSPDiscussion/users.txt");
               
               //for openshift!!
               String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
               FileWriter file = new FileWriter(dataDirectory + "/users.txt");
               System.out.println(fileContent);
               String information = fileContent + newUser.getUsername() + "," + newUser.getPassword();
               System.out.println(information);
               try {
                    file.write(information); // refer to ashlies code 

                } catch (IOException e) {
                    e.printStackTrace();

                } 
                    file.flush();
                    file.close();
                
                request.getSession().setAttribute("username", username);
                request.getRequestDispatcher("EnterPost.jsp").forward(request, response);
            } catch (Exception e) {
                e.printStackTrace();

            } 
        }
        else{
            response.sendRedirect("InvalidLogin.jsp");
        }
        
        System.out.println("We are in");
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
