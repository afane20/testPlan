import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import javax.swing.*;



public class Changer extends JApplet
{
   private Container contentPane = getContentPane();
   private JTextField text;
   private Font plainFont;
   private JPanel myPanel = new JPanel();

   static int mySize;
   private Color color;
   
   public void init() 
   {
      String temp1;
      String temp2;
      //Color color = Color.red;
      temp1 = getParameter("size");
      temp2 = getParameter("color");
      if (temp2 == null)
         color = Color.red;
      else if (temp2 == "blue")
         color = Color.blue;
      else if (temp2 == "yellow")
         color = Color.yellow;
      else if (temp2 == "red")
         color = Color.red;
      else
         color = Color.green;
      myPanel.setBackground(color);
      if (temp1 == null)
         mySize = 16;
      else
         mySize = Integer.parseInt(temp1);
      
      
      plainFont = new Font("Serif", Font.PLAIN, mySize);
      text = new JTextField ("testing bob", 20);
      myPanel.add(text);
      text.setFont(plainFont);
      contentPane.add(myPanel);
   }
}
