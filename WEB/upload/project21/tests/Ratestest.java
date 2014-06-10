import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.io.*;
import java.util.*;
import java.net.URL;
import java.net.URLConnection;


public class Ratestest{
	public static Runner runner;
	public static Vector<Runner>  Runner= new Vector<Runner>();
	public String error;
	public static int status;

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
		runner= new Runner("getDataFromInternet",1,"True",status,error,2F);
	}

	@Test public void testGetDataFromFile(){
		try{
		 Assert.assertTrue(rate.getDataFromFile("test_rate.xml"));
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		runner= new Runner("testGetDataFromFile",1,"True",status,error,2F);
	}

	@Test public void testgetRate(){
		float expected=0F;
		try{
		 Assert.assertNotSame(rate.getRate("USD"),expected);
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		String expectedstring = Float.toString(expected);
		runner= new Runner("getRate",1,expectedstring,status,error,1F);
	}


}