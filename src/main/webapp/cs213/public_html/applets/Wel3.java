/* Wel3.java
   An applet to illustrate parameters
   */
import java.applet.*;
import javax.swing.*;
import java.awt.*;

// The panel class on which the message will be painted

class MessagePanel2 extends JPanel {
   Font myFont = new Font("TimesRoman", Font.ITALIC,
                             Wel3.mySize);

   public void paintComponent(Graphics grafObj) {
      super.paintComponent(grafObj);

      grafObj.setFont(myFont);
      grafObj.drawString("Welcome to my home page!", 50, 50);
   }
}

// The Wel3 applet

public class Wel3 extends JApplet {
   static int mySize;
   static String myColor;
   public void init() {
      Container messageArea = getContentPane();
      String pString;

// Get the fontsize parameter

      pString = getParameter("size");
      myColor = getParameter("color");
// If it's null, set the size to 30; otherwise, use the
//  parameter value

      if (pString == null)
         mySize = 30;
      else mySize = Integer.parseInt(pString);
     
// Instantiate the panel with the message and add it to
//  the content panel
      
      MessagePanel2 myMessagePanel = new MessagePanel2();
      if (myColor.equals("red"))
      {
         myMessagePanel.setBackground(Color.red);
      }
      else if (myColor.equals("blue"))
      {
         myMessagePanel.setBackground(Color.blue);
      }
      else if (myColor.equals("green"))
      {
         myMessagePanel.setBackground(Color.green);
      }	      
      messageArea.add(myMessagePanel);
   }
}

