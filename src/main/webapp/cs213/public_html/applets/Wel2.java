/* Wel2.java
   An applet to illustrate the display of a string
   in a specific font, font style, and font size
   */
import java.applet.*;
import javax.swing.*;
import java.awt.*;

// The panel class on which the message will be painted

class MessagePanel extends JPanel {
   Font myFont = new Font("TimesRoman", Font.ITALIC, 24);

   public void paintComponent(Graphics grafObj) {
      super.paintComponent(grafObj);
      grafObj.setFont(myFont);
      grafObj.drawString("Welcome to my first home page!", 50,
                         50);
   }
}

// The Wel2 applet

public class Wel2 extends JApplet {

// The init method - create the content pane, instantiate
//   the message panel and add it to the content pane

   public void init() {
      Container messageArea = getContentPane();
      MessagePanel myMessagePanel = new MessagePanel();
      myMessagePanel.setBackground(Color.green);
      messageArea.add(myMessagePanel);
   }
}

