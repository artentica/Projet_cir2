import java.util.Vector;
/**
 *  Classe Rates, permet de gerer les taux de changes
 * @author miton artentica
 */
public class Rates {
    
    private  Vector<String>  v_currencies;
    private  Vector<Float>   v_rates;
    
    Rates ()
    {
	v_currencies = new Vector<String>();
	v_rates = new Vector<Float>();
    }
    
    
    /**
     * Récupère le taux d'une money donnée
     * @param currency
     *	unitée souhaiter
     * @return float taux de la money demander	
     */
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
    
    /**
     * Récupère les taux + money d'internet
     * @return boolean true si tout c'est bien passer false sinon
     */
    public boolean getDataFromInternet ()
    {
	return true;
    }
    
    /**
     * Récupère les données d'un fichier
     * @param filename
     *	nom du fichier a charger
     * @return boolean true si le chargement a reussi false sinon
     */
    public boolean getDataFromFile ( String filename )
    {
	return true;
    }
}
