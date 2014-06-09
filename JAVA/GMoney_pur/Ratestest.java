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
	retour = new String("getDataFromInternet;1/null;"+rates.getDataFromInternet()+"/");
		try{
		 Assert.assertTrue(rate.getDataFromInternet());
		 status=1;
		}
		catch (AssertionError e) {
		error= e.toString();
		}
		runner= new Runner("getDataFromInternet",1,"True",status,error,3F);
	}


}