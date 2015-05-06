/*
*
*
*/
import java.awt.*;
import java.util.*;
import java.applet.*;
import javax.swing.*;

public class DateTime extends JApplet
{
	private Container contentPane = getContentPane();
	private JPanel myPanel = new JPanel();

	public void init()
	{
		String color;
		String name;
		Date date = new Date();
		color = getParameter("color");
		name = getParameter("name");
		
		Color background;
		String greeting;
		
		if(color.equals("red"))
		{
			background = Color.RED;
		}
		else if (color.equals("blue"))
		{
			background = Color.BLUE;
		}
		else if (color.equals("lightGray"))
		{
			background = Color.lightGray;
		}
		else if (color.equals("green"))
		{
			background = Color.GREEN;
		}
		else
		{
			background = Color.YELLOW;
		}


		if (name == null)
		{
			name = "Chad";
		}

		greeting = new String(date.toString() + "\tWelcome " + name + "!");
		
		myPanel.setBackground(background);
		JLabel label = new JLabel(greeting);
		
		myPanel.add(label);
		contentPane.add(myPanel);
	}
}
