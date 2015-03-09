package JSPDiscussion;

import JSPDiscussion.reviews.Review;
import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;

public class User {
    private String username;
    private String password; 

    //Getters
    public String getUsername() {return username;}
    public String getPassword() {return password;}

    //Setters
    public void setUsername(String username) {this.username = username;}
    public void setPassword(String password) {this.password = password;}
    
     public void loadFromFileString(String str) {
        String[] parts = str.split(",");

        username = parts[0];
        password = parts[1];
    }
     
     public String toFileString() {
            return username + "," + password;
     }
}
