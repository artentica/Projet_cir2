import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;


//Pour les tests paramétriques/////////////////////
// import org.junit.runner.RunWith;
// import org.junit.runners.Parameterized;
// import org.junit.runners.Parameterized.Parameters;
// import java.util.Arrays;
// import java.util.Collection;







// //TEST PARAMETRIQUES////////////
// @RunWith(Parameterized.class)
public class MoneyTest {


// 		private static int nb_test_ok_add=0;
// 		private static int nb_test_ok_sub=0;
// 		private static int nb_test=0;
// 		private Money money=new Money();
	

// 	@Parameters
// 	public static Collection<Object[]> params() {
// 		return Arrays.asList(
// 			new Object[] { 0.40F, 0.40F,-0.4F},
// 			new Object[] { -1F, 0F,0F},
// 			new Object[] { 0.80F, 0.8F,-0.8F}
// 			);
// 	}
// 	private float resultexpectedadd;
// 	private float resultexpectedsub;
// 	private float send;

// 	public MoneyTest(float send, float resultexpectedadd, float resultexpectedsub) {
// 		this.resultexpectedadd = resultexpectedadd;
// 		this.resultexpectedsub = resultexpectedsub;
// 		this.send = send;

// 	}
// 	@Test public void add() {
// 		nb_test++;
// 		money.add(send);
// 		float result = money.getAmount();
// 		try{
// 			nb_test_ok_add++;
// 			Assert.assertEquals(result, resultexpectedadd,0);
// 		}
// 		catch (AssertionError e) {
// 			nb_test_ok_add--;
// 			System.out.println(e);
// 			Assert.fail("fonction fail");
// 		}		
// 	}

// 	@Test public void sub() {
// 		money.sub(send);
// 		float result = money.getAmount();
// 		try{
// 			nb_test_ok_sub++;
// 			Assert.assertEquals(result, resultexpectedsub,0);
// 		}
// 		catch (AssertionError e) {
// 			nb_test_ok_sub--;
// 			System.out.println(e);
// 			Assert.fail("fonction fail");
// 		}		
// 	}

	




// 	@AfterClass public static void logout() {
// 		if (nb_test==nb_test_ok_add){
// 		    System.out.println("La fonction add() est: OK");
// 		}
// 		if (nb_test==nb_test_ok_sub){
// 		    System.out.println("La fonction sub() est: OK");
// 		}
//     }





	public Money m;
	public Money m2 = new Money(2.45F,"USR");
	public static int nb_test_ok=0;
	public static int nb_test=0;
	public static int nb_test_ko=0;


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
			Assert.assertEquals("KO" , expected, m.getAmount(),0);
			System.out.println("getAmount :\n 	attendu : " + expected +"\n 	resultat : " + m.getAmount());
			
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getAmount : OK":"	getAmount : KO");
	}

	@Test
	public void testgetAmount2(){
		float expected = 2.45F;

		try{
			nb_test_ok++;
			Assert.assertEquals("KO" , expected, m2.getAmount(),0);
			System.out.println("getAmount :\n 	attendu : " + expected +"\n 	resultat : " + m2.getAmount());
			
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getAmount : OK":"	getAmount : KO");
	}

	@Test
	public void testgetCurrency(){
		String expected = "EUR";

		
		try{		
			nb_test_ok++;
			Assert.assertEquals("KO" , expected, m.getCurrency());
			System.out.println("getCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m.getCurrency());
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getCurrency : OK":"	getCurrency : KO");

	}

	@Test
	public void testgetCurrency2(){
		String expected = "USR";

		
		try{		
			nb_test_ok++;
			Assert.assertEquals("KO" , expected, m2.getCurrency());
			System.out.println("getCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m2.getCurrency());
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getCurrency : OK":"	getCurrency : KO");

	}

	@Test
	public void testcheckCurrency (){

		
		try{		
			nb_test_ok++;
			Assert.assertFalse(m.checkCurrency(m2));
			System.out.println("checkCurrency :\n 	attendu : " + m.checkCurrency(m2) +"\n 	resultat : " + m.checkCurrency(m2));
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");

	}

	@Test
	public void testcheckCurrency2 (){

		
		try{		
			nb_test_ok++;
			Assert.assertTrue(m.checkCurrency(m));
			System.out.println("checkCurrency :\n 	attendu : " + m.checkCurrency(m) +"\n 	resultat : " + m.checkCurrency(m));
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");

	}

	@Test
	public void testcheckCurrency3 (){
		String expected = "EUR";
		
		try{		
			nb_test_ok++;
			Assert.assertTrue(m.checkCurrency(expected));
			System.out.println("checkCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m.getCurrency());
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");

	}

	@Test
	public void testchangeCurrency (){
		float rate = 0.42F;
		String currency = "EUR";
		float amount= m.getAmount()*rate;
		
		try{		
			nb_test_ok++;
			m.changeCurrency(currency,rate);
			Assert.assertEquals("KO" , currency, m.getCurrency());
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("changeCurrency :\n 	attendu : (" + amount+","+currency +")\n 	resultat : (" + m.getAmount()+","+m.getCurrency()+")");
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			System.out.println(e);
			Assert.fail("fonction fail");
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	changeCurrency : OK":"	changeCurrency : KO");

	}
		


	public static void main (String [] arg)
	{
		Result result = JUnitCore.runClasses(MoneyTest.class);
      	
        System.out.println(result.getFailures());
        System.out.println(result.wasSuccessful());
        //System.out.println("Résultat: "+nb_test_ok+"/"+nb_test);
    }}