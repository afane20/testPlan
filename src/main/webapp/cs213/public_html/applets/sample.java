import java.applet.*;
import javax.swing.*;
import java.awt.*;

public class sample extends JApplet {
   Container messageArea = getContentPane();
   MessagePanel myMessagePanel = new MessagePanel();

   public void init(){
      messageArea.add(myMessagePanel);
   }

}

class MessagePanel extends JPanel {
   public void paintComponent(Graphics grafObj){
      super.paintComponent(grafObj);
      grafObj.drawString("Welcome to Conference!", 30, 20);
   }
}
