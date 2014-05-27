import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;

public class MoneyTest
{

	public Money m;
	public static int nb_test_ok=0;
	public static int nb_test=0;

	@Before
	public final void setUp() { 
		m = new Money();
		nb_test++;  
	}

	@After
	public final void tearDown() { 
		m = null; 
	}

	
	@Test
	public void testgetAmount(){
		float expected = 0F;
		

		try{
			nb_test_ok++;
			Assert.assertEquals("KO" , expected, m.getAmount() , 0);
			System.out.println("getAmount : OK");
		}
		catch (AssertionError e) {
			nb_test_ok--;
			System.out.println(e);
			Assert.fail("fonction fail");
		}

	}

	@Test
	public void testgetCurrency(){
		String expected = "EUR";
		

		try{		
			nb_test_ok++;
			Assert.assertEquals("KO" , expected, m.getCurrency());
			System.out.println("getCurrency : OK");
		}
		catch (AssertionError e) {
			nb_test_ok--;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
	}

	@Test
	public void testcheckCurrency ()
    {
    	Money money= new Money();
    	 

    	try{		
			nb_test_ok++;
			Assert.assertTrue("KO", m.checkCurrency(money));
			System.out.println("checkCurrency : OK");
		}
		catch (AssertionError e) {
			nb_test_ok--;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
    }


	public static void main (String [] arg)
	{
		Result result = JUnitCore.runClasses(MoneyTest.class);
      	/*for (Failure failure : result.getFailures()) {
        	System.out.println(failure.toString());
        }*/
        System.out.println(result.wasSuccessful());
        System.out.println("Résultat: "+nb_test_ok+"/"+nb_test);
    }
}