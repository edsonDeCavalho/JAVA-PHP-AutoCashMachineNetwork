package server;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.net.SocketException;
import java.sql.SQLException;
import java.util.ArrayList;

import org.apache.log4j.Logger;

public class MultiServer implements Runnable {
	
	private Socket client;
	private BufferedReader in;
	private PrintWriter out;
	private ArrayList<MultiServer> clients;
	private Boolean stop;
	private String request;
	private Order order;
	private DBconnection databaseConnection;
	private Boolean therd=true;
	private Boolean fouth=true;
	private Boolean fifth=true;
	private Boolean sixth=true;
	private Boolean seventh=true;
	private static Logger logger = LoggerUtility.getLogger(MultiServer.class, "text");
	
	public MultiServer(Socket clientSocket,ArrayList<MultiServer> clients,int number_of_order) throws IOException {
		this.client = clientSocket;
		this.clients = clients;
		in = new BufferedReader(new InputStreamReader(client.getInputStream()));
		out = new PrintWriter(client.getOutputStream(),true);
		this.stop=true;
		databaseConnection=new DBconnection();
		order=new Order();
		order.setId_order(databaseConnection.getNextNuberOfOrder());
	}
	
	@Override
	public void run() {
		try {
			start();
		}catch( IOException | SQLException e) {
			System.err.println(e.getSuppressed());
		}finally {
			System.out.println("[||-->SERVER<--||]>>>>>| Fermeture Serveur.");
			out.close();
			try {
				in.close();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		
	}
	
	public void start() throws IOException, SQLException {
		therd=true;
		fouth=true;
		fifth=true;
		sixth=true;
		seventh=true;
		while(stop) {
			 request = in.readLine();
			 	if(request!=null) {
			 	switch (request) {
		            case "start order" : 
		            	logger.info("Starting the Order");
		            	create_Order();
		            	break;
		            case "finish order" :
		            	out.println("Order finished before start");
		            	logger.info("Order finished before start");
		            	break;
		            case "shutdown" : 
		            	out.println("close");
		            	break;
		            default:  
		            	logger.error("ERROR the format in aswer");
		            	out.println("ERROR the format of your aswer it's not alowed.");
		           break;
		        }
			 }
		}
	}
	
	
	
	public void create_Order() throws IOException, SQLException {
		out.println("Scann your pruducts please.");
		//request = in.readLine();
		try {
		if(request!=null) {
		while(!request.equals("finish the order")) {
			request = in.readLine();
			if(request!=null) {
				if(databaseConnection.verificationOfExistenceArticle(request)) {
					if(databaseConnection.verificationOfPromo(request)) {
						logger.info("Existence of promo for the article :"+request);
						order.getArticles().add(request);
						out.println("Article name : "+databaseConnection.getArticleName(request)+" <|> Price : "+databaseConnection.getPromoNewPrice(databaseConnection.getPromoNumber(request)));
						order.addArticle(databaseConnection.getArticleName(request),databaseConnection.getPromoNewPrice(databaseConnection.getPromoNumber(request)));
						out.println("Article Added");
						System.out.println("[||-->SERVER<--||]>>>>>| The article : "+request+" has been added!");
					}
					else {
						logger.info("Not existence of promo for the article :"+request);
						order.getArticles().add(request);
						out.println("Article name : "+databaseConnection.getArticleName(request)+" <|> Price : "+databaseConnection.getPriceOfArticle(request));
						order.addArticle(databaseConnection.getArticleName(request),databaseConnection.getPriceOfArticle(request));
						out.println("Article Added");
						System.out.println("[||-->SERVER<--||]>>>>>| The article : "+request+" has been added!");
					}
				}
				else {
					if(request.equals("finish the order")) {
						break;
					}
					else {
						logger.error("Article not recognised");
						out.println("*******EROOR THE ARTCLE ITS NOT RECOGNAIZED*****");
					}
				}
			}
		}
		if(request.equals("finish the order")) {
			out.println("**********Order Finiched************");
			out.println("Your fidelity card : ");	
			while(therd) {
				request = in.readLine();
				if(!request.equals(null)) {
					if(databaseConnection.verrificationOfExistenceFidelityCard(request)) {
						order.setNum_card_c(request);
						order.setCustomer(databaseConnection.getIdCustomer(request));
						out.println("Fidelity Stored!");
						therd=false;
					}
					else {
						logger.error("Number of card not recognised");
						out.println("*******ERROR THE NUMBER OF THE CARD ITS NOT RECOGNAIZED*****");
					}
				}
			}
			order.calculateTotalPrice();
			logger.info("Total price calculated");
			out.println("This is the total price : "+order.getTotal_price());
			out.println("Corfirm the Order");
			out.println("ANSWER : 'yes' or 'no' ");
			while(fouth) {
				request = in.readLine();
				if(!request.equals(null)) {
					if(request.equals("yes")) {
						logger.info("Order confirmed by the client");
						fouth=false;
					}
					if(request.equals("no")) {
						logger.info("Order not confirmed by the client");
						start();
						fouth=false;
					}
				}
			}
			out.println("Order Confirmeded!");
			out.println("Payment Method :");
			out.println("ANSWER : 'cash' or 'credit_card' ");
			while(fifth) {
				request =in.readLine();
				if(!request.equals(null)) {
					if(request.equals("cash") || request.equals("credit_card")) {
						logger.info("Payment method :"+request);
						order.setPayment_method(request);
						fifth=false;
						logger.info("Starting insertions in data base");
						databaseConnection.creationOfOrder(order);
						databaseConnection.creationOfContain(order);
						databaseConnection.calculateNewPoints(order);
						databaseConnection.updatePoints(order);
						out.println(order.getPrintedFacture());
						out.println("\n Thanks for your purchase!!!");
						out.println("\n Goodbye and until next time!");
						fifth=false;
						order.setId_order(databaseConnection.getNextNuberOfOrder());
						out.println("<restart>");
						logger.info("Restarting the Operation");
						//out.println("close");
						//out.println("\n \n \n  Welcome! I am a self check out machine.");
						out.println("\n [||-->SERVER<--||]>>>>>|  To start a new order whrite 'start order' and to finish \n");
								//+" the order whrite 'finish the order' .");
						start();	
						//break;
					}
					else {
						logger.error("Type payment it's not autorizeded");
						out.println("\n \n [||-->SERVER<--||]>>>>>| The type of payment authorized is only 'cash' or 'credit_card'.");
					}
				}
			}
		  }
		}
		}catch(NullPointerException e) {
			System.out.println("The client it's discnnected");
		}
	}
	public void detectShutdown(String request) throws IOException {
		if(request.equals("shutdown")) {
			shutdown();
		}
	}
	
	public void shutdown() throws IOException {
		out.close();
		in.close();
		client.shutdownOutput();
		client.shutdownInput();
		client.close();
	}
	
	
	public Boolean clientRequestVerification(String request) {
		if((request==null) ||(request.length()==0) || request.length()>30) {
			System.out.println("Incorrect customer input (machine: "+order.getId_order());
			out.println("The type of payment authorized is only 'cash' or 'credit_card' ");
			return false;
		}
		else {
			return true;
		}
	}
	
	public Boolean getStop() {
		return stop;
	}

	public void setStop(Boolean stop) {
		this.stop = stop;
	}
}
