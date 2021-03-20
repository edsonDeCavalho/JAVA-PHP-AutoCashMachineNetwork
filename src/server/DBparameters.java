package server;

/**
 * This class contains elementary Data Base Connection parameters.
 * 
 * @author De Carvalho Edson
 */
public class DBparameters {
	
	public static final String HOST= "127.0.0.1";

	public static final String PORT= "5432";
	
	public static final String BD_NAME= "projet2";
	
	public static final String USERNAME= "etu";
	
	public static final String PASSWORD="A123456*";

	
	public static String getHost() {
		return HOST;
	}

	public static String getPort() {
		return PORT;
	}

	public static String getBdName() {
		return BD_NAME;
	}

	public static String getUsername() {
		return USERNAME;
	}

	public static String getPassword() {
		return PASSWORD;
	}
	
	
}
