import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;
import java.util.*;
import java.net.URL;
import java.net.URLConnection;


public class RatesTest{
	public static Runner runner;
	public static Vector<Runner>  Runner=new Vector<Runner>();
	public String error;
	public Rates rate = new Rates();

	@Before
	public final void setUp() {
		status=0;
		error="pas de problemes";
	}

	@Test public void testGetDataFromInternet(){
		try{
		 Assert.assertTrue(rate.getDataFromInternet());
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		runner= new Runner("getDataFromInternet",1,"True",status,error,3F);
	}

	@Test public void testGetDataFromFile(){
		try{
		 Assert.assertTrue(rate.testGetDataFromFile());
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		runner= new Runner("testGetDataFromFile",1,"True",status,error,3F);
	}

	@Test public void testgetRate(){
		float expected=OF;
		try{
		 Assert.assertNotEqual(rate.getRate(),expected,0);
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		runner= new Runner("getRate",1,expected,status,error,3F);
	}


}