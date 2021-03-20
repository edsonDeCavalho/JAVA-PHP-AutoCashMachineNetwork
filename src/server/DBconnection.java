package server;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

import org.apache.log4j.Logger;

public class DBconnection {
	private String query;
	private ResultSet rs=null;
	private static Logger logger = LoggerUtility.getLogger(DBconnection.class, "text");
	
	public DBconnection() {
		this.query="";
	}

	 public void get_connection() {
	        Connection connection;
	        try {
	            Class.forName("org.postgresql.Driver");
	            connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
	        } catch (Exception e) {
	            e.printStackTrace();
	        }
	  }
	 public int getNextNuberOfOrder() {
		  	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT COUNT(*) FROM facture;";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					int r=Integer.parseInt(ligne);
					r++;
					return r;
				}
				
			}catch(Exception e) {
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR POINTS OF CUSTOMER DONT FIND!");
			}
	    	try {
				rs.close();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			try {
				statemment.close();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			try {
				connection.close();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			return 0;
			
	 }
	
	 public Float getPromoNewPrice(String no_promo) throws SQLException {
		  	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT new_price FROM promo WHERE no_promo='"+no_promo+"';";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					Float r=Float.parseFloat(ligne);
					logger.info("Getting the new price of the article ");
					
					return r;
				}
				
			}catch(Exception e) {
				logger.error("ERROR POINTS OF CUSTOMER DONT FIND!");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR POINTS OF CUSTOMER DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    
			return null; 
	 }
	 public String getPromoNumber(String no_article) throws SQLException {
		  	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT promo FROM articles WHERE no_article='"+no_article+"';";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					logger.info("Getting the promo of the article :"+no_article);
					return ligne;
				}
				
			}catch(Exception e) {
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR Cat't get the promo of the artcicle"+no_article);
				logger.error("Can't get the promo of the article :"+no_article);
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    
			return null; 
	 }
	 
	 public Boolean verificationOfPromo(String no_article) throws SQLException {
		  	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT in_promo FROM articles WHERE no_article='"+no_article+"' ;";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					if(ligne.equals("t")) {
						return true;	
					}
				}
			}catch(Exception e) {
				logger.error("ERROR  TO KNOW If THE ARTICLE IT'S IN PROMO OF ARTICLE DONT FIND");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR INPROMO OF ARTICLE DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    
			return false; 
	 }
	 
	 
	 public String getArticleName(String no_article) throws SQLException {
		  	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT name_a FROM articles WHERE no_article='"+no_article+"';";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					logger.info("Name of the article : "+ligne);
					return ligne;
				}
				
			}catch(Exception e) {
				logger.error("ERROR NAME OF CUSTOMER DONT FIND");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR GETING TH OF NAME OF THE ARTICLE DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    
			return null; 
	 }	
	 public Boolean verrificationOfExistenceFidelityCard(String fidelityCard) throws SQLException {
		 Connection connection = null;
		 Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
	    		String query="SELECT number_of_card FROM customer";;
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {

					String ligne = rs.getString(1);
					String [] words1 = ligne.split(" ");
					if(words1[0].equals(fidelityCard)) {
						logger.info("The card "+fidelityCard+" it's correct" );
						rs.close();
						statemment.close();
						connection.close();
						return true;
					}
				}
			}catch(Exception e) {
				logger.error("The card "+fidelityCard+" it's correct");
				System.out.println("[||-->SERVER<--||]>>>>>| Erreur de la requete de verification de une carte de fidelity");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    	return false;
	 }
	 public boolean verificationOfExistenceArticle(String id_article) throws SQLException {
	    Connection connection = null;
	    Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
	    		String query="SELECT * FROM articles WHERE no_article ='"+id_article+"';";
	    		statemment=connection.createStatement();
				//lancement de la roquete
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					String [] words1 = ligne.split(" ");
					if(words1[0].equals(id_article)) {
						logger.info("The article "+id_article+" it's correct");
						rs.close();
						statemment.close();
						connection.close();
						return true;
					}
				}
			}catch(Exception e) {
				logger.error("The article "+id_article+" it's not correct");
				System.out.println("[||-->SERVER<--||]>>>>>| Erreur de la requete de verification de Article");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    	return false;
	    }
	    
	    public String getIdCustomer(String number_of_card) throws SQLException {
	    	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
	    		String query="SELECT no_customer FROM customer WHERE number_of_card='"+number_of_card+"';";
	    		statemment=connection.createStatement();
				//lancement de la roquete
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					rs.close();
					statemment.close();
					connection.close();
					logger.info("Getting the customer whith the number of card "+number_of_card+" ");
					return ligne;
				}
			}catch(Exception e) {
				logger.error("The customer whith the number of card "+number_of_card+" it's not find");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR CUSTOMER DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    	return null;
	    }
	    
	    
	    public void creationOfOrder(Order order) throws SQLException {
	    	Connection connection=null;
			Statement statemment=null;
			connection=connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
			try {
				String query="insert into facture (no_facture, payement_methode, date_facture, total_price  , no_customer) values ("+order.getId_order()+",'"+order.getPayment_method()+"','"+order.getDate()+"',"+order.getTotal_price()+","+order.getCustomer()+")";
				statemment=connection.createStatement();
				statemment.executeUpdate(query);
				System.out.println("[||-->SERVER<--||]>>>>>| Insertion in the factures table Done!");
				rs.close();
				statemment.close();
				connection.close();
			}catch(Exception e) {
				e.printStackTrace();
			}	
	    }
	    
	    public Float getPriceOfArticle(String no_article) throws SQLException {
	    	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
	    		String query="SELECT price FROM articles WHERE no_article='"+no_article+"'";
	    		statemment=connection.createStatement();
	    		rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					rs.close();
					statemment.close();
					connection.close();
					logger.info("Getting the price of the article "+no_article+" ");
					Float r=Float.parseFloat(ligne);
					return r;
				}
				
			}catch(Exception e) {
				logger.error("Can't get the price of the article "+no_article+" ");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR PRICE OF ARTICLE DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
	    	return null;
	    }
	    
	    public int getPoints(String no_customer) throws SQLException {
	    	Connection connection = null;
	    	Statement statemment=null;
	    	try {
	    		Class.forName("org.postgresql.Driver");
	    		connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="SELECT points FROM customer WHERE no_customer="+no_customer+"";
	    		statemment=connection.createStatement();
				rs=statemment.executeQuery(query);
				while(rs.next()) {
					String ligne = rs.getString(1);
					int points = Integer.parseInt(ligne);
					rs.close();
					statemment.close();
					connection.close();
					logger.info("Geting the points of the custmer : "+no_customer+" ");
					return points;
				}
				
			}catch(Exception e) {
				logger.error("Can't get the points of the custmer : "+no_customer+" ");
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR POINTS OF CUSTOMER DONT FIND!");
			}
	    	rs.close();
			statemment.close();
			connection.close();
			return 0;
	    }
	    
	    public void creationOfContain(Order order) throws SQLException {
	    	Connection connection=null;
			Statement statemment=null;
			connection=connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
			try {
				
				for(int i=0;i<order.getArticles().size();i++) {
					String query="insert into contain (no_artic, code_factu) values ("+order.getArticles().get(i)+","+order.getId_order()+");";
				statemment=connection.createStatement();
				statemment.executeUpdate(query);
				}
				rs.close();
				statemment.close();
				connection.close();
				logger.info("Insertion in the table contain");
				System.out.println("[||-->SERVER<--||]>>>>>| Insertion in the contain table Done!");
			
			}catch(Exception e) {
				logger.error("Can't Insert in the table contain");
			}
			rs.close();
			statemment.close();
			connection.close();
	    }
	    
	    public void updatePoints(Order order) {
	    	Connection connection=null;
			Statement statemment=null;
			try {
				connection=connection = DriverManager.getConnection("jdbc:postgresql://"+ DBparameters.HOST+":"+ DBparameters.PORT+"/"+ DBparameters.BD_NAME+"", ""+ DBparameters.USERNAME+"", ""+ DBparameters.PASSWORD+"");
				String query="UPDATE customer SET points="+order.getNewPoints()+" WHERE no_customer="+order.getCustomer()+";";
				statemment=connection.createStatement();
				statemment.executeUpdate(query);
				System.out.println("[||-->SERVER<--||]>>>>>| The points of the customer have beeen update.");
				logger.info("The points of the customer "+order.getCustomer()+" have beeen update");
				rs.close();
				statemment.close();
				connection.close();
			}catch(Exception e) {
				logger.error("Can't Update the points of the customer "+order.getCustomer());
			}	
	    }
	    
	    public void calculateNewPoints(Order order) throws SQLException {
	    	int newpoints=(order.getArticles().size())*2;
	    	int oldPoints=getPoints(order.getCustomer());
	    	newpoints+=oldPoints;
	    	order.setNewPoints(newpoints);
	    	logger.info("The new Points of the customer"+order.getCustomer()+" is "+order.getNewPoints());
	    }
	    
	    public void caculatePrice(Order order) throws NumberFormatException, SQLException {
	    	Float priceArticle;
	    	Float totalprice = null;
	    	for(int i=0;i<order.getArticles().size();i++) {
	    		priceArticle=getPriceOfArticle(order.getArticles().get(i));
	    		totalprice=totalprice+priceArticle;
	    	}
	    	order.setTotal_price(totalprice);
	    	logger.info("The total price is "+order.getTotal_price()+" €");
	    }
}	    

