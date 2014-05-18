package gmoney;
/**
 *  Classe permetant de gerer les objets de type bank, contient le MAIN
 * @author miton artentica
 * @version 1.0
 */
public class Bank {
    
    private  Rates   rates;
    private  static Money   money;
    
    Bank ()
    {
	rates = new Rates();
	money = new Money();
    }
    /**
     * Ajoute une nouvelle Money
     * @param m
     *	    Money a ajouter
     */
    public void addMoney ( Money m )
    {
	
    }
    /**
     * Enleve une money
     * @param m 
     *	    Money a enlever
     */
    public void subMoney ( Money m )
    {
	
    }
    /**
     *	Transforme en chaine de caractere
     * @return String chaine de caractere contenant les infos
     */
    @Override
    public String toString ()
    {
	return "";
    }
    
    /**
     * Fonction main
     * @param arg 
     *	    parametre par defaut
     */
    public static void main ( String [] arg )
    {
	System.out.println("Demarrage du programme");
	
	money = new Money( (float) 1.0, "USD" );
	money.add( (float) 50 );
	System.out.println( money.toString() );
	
	System.out.println("Fin du programme");
    }
}
