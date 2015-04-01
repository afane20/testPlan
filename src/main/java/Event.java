import java.io.BufferedReader;
import java.io.FileReader;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Ashlie, Ernesto
 */
public class Event {
    // Foreign keys //
    private String eventId;
    private int userId;
    
    // Others //
    private String contactInfo;
    private String location;
    private String price;
    private String title;
    private String description;
    private String startTime;
    private String endTime;
    private String date;
    
    Event() {
        
        // Do an alphabetic sort when sorting by time (do military time when you sort) 
        //  d.setDate();
    }

    public String getEventId() {
        return eventId;
    }

    public void setEventId(String eventId) {
        this.eventId = eventId;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getContactInfo() {
        return contactInfo;
    }

    public void setContactInfo(String contactInfo) {
        this.contactInfo = contactInfo;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getStartTime() {
        return startTime;
    }

    public void setStartTime(String startTime) {
        this.startTime = startTime;
    }

    public String getEndTime() {
        return endTime;
    }

    public void setEndTime(String endTime) {
        this.endTime = endTime;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }
    
    public void writeFile() {
                
           // JDBC driver name and database URL
   String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
  // String DB_URL = "jdbc:mysql://localhost:3306/";
   String dbName = "planit";
   //  Database credentials
//   String USER = "root";
//   String PASS = "root";
   //FOR OPENSHIFT
   String DB_URL = "jdbc:mysql://127.11.76.130:3306/";
   String USER = "adminJINwHhB";
   String PASS = "lrUe_5DxE1eK";
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
   
   // Path on Ernesto's computer
   // OPENSHIFT
         String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
   //String fileName = "/Users/Yeah/Documents/NetBeansProjects/JavaComments/src/main/webapp/js/Events.js";
    // Path on Ashlie's computer
   // String fileName = "/Users/Ashlie/Documents/NetBeansProjects/PPP-master/src/main/webapp/js/Events.js";
          try {
          BufferedReader reader = new BufferedReader(new FileReader(dataDirectory + "/Events.js"));
          //dataDirectory + "/user.txt";
          PrintWriter writer = new PrintWriter (dataDirectory + "/user.txt", "UTF-8");
          int count = 0;
          
          writer.println("var events = [");
          for (Event items : list){
              writer.println("{");
              writer.println("\"Title\": \""+ items.getTitle() + "\",");
              
              String description = items.getDescription();
              description = description.trim();
              description = description.replaceAll("\r?\n|\r/","");
              System.out.print(description);
              
              Categories ca = new Categories();
              ca.readMap();
              String a = ca.searchDescription(description);
              System.out.println("found: " + a);
        String picture;
        switch (a) {
            case "Fitness"     : picture = "img/fitness.svg";
                     break;
            case "Performance" : picture = "img/performance.svg";
                     break;
            case "Outdoors"    : picture = "img/outdoors.svg";
                     break;
            case "Academics"   : picture = "img/academics.svg";
                     break;
            case "Social"      : picture = "img/social.svg";
                     break;
            case "Instruction": picture = "img/instruction.svg";
                     break;
            case "Festive"     : picture = "img/festive.svg";
                     break;
            case "Dance"       : picture = "img/dance.svg";
                     break;
            case "Spiritual"   : picture = "img/spiritual.svg";
                     break;
            case "Conference"  : picture = "img/conference.svg";
                     break;
            case "Competition" : picture = "img/competition.svg";
                     break;
            case "Comedy"      : picture = "img/comedy.svg";
                     break;
            case "Theatre"     : picture = "img/theatre.svg";
                     break;
            case "Employee"    : picture = "img/employee.svg";
                     break;   
            default            : picture = "img/dance.svg";
                     break;
        }
        System.out.println(picture);
        
              writer.println("\"Description\": \"" + description  + "\",");
              writer.println("\"StartTime\": \""+ items.getStartTime() + "\",");
              writer.println("\"EndTime\": \""+ items.getEndTime() + "\",");
              writer.println("\"Date\": \""+ items.getDate() + "\",");
              writer.println("\"Price\": \""+ items.getPrice() + "\",");
              writer.println("\"Picture\": \""+ picture + "\",");
              writer.println("\"Location\": \""+ items.getLocation() + "\",");
              writer.println("\"Email\": null},");
              if (count  == 100){
              break;
              }
              count++;
          }
          writer.print("];");
          writer.close();
          } catch (Exception e){
            e.printStackTrace();
          }
    }
    }
           
}