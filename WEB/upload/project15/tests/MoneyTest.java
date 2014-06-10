import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;
import java.util.*;


//Pour les tests parametriques/////////////////////
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





	public Money m = new Money();
	public Money m2 = new Money(2.45F,"USR");
	public Money m3 = new Money(-2.45F,"EUR");
	public static Runner runner;
	public static int nb_test_ok=0;
	public static int nb_test=0;
	public static int nb_test_ko=0;
	public static int nb_test_ok_getAmount=0, nb_test_ok_getCurrency=0, nb_test_ok_checkCurrency=0, nb_test_ok_changeCurrency=0, nb_test_ok_add=0, nb_test_ok_sub=0, nb_test_ok_tostring=0,status=0;
	public static Vector<Runner>  Runner=new Vector<Runner>();
	public String error;



	@Before
	public final void setUp() {
		nb_test++;
		nb_test_ok++;
		status=0;
		error="pas de problemes";
	}

	
	
	@Test
	public void testgetAmount(){
		float expected = 0F;
		nb_test_ok_getAmount++;
		try{
			Assert.assertEquals("KO" , expected, m.getAmount(),0);
			System.out.println("getAmount :\n 	attendu : " + expected +"\n 	resultat : " + m.getAmount());
			status=1;
			
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_getAmount--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getAmount : OK":"	getAmount : KO");
		String expectedstring = Float.toString(expected);
		runner= new Runner("getAmount",2,expectedstring,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testgetAmount2(){
		float expected = 2.45F;
		nb_test_ok_getAmount++;

		try{
			Assert.assertEquals("KO" , expected, m2.getAmount(),0);
			System.out.println("getAmount :\n 	attendu : " + expected +"\n 	resultat : " + m2.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			nb_test_ok_getAmount--;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getAmount : OK":"	getAmount : KO");
		String expectedstring = Float.toString(expected);
		runner= new Runner("getAmount",2,expectedstring,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testgetCurrency(){
		String expected = "EUR";
		nb_test_ok_getCurrency++;
		
		try{		
			Assert.assertEquals("KO" , expected, m.getCurrency());
			System.out.println("getCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m.getCurrency());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			nb_test_ok_getCurrency--;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getCurrency : OK":"	getCurrency : KO");
		runner= new Runner("getCurrency",2,expected,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testgetCurrency2(){
		String expected = "USR";
		nb_test_ok_getCurrency++;
		
		try{		
			Assert.assertEquals("KO" , expected, m2.getCurrency());
			System.out.println("getCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m2.getCurrency());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_getCurrency--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	getCurrency : OK":"	getCurrency : KO");
		runner= new Runner("getCurrency",2,expected,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testcheckCurrency (){
		nb_test_ok_checkCurrency++;
		
		try{		
			Assert.assertFalse(m.checkCurrency(m2));
			System.out.println("checkCurrency :\n 	attendu : " + m.checkCurrency(m2) +"\n 	resultat : " + m.checkCurrency(m2));
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ko++;
			nb_test_ok_checkCurrency--;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");
		runner= new Runner("checkCurrency",3,"USR",status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testcheckCurrency2 (){
		nb_test_ok_checkCurrency++;
		
		try{		
			Assert.assertTrue(m.checkCurrency(m));
			System.out.println("checkCurrency :\n 	attendu : " + m.checkCurrency(m) +"\n 	resultat : " + m.checkCurrency(m));
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_checkCurrency--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");
		runner= new Runner("checkCurrency",2,"EUR",status,error,3F);
		Runner.add(runner);
	}

	// @Test
	// public void testcheckCurrency3 (){
	// 	String expected = "EUR";
	// 	nb_test_ok_checkCurrency++;
	// 	try{		
	// 		Assert.assertTrue(m.checkCurrency(expected));
	// 		System.out.println("checkCurrency :\n 	attendu : " + expected +"\n 	resultat : " + m.getCurrency());
	// 		status=1;
	// 	}
	// 	catch (AssertionError e) {
	// 		nb_test_ok--;
	// 		nb_test_ko++;
	// 		nb_test_ok_checkCurrency--;
	// 		System.out.println(e);
	// 		error= e.toString();
	// 	}
	// 	System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	checkCurrency : OK":"	checkCurrency : KO");
	// 	runner= new Runner("checkCurrency",3,expected,status,error,3F);
	// 	Runner.add(runner);
	// }

	@Test
	public void testchangeCurrency (){
		float rate = 0.42F;
		String currency = "EUR";
		float amount= m.getAmount()*rate;
		nb_test_ok_changeCurrency++;
		try{

			m.changeCurrency(currency,rate);
			System.out.println("changeCurrency :\n 	attendu : (" + amount+","+currency +")\n 	resultat : (" + m.getAmount()+","+m.getCurrency()+")");
			status=1;		
			Assert.assertEquals("KO" , currency, m.getCurrency());
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_changeCurrency--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	changeCurrency : OK":"	changeCurrency : KO");
		runner= new Runner("changeCurrency",1,"(0.0,EUR)",status,error,3F);
		Runner.add(runner);

	}
		

    @Test
	public void testadd (){
		float add = 1.23F;
		float amount= m.getAmount();
		nb_test_ok_add++;
		
		try{		
			m.add(add);
			amount +=add;
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("add :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_add--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	add : OK":"	add : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("add",4,expectedstring,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testadd2(){
		float add = -1.23F;
		float amount= m.getAmount();
		nb_test_ok_add++;
		try{		
			m.add(add);
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("add :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_add--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	add : OK":"	add : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("add",4,expectedstring,status,error,3F);
		Runner.add(runner);
	}


	@Test
	public void testadd3(){
		m2.changeCurrency("EUR",1F);
		float amount= m.getAmount()+ m2.getAmount();
		nb_test_ok_add++;
		try{		
			m.add(m2);
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("add :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_add--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	add : OK":"	add : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("add",3,expectedstring,status,error,3F);
		Runner.add(runner);

	}

	// @Test
	// public void testadd4(){
	// 	m2.changeCurrency("EUR",1F);
	// 	float amount= m2.getAmount();
	// 	nb_test_ok_add++;
	// 	try{		
	// 		m2.add(m3);
	// 		Assert.assertEquals("KO" , amount, m2.getAmount(),0);
	// 		System.out.println("add :\n 	attendu : " + amount+"\n 	resultat : " + m2.getAmount());
	// 		status=1;
	// 	}
	// 	catch (AssertionError e) {
	// 		nb_test_ok--;
	// 		nb_test_ok_add--;
	// 		nb_test_ko++;
	// 		System.out.println(e);
	// 		error= e.toString();
	// 	}
	// 	System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	add : OK":"	add : KO");
	// 	String expectedstring = Float.toString(amount);
	// 	runner= new Runner("add",4,expectedstring,status,error,3F);
	// 	Runner.add(runner);

	// }









	@Test
	public void testsub(){
		float sub = -1.23F;
		float amount= 0F;
		nb_test_ok_sub++;
		try{		
			m.sub(sub);
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("sub :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_sub--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	sub : OK":"	sub : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("sub",4,expectedstring,status,error,3F);
		Runner.add(runner);

	}

	@Test
	public void testsub2(){
		float sub = 1.23F;
		float amount= m.getAmount()-sub;
		nb_test_ok_sub++;
		try{		
			m.sub(sub);
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("sub :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_sub--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	sub : OK":"	sub : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("sub",4,expectedstring,status,error,3F);
		Runner.add(runner);
	}

	@Test
	public void testsub3(){
		m2.changeCurrency("EUR",1F);
		float amount= m.getAmount() - m2.getAmount();
		nb_test_ok_sub++;
		try{		
			m.sub(m2);
			Assert.assertEquals("KO" , amount, m.getAmount(),0);
			System.out.println("sub :\n 	attendu : " + amount+"\n 	resultat : " + m.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_sub--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	sub : OK":"	sub : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("sub",4,expectedstring,status,error,3F);
		Runner.add(runner);
	}

	@Test
	public void testsub4(){
		m2.changeCurrency("EUR",1F);
		float amount= m2.getAmount();
		nb_test_ok_sub++;
		try{		
			m2.sub(m3);
			Assert.assertEquals("KO" , amount, m2.getAmount(),0);
			System.out.println("sub :\n 	attendu : " + amount+"\n 	resultat : " + m2.getAmount());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_sub--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	sub : OK":"	sub : KO");
		String expectedstring = Float.toString(amount);
		runner= new Runner("sub",4,expectedstring,status,error,3F);
		Runner.add(runner);
	}

	@Test
	public void testtoString(){
		nb_test_ok_tostring++;
		String expected = m.getAmount() +" "+m.getCurrency();
		try{		
			
			Assert.assertEquals("KO" , expected , m.toString());
			System.out.println("toString :\n 	attendu : " + expected+"\n 	resultat : " + m.toString());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_tostring--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	toString : OK":"	toString : KO");
		runner= new Runner("toString",2,expected,status,error,2F);
		Runner.add(runner);
	}

	@Test
	public void testtoString2(){
		nb_test_ok_tostring++;
		String expected = m3.getAmount() +" "+m3.getCurrency();
		try{		
			Assert.assertEquals("KO" , expected , m3.toString());
			System.out.println("toString :\n 	attendu : " + expected+"\n 	resultat : " + m3.toString());
			status=1;
		}
		catch (AssertionError e) {
			nb_test_ok--;
			nb_test_ok_tostring--;
			nb_test_ko++;
			System.out.println(e);
			error= e.toString();
		}
		System.out.println((nb_test_ok==(nb_test-nb_test_ko))?"	toString : OK":"	toString : KO");
		runner= new Runner("toString",2,expected,status,error,2F);
		Runner.add(runner);
	}

	@AfterClass
	public static void logout(){
		System.out.println("getAmount:"+nb_test_ok_getAmount+"/2");
		System.out.println("getCurrency:"+nb_test_ok_getCurrency+"/2");
		System.out.println("checkCurrency:"+nb_test_ok_checkCurrency+"/3");
		System.out.println("changeCurrency:"+nb_test_ok_changeCurrency+"/1");
		System.out.println("add:"+nb_test_ok_add+"/4");
		System.out.println("sub:"+nb_test_ok_sub+"/4");
		System.out.println("toString:"+nb_test_ok_tostring+"/2");
		System.out.println("Resultat: "+nb_test_ok+"/"+nb_test);
		runner.back_vector(Runner);
	}




	// public static void main (String [] arg)
	// {
	// 	Result result = JUnitCore.runClasses(MoneyTest.class);
      	
 //        // System.out.println(result.wasSuccessful());

 //        System.out.println("Resultat: "+nb_test_ok+"/"+nb_test);

 //    }
}