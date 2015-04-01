import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Ashlie, Ernesto
 */
public class Categories {
    private Map<String, String> categoryMap;
    
   /*
    * CATEGORIES CONSTRUCTOR
    */
    public Categories() {
        categoryMap = new HashMap<>();
    }

    public Map<String, String> getCategoryMap() {
        return categoryMap;
    }

    public void setCategoryMap(Map<String, String> categoryMap) {
        this.categoryMap = categoryMap;
    }
    
    /*
     * READ MAP OF LISTS
     * Read the terms and put into a map
     */
    public void readMap() {
     //   prop = new Propert();
      // String file = prop.getTopicFile(); 
        // OPENSHIFT------------------------------------------------------
               // String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
              //  BufferedReader reader = new BufferedReader(new FileReader(dataDirectory + "/categories.txt"));
        String file = "/Users/Yeah/Documents/NetBeansProjects/JavaComments/src/main/java/categories.txt";
        //String file = "/Users/Ashlie/Documents/NetBeansProjects/newtestPlan-master/src/main/java/categories.txt";
        try {
        // For Openshift JUST PLACE COMMENTS AROUND IT    
        BufferedReader reader = new BufferedReader(new FileReader(file));
        String line;
        
        while ((line = reader.readLine()) != null) {
           // Line looks like this:
           // faith:faith,beleive,beleif,faithful,faithfulness,trust

            String[] parts = line.split(":");
            String key = parts[0];
            // key has: faith
            
            String valueList = parts[1];
            // valueList now has "faith,beleive,beleif,faithful,faithfulness,trust"
            
            String[] terms = valueList.split(",");
 
            for (String term : terms) {
                categoryMap.put(term, key);
            }
        } // end of while
         reader.close();
        } catch (IOException ex) {
            ex.printStackTrace();
        }     
    }
    
   /*
    * SEARCH DESCRIPTION
    */
    public String searchDescription(String description){
        // Go through the topic list from terms.txt
        for (String term : categoryMap.keySet()) {
            term = term.toLowerCase();
            
            // Put the description string here to compare
            //String con = "Here is a description drama, holiday, horse";//ent.getContent();
            description = description.toLowerCase(); 
             
            if (description.contains(term)) {
                if (!(description.contains(categoryMap.get(term)))) {
                    return categoryMap.get(term);
                  //  System.out.println(categoryMap.get(term));
                }                          
            }        
        } // end of map for loop  
        return "NA";
    } 
}