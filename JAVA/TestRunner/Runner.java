import org.junit.*;
import org.junit.Assert.*;
import org.junit.runner.*;
import java.util.*;
import java.io.*;
//Runner permet de lancer les tests des différentes classes et d'écrire le fichiers qui servira à l'ajout de valeur dans la bdd
public class Runner{

	private String name_fct, description,value_used;
	private int nb_fct_tested,status;
	private Float max_mark;
	public static Vector v2;
	//Création d'un objet runner qui contiendra les informations nécésssaire à l'ajout de la base de donné
	Runner (String name_fct,int nb_fct_tested, String value_used, int status, String description, Float max_mark)
	{
		this.name_fct=name_fct;
		this.nb_fct_tested=nb_fct_tested;
		this.value_used=value_used;
		this.status=status;
		this.description=description;
		this.max_mark=max_mark;
	}
	//back_vector permet de sauvegarder le vector créé dans le fichier de test pour l'utiliser ensuite dans le main
	public void back_vector(Vector<Runner> Runner){
		v2 = new Vector();
		this.v2.addAll(Runner);
	}
	//write file permet d'écrire le résultat des test dans un fichier qui se trouvera au même endroit que la classe testé
	public static void write_file (Vector<Runner> v2, String road)
	{               
		try {
			FileOutputStream ops=new FileOutputStream(road+"result.txt",true);
			PrintWriter pw=new PrintWriter(ops);
			for (int i=0; i<v2.size(); i++) {
				pw.print(v2.elementAt(i).name_fct);
				pw.print("/$/");
				pw.print(v2.elementAt(i).nb_fct_tested);
				pw.print("/$/");
				pw.print(v2.elementAt(i).value_used);
				pw.print("/$/");
				pw.print(v2.elementAt(i).status);
				pw.print("/$/");
				pw.print(v2.elementAt(i).description);
				pw.print("/$/");
				pw.println(v2.elementAt(i).max_mark);
			}
			pw.flush();
			pw.close();
		}
		catch (Exception e) {} 
	}
	//Dans le main nous lancons les test et lançons le programme qui écrira le fichier
	public static void main (String [] args)
	{
		String road= args[0];
		String file= args[1];
		try{
		Result result = JUnitCore.runClasses(Class.forName(args[1]));
		write_file(v2,road);
		}
		catch(Exception e){
			System.out.println(e);
		}
		
		  
		

	}
}