import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;

public class Runner{
public static void main (String [] args)
	{

		Result result = JUnitCore.runClasses(MoneyTest.class);
    }
}