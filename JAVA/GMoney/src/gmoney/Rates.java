package gmoney;
import java.util.Vector;
/**
 *
 * @author miton
 */
public class Rates {
    
    private  Vector<String>  v_currencies;
    private  Vector<Float>   v_rates;
    
    Rates ()
    {
	v_currencies = new Vector<String>();
	v_rates = new Vector<Float>();
    }
    
    public float getRate ( String currency )
    {
	int i;
	for(i=0; i<v_currencies.size() ; i++)
	{
	    if( v_currencies.get(i).equals(currency) )
	    {
		return v_rates.get(i) ; 
	    }
	}
	return 0;
    }
    public boolean getDataFromInternet ()
    {
	return true;
    }
    public boolean getDataFromFile ( String filename )
    {
	return true;
    }
}
