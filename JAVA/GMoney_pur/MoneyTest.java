import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;

public class MoneyTest
{

	public void testgetAmount(){
		Money m = new Money( 20.0F , "USD" );
		System.out.println("coucou");
		Assert.assertEquals( 20.0F, m.getAmount() , 0);
	}

	public static void main (String [] arg)
	{
		Result result = JUnitCore.runClasses(MoneyTest.class);
      	/*for (Failure failure : result.getFailures()) {
        	System.out.println(failure.toString());
      	}*/
      	System.out.println(result.wasSuccessful());
	}
}