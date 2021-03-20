package client;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.InetAddress;
import java.net.Socket;
import java.net.SocketException;
import java.net.UnknownHostException;

import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

public class Client {
	/**
	 * This the class who simulate the Self Check Out Machine 
	 * @author De Carvalho Edson
	 * 
	 */
	private static String command=null;
	private static Socket socket;
	private static Boolean start=false;
	private static Boolean finish=false;
	private static PrintWriter out;
	private static String newIP="";
	private static int newPort=0;
	public static BufferedReader keyboard =new BufferedReader(new InputStreamReader(System.in));
	private static Logger logger = LoggerUtility.getLogger(Client.class, "text");
	
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
			System.out.println("[||-->CLIENT<--||]>>>>>| The format of the IP it's not \n"
					+ "allowed . Try again please \n" );
			logger.error("The format of the IP it's not allowed");
		}
		return false;
	}
	public static Boolean verificationNewPort(String command) {
		try {
			int newPort = Integer.parseInt(command);
			if((newPort< 1023)  || (newPort>10000) || (newPort==0)) {
				return false;
			}
			else {
				return true;
			}
		}catch(NumberFormatException e) {
			logger.error("The format of the port it's not allowed");
			return false;
		}
	}
	/**
	 * This class is to paremeter the connection whith the server
	 * @throws IOException
	 */
	public  static void entryConnectionParameters() throws IOException {
		Boolean step1=false;
		Boolean step2=false;
		while(!step1 & !step2) {
			command=null;
			while(!step1) {
				System.out.println("[||-->CLIENT<--||]>>>>>| Configure a new port : \n" );
				command = keyboard.readLine();
				if(command!=null && verificationNewPort(command)) {
					step1=true;
					newPort=Integer.parseInt(command);
					
				}
				else {
					System.out.println("[||-->CLIENT<--||]>>>>>| The modification of the  IP address it's field \n"
					+ " Try again please \n" );
				}
			}
			command=null;
			while(!step2) {
				System.out.println("[||-->CLIENT<--||]>>>>>| Configure a new IP Server : \n" );
				command = keyboard.readLine();
				if(command!=null && verificationIP(command)) {
					step2=true;
					newIP=command;
				}
				else {
					System.out.println("[||-->CLIENT<--||]>>>>>| The format of the IP it's not \n"
					+ "allowed . Try again please \n" );
				}
			}
		
		}
	
	}
	
	public static void lunchConnection() throws IOException {
		command = keyboard.readLine();
		if(command!=null) {
		switch(command) {
			case "no" :
				command=null;
				try {
					socket = new Socket(TCPparameters.SERVER_IP, TCPparameters.SERVER_PORT);
					//socket.setSoTimeout(TCPparameters.TIME_OUT_CLIENT);
					logger.info("Correct connection with th server");
					start=true;
				}catch(IOException e) {
					System.out.println("\n");
					System.out.println("[||-->CLIENT<--||]>>>>>|  Wrong connection parameters \n"
					 		+ "in port ("+ TCPparameters.PORT+") or IP ("+ TCPparameters.SERVER_IP+") \n"
					 		+ "or the server it's not connected \n");
					logger.error("Can't connect whith the server");
					 start=false;
				}
				if(!start) {
					System.out.println("[||-->CLIENT<--||]>>>>>| Do you want to configure a new connection \n"
							+ "or try again ? \n"
							+"ANSWER: 'yes' or 'no' \n");
					command=null;
					lunchConnection();
				}
				command=null;
				break;
			case "yes" :
				command=null;
				entryConnectionParameters();
				try {
					start=true;
					socket = new Socket(newIP,newPort);
					//socket.setSoTimeout(TCPparameters.TIME_OUT_CLIENT);
					logger.info("Correct connection with th server");
				}catch(IOException e) {
					 System.out.println("\n");
					 System.out.println("[||-->CLIENT<--||]>>>>>|  Wrong connection parameters \n"
					 		+ "in port ("+newPort+") or IP ("+newIP+") \n"
					 		+ "or the server it's not connected \n");
					 logger.error("Can't connect whith the server");
					 start=false;
				}
				if(!start) {
					System.out.println("[||-->CLIENT<--||]>>>>>| Do you want to configure a new connection \n"
							+ "or try again ? \n"
							+"ANSWER: 'yes' or 'no' \n");
					lunchConnection();
					command=null;
				}
				break;
			default:
				System.out.println("[||-->CLIENT<--||]>>>>>| ERROR That type of answer format it's not allowed. \n"
						+ " Please try again \n" );
				command=null;
				lunchConnection();
				break;
			}
		}
	}

	
	public static void main(String[] args) throws UnknownHostException, IOException {
		int i=0;
		//Launch of connection to server
		System.out.println("\n");
		System.out.println("[||-->CLIENT<--||]>>>>>| Welcome! I am a self check out machine  :) \n");
		System.out.println("[||-->CLIENT<--||]>>>>>| The the default connection is : Port : 9060 and IP : 127.0.0.1");
		System.out.println("[||-->CLIENT<--||]>>>>>| Do you want to configure a new connection configuation ? \n"
				+ "ANSWER: 'yes' or 'no' \n");
		lunchConnection();		
		if(start) {
			logger.info("The connection OK");
			System.out.println("[||-->CLIENT<--||]>>>>>| The connection with the server it's OK");
			System.out.println("The current connection is whith the server it's : Port : "+socket.getPort()+" and IP : "+socket.getInetAddress());
			System.out.println("[||-->CLIENT<--||]>>>>>| To start a new order whrite 'start order' and to finish \n"
					+ "              the order whrite 'finish the order'");
			MultiClient serverConnection =new MultiClient(socket);
			out = new PrintWriter(socket.getOutputStream(),true);
			new Thread(serverConnection).start();
		}
		while(start) {
			if(command!=null) {				
				if(command.equals("quit")) {
					break;
				}
				else {
					if(i>=1) {
						if(command!=null) {
							out.println(command);
							logger.info("Sending to the server - [ "+command+" ]");
						}
					}
				}
			}
			command = keyboard.readLine();
			if(command.equals("shutdown")) {
				try {
				
				out.close();
				socket.shutdownInput();
				socket.shutdownOutput();
				socket.close();
				System.exit(0);
				}catch(SocketException e) {
					System.out.println("Client Shutdown");
				}
			}
			i++;
		}
		if(finish) {
			try {
				out.close();
				socket.shutdownInput();
				socket.shutdownOutput();
				System.exit(0);
			}catch(SocketException e) {
				System.out.println("Client Shutdown");
			}
		}
	}
}