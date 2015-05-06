import java.applet.*;
import javax.swing.*;
import java.awt.*;

public class app1 extends JApplet
{
    Container messageArea = getContentPane();
    MessagePanel myMessagePanel = new MessagePanel();
    static int fontSize;
    static String color;

    public void init()
    {
      	fontSize = Integer.parseInt(getParameter("size"));
	color = getParameter("color");
	messageArea.add(myMessagePanel);
    }
}

class MessagePanel extends JPanel
{
    public void paintComponent(Graphics grafObj)
    {
	Font myFont = new Font("TimesRoman", Font.ITALIC, 30);
	super.paintComponent(grafObj);
	grafObj.setFont(myFont);

       	if (app1.color.equals(app1.color))
           grafObj.setColor(getParameter("color"));

	grafObj.drawString("Welcome to my home page", 50, 50);
	//	grafObj.drawString(app1.color, 50, 50);
    }
}
