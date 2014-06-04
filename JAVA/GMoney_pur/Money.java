/**
 * Classe permetant de gerer les objets de type money
 * @author miton artentica
 * @version 1.0
 */
public class Money {
    
    private  float   amount;
    private  String  currency;

    Money ()
    {
        this.amount = 0;
        this.currency = "EUR";
    }
    
    /**
     * Constructeur avec paramètres
     * @param amount
     *	    montant initial de la money
     * @param currency 
     *	    nom de la money type "USD"
     */
    Money ( float amount, String currency )
    {
        
        this.amount = amount;
        this.currency = currency;
    }
    
    
    /**
     * Recupere le montant de la money
     * @return float montant de la money
     */
    public float getAmount ()
    {      return this.amount;         }
    
    /**
     * Recupère le nom de la money
     * @return String Nom de la money format "USD"
     */
    public String getCurrency ()
    {   return this.currency;       }
    
    /**
     * Verification du nom de la money
     * @param m
     *	    2em money a tester
     * @return boolean true si meme money false sinon
     */
    public boolean checkCurrency ( Money m )
    {
        return this.currency.equals( m.currency );
    }
    
    /**
     *	Verifie si les money sont les memes
     * @param m
     *	chaine de caractere a tester
     * @return boolean true si les chaines sont les memes false sinon
     */
    public boolean checkCurrency ( String m )
    {
        
        return this.currency.equals( m );
    }
    
    /**
     *	Permet de changer les parametres d'une money
     * @param s
     *	    nouveau String nom de la money
     * @param rate 
     *	    nouveau taux de change
     */
    public void changeCurrency ( String s, float rate )
    {
	
	this.currency = s;
	this.amount *= rate;
    }
    
    /**
     *	Ajouter un montant a une money
     * @param amount 
     *	montant a ajouter
     */
    public void add ( float amount )
    {	    if(amount>0) this.amount += amount;}
    
    /**
     * Retire un montant a une money
     * @param amount 
     *	montant a retirer
     */
    public void sub ( float amount )
    {	    if(amount>0)this.amount -= amount;}
    
    /**
     * Ajoute 2 money si elles ont la meme unitée
     * @param m 
     *	money a ajouter
     */
    public void add ( Money m )
    {
        
	if( this.checkCurrency( m.currency ) && m.amount>0){
	    this.amount += m.amount;
	}
    }
    
    /**
     *  Soustrait 2 money si elles ont la meme unitée
     * @param m 
     *	Unité a soustraire
     */
    public void sub ( Money m )
    {
        
	if( this.checkCurrency( m.currency ) && m.amount>0 ){
	    this.amount -= m.amount;
	}
    }
    
    /**
     * Convertis les infos de la money en chaine de caractère
     * @return String chaine contenant les infos de la money
     */
    @Override
    public String toString ()
    {
        
        return this.amount + " " + this.currency ;
    }
}
