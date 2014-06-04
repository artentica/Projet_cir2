import java.util.*;
import java.io.*;
import java.net.URL;
import java.net.URLConnection;
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

     if(!getDataFromInternet() && !getDataFromFile("test_rate.xml")){
        System.out.println("Erreur lors de l'accés au fichier et à internet, les rate n'ont pas pu être chargé");
        System.exit(1);
     }
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

        try{
         // Make a URL to the web page

            URL url = new URL("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

        // Get the input stream through URL Connection
            URLConnection con = url.openConnection();
            InputStream is =con.getInputStream();

        // Once you have the Input Stream, it's just plain old Java IO stuff.

        // For this case, since you are interested in getting plain-text web page
        // I'll use a reader and output the text content to System.out.

        // For binary content, it's better to directly read the bytes from stream and write
        // to the target file.


            BufferedReader br = new BufferedReader(new InputStreamReader(is));

            String line = null, currency="currency", rate="rate";


        // read each line and write to System.out

            while ((line = br.readLine()) != null) {
             if(line.indexOf( currency )!=-1 && line.indexOf( rate )!=-1){

                v_currencies.add(line.substring(19, 22));
                v_rates.add(Float.parseFloat(line.substring(30, 36)));
             }
            }
            return true;
        }
        catch(Exception e){
            return false;
        }
        
    }

    /**
     * Récupère les données d'un fichier
     * @param filename
     *	nom du fichier a charger
     * @return boolean true si le chargement a reussi false sinon
     */
    public boolean getDataFromFile ( String filename )
    {
        //lecture du fichier texte  
        try{
            InputStream ips=new FileInputStream(filename); 
            InputStreamReader ipsr=new InputStreamReader(ips);
            BufferedReader br=new BufferedReader(ipsr);
            String line = null, currency="currency", rate="rate";
            while ((line=br.readLine())!=null){
               if(line.indexOf( currency )!=-1 && line.indexOf( rate )!=-1){

                v_currencies.add(line.substring(19, 22));
                v_rates.add(Float.parseFloat(line.substring(30, 36)));
             }
            }
            br.close();
            return true;
        }       
        catch (Exception e){
            System.out.println(e.toString());
            return false;
        }
     
 }
}