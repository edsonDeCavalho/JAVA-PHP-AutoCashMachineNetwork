package server;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.InetAddress;
import java.net.ServerSocket;
import java.net.Socket;
import java.net.SocketTimeoutException;
import java.net.UnknownHostException;
import java.util.ArrayList;
import java.util.Date;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.ThreadPoolExecutor;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.jfree.util.StringUtils;

/**
 * This class is the server who cummuinicates with the clients
 * @author Edson De Carvalho
 * 
 */

public class Server {
	
	//private static final int PORT=9060;
	private static ArrayList<MultiServer> clients = new ArrayList<MultiServer>();
	private static ExecutorService pool =  Executors.newFixedThreadPool(TCPparameters.NUMBER_MAX_OF_CLIENTS);
	private static BufferedReader keyboard = new BufferedReader(new InputStreamReader(System.in));
	private static int number_of_order=303;
	private static ServerSocket listener;
	private static Boolean start=false;
	private static Boolean first=false;
	private static Boolean second=false;
	private static String command="";
	private static int newPort=0;
	private static InetAddress newIP=null;
	private static PrintWriter out;
	
	private static Logger logger = LoggerUtility.getLogger(Server.class, "text");
	
	
	/**
	 * This method it's to verifie the structure of 
	 * a Ip.
	 * @param ip
	 * @return
	 */
	public static boolean validIP (String ip) {
	    try {
	        if ( ip == null || ip.isEmpty() ) {
	            return false;
	        }

	        String[] parts = ip.split( "\\." );
	        if ( parts.length != 4 ) {
	            return false;
	        }

	        for ( String s : parts ) {
	            int i = Integer.parseInt( s );
	            if ( (i < 0) || (i > 255) ) {
	                return false;
	            }
	        }
	        if ( ip.endsWith(".") ) {
	            return false;
	        }

	        return true;
	    } catch (NumberFormatException nfe) {
	        return false;
	    }
	}
	/**
	 * This method it's to verifie if we can connectd whith the 
	 * IP adress
	 * a Ip.
	 * @param ip
	 * @return
	 */
	public static Boolean verificationIP(String ip) throws IOException  {
		
		if(validIP(ip)) {
			
			InetAddress geek = InetAddress.getByName(ip); 
		    System.out.println("Sending Ping Request to " + ip); 
		    if (geek.isReachable(5000)) {
		      System.out.println("Host is reachable");
		      logger.info("Host is reachable");
		      return true;
		    }
		    else {
		      System.out.println("Sorry ! We can't reach to this host"); 
		      logger.error("We can't reach to this host");
		      return false;
		    }
		}
		else {
			System.out.println("[||-->SERVER<--||]>>>>>| The format of the IP it's not \n"
					+ "allowed . Try again please \n" );
			logger.error("The format of the IP it's not allowed");
		}
		return false;
	}

	/**
	 * This method is used to detect input errors
	 * @param keyboard
	 * @return
	 */
	public static Boolean serverKeyboardVerification(String keyboard) {
		if((keyboard==null) || (keyboard.length()==0) || keyboard.length()>7) {
			return false;
		}
		else {
			return true;
		}
	}
	/**
	 * This method difines a new port
	 * @param void
	 * @throws IOException
	 * @return void
	 */
	public static void defenitionOfNewPort() throws IOException {
		System.out.println("[||-->SERVER<--||]>>>>>| Define a new connection port please : ");
		System.out.println("Port : ");
		while(first!=true){
			command = keyboard.readLine();
			if(command!=null && serverKeyboardVerification(command)) { 	
						newPort=Integer.parseInt(command);
						logger.info("Verification of new port sucssecefoul");
						first=true;
				}
				else {
					System.out.println("[||-->SERVER<--||]>>>>>| The format of the port is not valid,try again");
					logger.error("The format of the port is not valid");
					defenitionOfNewPort();
				}
			}
	 }
	
	public static void definitionOfNewIP() throws IOException {
		System.out.println("[||-->SERVER<--||]>>>>>| Define a new connection IP please : ");
		System.out.println("IP : ");
		while(second!=true){
			command=null;
			command = keyboard.readLine();
			if(command!=null && validIP(command) && verificationIP(command)) {
				logger.info("Verification of Ip sccecssfoul");
				newIP = InetAddress.getByName(command);
				logger.info("New Ip definided");
				second=true;
			}
			else {
				System.out.println("[||-->SERVER<--||]>>>>>| The format of the IP is not valid ,try again");
				logger.error("The format of the IP is not valid");
				definitionOfNewIP();
			}
		}
	}
	/**
	 * This method it's to lunch the connection with custom parameters
	 * @throws IOException
	 */
	public static void startWhitparameters() throws IOException {
			second=false;
			first=false;
		   try {
				 start=true;
	             listener =new ServerSocket(newPort,300,newIP);
	             //listener.setSoTimeout(TCPparameters.TIME_OUT_SERVER);
		   	} catch(IllegalArgumentException i) { 
		   		System.out.println("[||-->SERVER<--||]>>>>>| The input values are not valid");
		   		System.out.println("[||-->SERVER<--||]>>>>>| Try again please");
		   		logger.error("Failed connection because the input values are not valid");
		   		start=false;
	            start();
		   	} catch (IOException e) {
	            System.out.println("[||-->SERVER<--||]>>>>>| The port  "+newPort+" and Ip("+newIP+") is also already in used or not valiable!");
	            System.out.println("[||-->SERVER<--||]>>>>>| Try again please");
	            logger.error("Port and Ip alredy used");
	            start=false;
	            start();
	         }	
	}
	/**
	 * This method it's to lunch the connection with defaut parameters
	 * @throws IOException
	 */
	public static void startCustom() throws IOException {
		second=false;
		first=false;
		try {
			start=true;
            listener =new ServerSocket(TCPparameters.PORT,1000,InetAddress.getByName(TCPparameters.SERVER_IP));
            //listener.setSoTimeout(TCPparameters.TIME_OUT_SERVER);
        } catch (IOException e) {
           System.out.println("[||-->SERVER<--||]>>>>>| The port  "+ TCPparameters.PORT+" is already in used!");
           logger.error("Custom Start Failed");
           start=false;
           start();
        }	
	}
	/**
	 * This method it's to give the choice to configure the connection
	 * @throws IOException
	 */
		
	public static void start() throws IOException {
		System.out.println("The the default connection is : Port : 9060 and IP : 127.0.0.1");
		System.out.println("Do you want to configure a new connection configuation ? \n"
				+ "ANSWER: 'yes' or 'no' \n");
		command = keyboard.readLine();
		if(command!=null) {
		switch(command) {
			case "yes" :
				defenitionOfNewPort();
				definitionOfNewIP();
				logger.info("Custom Start");
				startWhitparameters();
				break;
			case "no" :
				logger.info("Normal Start");
				startCustom();
			 break;
			default :				
				System.out.println("[||-->SERVER<--||]>>>>>| ERROR That type of answer format it's not allowed. \n"
						+ " Please try again \n" );
			command=null;
			break;
		}
	  }
	}
	
	public static BufferedReader getKeyboard() {
		return keyboard;
	}
	public static void setKeyboard(BufferedReader keyboard) {
		Server.keyboard = keyboard;
	}
	/**
	 *	Server launch main (listen and execution of the new thread Client
	 */
	public static void main(String[] args) throws IOException {
		Logger logger = LoggerUtility.getLogger(Server.class, "text");
		BufferedReader keyboard = new BufferedReader(new InputStreamReader(System.in));
		String command = null; 
		System.out.println("[||-->SERVER<--||]>>>>>|  Welcome! I am a the Server! :) \n");
		start();
		while(start) {
			System.out.println("The current connection is : Port : "+listener.getLocalPort()+" and IP : "+listener.getLocalSocketAddress());
			System.out.println("[||-->SERVER<--||]>>>>>| The server it's running ");
			System.out.println("[||-->SERVER<--||]>>>>>| Waiting for a client... ");
			Socket client = listener.accept();
			logger.info("New client Accepted");
			//command = keyboard.readLine();
			if(client!=null) {
				System.out.println("[||-->SERVER<--||]>>>>>| Connection established whith a self check out machine \n");
				number_of_order++;
				MultiServer clientThread = 	new MultiServer(client,clients, number_of_order);
				clients.add(clientThread);
				logger.info("New client (self check out machine) added to the list of Clients");
				logger.info("Start of the new thread");
				pool.execute(clientThread);
			}	
		}
	}
}
