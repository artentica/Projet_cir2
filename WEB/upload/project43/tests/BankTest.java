import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;
import java.util.*;

public class BankTest {

	public Bank b1 = new Bank();
	public static Runner runner;

	public static int nb_test_ok=0;
	public static int nb_test=0;
	public static int nb_test_ko=0;
	public static int nb_test_ok_addMoney=0, 
					  nb_test_ok_subMoney=0, 
					  nb_test_ok_toString=0, 
					  status=0;
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
	public void testaddMoney(){
		nb_test_ok_addMoney ++;

		Money m1 = new Money(25F,"EUR");
		Float expected=25F;
		b1.addMoney( m1 );
		
		try{
			Assert.assertEquals(expected, b1.money.getAmount() ,0);	
			status = 1;
		}
		catch( AssertionError e ) {
			nb_test_ok 			--;
			nb_test_ok_addMoney --;
			nb_test_ko 			++;
			error = e.toString();
		}
		String expectedstring= Float.toString(expected);
		runner =new Runner("addMoney",1,expectedstring,status,error,2F);
		Runner.add(runner);
	}

	@Test
	public void testSubMoney(){
		nb_test_ok_subMoney ++;

		Money m1 = new Money(25F,"EUR");
		Money m2 = new Money(15F,"EUR");
		b1.addMoney( m1 );
		b1.subMoney( m2 );
		Float expected=10F;

		try{
			Assert.assertEquals(expected,b1.money.getAmount(),0);
			status = 1;
		}
		catch(AssertionError e) {
			nb_test_ok 		--;
			nb_test_ok_subMoney  --;
			nb_test_ko  	++;
			error= e.toString();
		}
		String expectedstring= Float.toString(expected);
		runner = new Runner("subMoney", 1,expectedstring,status,error,2F);
		Runner.add(runner);
	}

	@Test 
	public void testtoString(){
		nb_test_ok_toString ++;
		//Money m1 = new Money(25F,"EUR");
		String expected = b1.money.getAmount() +" "+b1.money.getCurrency();
		try{
			Assert.assertEquals("KO",expected,b1.toString());
			status = 1;
		}
		catch ( AssertionError e) {
			nb_test_ok--;
			nb_test_ok_toString--;
			nb_test_ko++;
			error= e.toString();
		}
		runner = new Runner("toStringBank",1,expected,status,error,1F);
		Runner.add(runner);
	}

	@AfterClass
	public static void logout(){
		System.out.println("getAmount:"+nb_test_ok_addMoney+"/2");
		System.out.println("getCurrency:"+nb_test_ok_subMoney+"/2");
		System.out.println("checkCurrency:"+nb_test_ok_toString+"/3");
		System.out.println("Resultat: "+nb_test_ok+"/"+nb_test);
		runner.back_vector(Runner);
	}
}