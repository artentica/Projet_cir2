package gmoney;
/**
 *
 * @author miton
 */
public class Money {
    
    private  float   amount;
    private  String  currency;

    Money ()
    {
        
        this.amount = 0;
        this.currency = "EUR";
    }
    Money ( float amount, String currency )
    {
        
        this.amount = amount;
        this.currency = currency;
    }
    
    public float getAmount ()
    {      return this.amount;         }
    public String getCurrency ()
    {   return this.currency;       }
    public boolean checkCurrency ( Money m )
    {
        return ( this.currency.equals( m.currency ) ) ? true : false;
    }
    public boolean checkCurrency ( String m )
    {
        
        return ( this.currency.equals( m ) ) ? true : false ;
    }
    public void changeCurrency ( String s, float rate )
    {
	
	this.currency = s;
	this.amount *= rate;
    }
    public void add ( float amount )
    {	    this.amount += amount;	}
    public void sub ( float amount )
    {	    this.amount -= amount;	}
    public void add ( Money m )
    {
        
	if( this.checkCurrency( m.currency ) ){
	    this.amount += m.amount;
	}
    }
    public void sub ( Money m )
    {
        
	if( this.checkCurrency( m.currency ) ){
	    this.amount -= m.amount;
	}
    }
    @Override
    public String toString ()
    {
        
        return this.amount + " " + this.currency ;
    }
}
