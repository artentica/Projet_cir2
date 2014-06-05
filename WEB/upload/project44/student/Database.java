import java.sql.* ;

public class Database {

	//CONFIG
	String Host 	=	"localhost" 		;
	String DB_name  =	"administrateur" 	;
	String User 	=	"administrateur"	;
	String Pass 	=	"adminadmin"		;

	Connection conn;

	public Database(){
		conn = newConnection;
	}

	public Connection newConnection() throws SQLException {
    	
    	final String url = "jdbc:mysql://" + this.Host + "/" + this.DB_name ;
    	conn = DriverManager.getConnection( url, User, Pass );
	}

	public void select(String req ) throws SQLException {
	    try {
	        // create new connection and statement
	        conn = newConnection();
	        Statement st = conn.createStatement();

	        ResultSet rs = st.executeQuery( req );

	        while ( rs.next() ) {
	            System.out.printf("%-20s | %-20s | %3d\n", //
	                    rs.getString(1), rs.getString(2), rs.getInt(3));
	        }
	    } finally {
	        // close result, statement and connection
	        if (conn != null) conn.close();
	    }
	}

	public insert( String req ){
		Statement st = conn.createStatement();

		int nb = st.executeUpdate( req );

		System.out.println(nb + " ligne(s) insérée(s)");
		st.close();
	}

	public update( String req ){
		Statement st = conn.createStatement();

		int nb = st.executeUpdate( req );
	}
}