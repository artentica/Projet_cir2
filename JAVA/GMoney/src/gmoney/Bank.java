package gmoney;
/**
 *
 * @author miton
 */
public class Bank {
    
    private  Rates   rates;
    private  static Money   money;
    
    Bank ()
    {
	rates = new Rates();
	money = new Money();
    }
    
    public void addMoney ( Money m )
    {
	
    }
    public void subMoney ( Money m )
    {
	
    }
    @Override
    public String toString ()
    {
	return "";
    }
    
    public static void main ( String [] arg )
    {
	System.out.println("Demarrage du programme");
	
	money = new Money( (float) 1.0, "USD" );
	money.add( (float) 50 );
	System.out.println( money.toString() );
	
	System.out.println("Fin du programme");
    }
}
