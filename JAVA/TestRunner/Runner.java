import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;

public class Runner{

	private String name_fct, description;
	private int nb_fct_tested,status;
	private Float value_used, max_mark;
	Runner (String name_fct,int nb_fct_tested, Float value_used, int status, String description, Float max_mark)
    {
     this.name_fct=name_fct;
     this.nb_fct_tested=nb_fct_tested;
     this.value_used=value_used;
     this.status=status;
     this.description=description;
     this.max_mark=max_mark;
    }

public static void main (String [] args)
	{

		Result result = JUnitCore.runClasses(MoneyTest.class);
    }
}