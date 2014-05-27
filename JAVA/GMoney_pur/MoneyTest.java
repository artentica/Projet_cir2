import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;


//Pour les tests paramétriques/////////////////////
import org.junit.runner.RunWith;
import org.junit.runners.Parameterized;
import org.junit.runners.Parameterized.Parameters;
import java.util.Arrays;
import java.util.Collection;







//TEST PARAM2TRIQUES////////////
@RunWith(Parameterized.class)
public class MoneyTest {


		private static int nb_test_ok=0;
		private static int nb_test=0;
		private static Money money=new Money();
	

	@Parameters
	public static Collection<Object[]> params() {
		return Arrays.asList(
			new Object[] { 0.20F, 0.20F},
			new Object[] { -1F, 0.2F},
			new Object[] { 0.80F, 1F}
			);
	}
	private float resultexpected;
	private float send;

	public MoneyTest(float send, float resultexpected) {
		this.resultexpected = resultexpected;
		this.send = send;

	}
	@Test public void add() {
		nb_test++;
		money.add(send);
		float result = money.getAmount();
		try{
			nb_test_ok++;
			Assert.assertEquals(result, resultexpected,0);
		}
		catch (AssertionError e) {
			nb_test_ok--;
			System.out.println(e);
			Assert.fail("fonction fail");
		}		
	}


	@AfterClass public static void logout() {
		if (nb_test==nb_test_ok){
		    System.out.println("OK");
		}
		else System.out.println("KO");
    }





	// public Money m;
	// public static int nb_test_ok=0;
	// public static int nb_test=0;

	// @Before
	// public final void setUp() { 
	//System.out.println("ljhbjhbkb");
	// 	m = new Money();
	// 	nb_test++;  
	// }

	// @After
	// public final void tearDown() { 
	// 	m = null; 
	// }

	
	// @Test
	// public void testgetAmount(){
	// 	float expected = 0F;


	// 	try{
	// 		nb_test_ok++;
	// 		Assert.assertEquals("KO" , expected, m.getAmount() , 0);
	// 		System.out.println("getAmount : OK");
	// 	}
	// 	catch (AssertionError e) {
	// 		nb_test_ok--;
	// 		System.out.println(e);
	// 		Assert.fail("fonction fail");
	// 	}

	// }

	// @Test
	// public void testgetCurrency(){
	// 	String expected = "EUR";


	// 	try{		
	// 		nb_test_ok++;
	// 		Assert.assertEquals("KO" , expected, m.getCurrency());
	// 		System.out.println("getCurrency : OK");
	// 	}
	// 	catch (AssertionError e) {
	// 		nb_test_ok--;
	// 		System.out.println(e);
	// 		Assert.fail("fonction fail");
	// 	}
	// }

	// @Test
	// public void testcheckCurrency ()
 //    {
 //    	Money money= new Money();


 //    	try{		
	// 		nb_test_ok++;
	// 		Assert.assertTrue("KO", m.checkCurrency(money));
	// 		System.out.println("checkCurrency : OK");
	// 	}
	// 	catch (AssertionError e) {
	// 		nb_test_ok--;
	// 		System.out.println(e);
	// 		Assert.fail("fonction fail");
	// 	}
 //    }


	public static void main (String [] arg)
	{
		Result result = JUnitCore.runClasses(MoneyTest.class);
      	
        System.out.println(result.getFailures());
        System.out.println(result.wasSuccessful());
        //System.out.println("Résultat: "+nb_test_ok+"/"+nb_test);
    }}