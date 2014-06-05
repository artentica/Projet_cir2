import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.util.*;
import java.io.*;

public class Runner{

	private String name_fct, description,value_used;
	private int nb_fct_tested,status;
	private Float max_mark;
	public static Vector v2;
	Runner (String name_fct,int nb_fct_tested, String value_used, int status, String description, Float max_mark)
	{
		this.name_fct=name_fct;
		this.nb_fct_tested=nb_fct_tested;
		this.value_used=value_used;
		this.status=status;
		this.description=description;
		this.max_mark=max_mark;
	}
	public void back_vector(Vector<Runner> Runner){
		v2 = new Vector();
		this.v2.addAll(Runner);
	}
	public static void write_file (Vector<Runner> v2, String road)
	{               
		try {
			FileOutputStream ops=new FileOutputStream(road+"result.txt");
			PrintWriter pw=new PrintWriter(ops);
			for (int i=0; i<v2.size(); i++) {
				pw.print(v2.elementAt(i).name_fct);
				pw.print("/$/");
				pw.print(v2.elementAt(i).nb_fct_tested);
				pw.print("/$/");
				pw.print(v2.elementAt(i).value_used);
				pw.print("/$/");
				pw.print(v2.elementAt(i).status);
				pw.print("/$/");
				pw.print(v2.elementAt(i).description);
				pw.print("/$/");
				pw.println(v2.elementAt(i).max_mark);
			}
			pw.flush();
			pw.close();
		}
		catch (Exception e) {} 
	}

	public static void main (String [] args)
	{

		Result result = JUnitCore.runClasses(MoneyTest.class);
		String road= "projet/test/";
		write_file(v2,road);
		  
		

	}
}