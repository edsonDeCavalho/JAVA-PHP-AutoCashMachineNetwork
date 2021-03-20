package client;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.net.SocketException;
import java.net.SocketTimeoutException;

import org.apache.log4j.Logger;

public class MultiClient implements Runnable{
	
	private Socket server;
	private BufferedReader in;
	private Boolean start=true;
	private Boolean affichage=false;
	private static Logger logger = LoggerUtility.getLogger(MultiClient.class, "text");
	
	public MultiClient(Socket s) throws IOException {
		server=s;
		in = new BufferedReader(new InputStreamReader(server.getInputStream()));
	}
	
	public void shutdown() throws IOException {
		try {
		start=false;
		in.close();
		server.shutdownInput();
		server.shutdownOutput();
		server.close();
		System.exit(0);
		}catch(SocketException e) {
			System.out.println("Shutdown and Deconnection");
		}
	}
	
	@Override
	public void run() {
			String serverReponse = null;
			try {
				while(start) {
					try {
					serverReponse = in.readLine();
					if(serverReponse.equals(null)) {
						System.out.println("Diawara");
					}
					}catch(NullPointerException e) {
						logger.info("The Server it's disconected");
						System.out.println("Deconcciton with the server");
					}catch(SocketException e) {
						logger.info("The Server it's disconected");
						System.out.println("Deconcciton with the server");
						shutdown();
					}catch(IOException e) {
						logger.info("The Server it's disconected");
						System.out.println("Deconcciton with the server");
					}
					if(serverReponse == null) {
						break;
					}
						switch (serverReponse) {
							case "close" :
								shutdown();
								break;
							case "finish2" :
								affichage=false;
								break;
							default:
								affichage=false;
								break;
						}
					if(serverReponse.equals("close")) {	
						
					}
					else {
						System.out.println("[||-->SERVER<--||]>>>>>| "+serverReponse+"\n");
					}
				}
				System.exit(0);

			} catch (SocketTimeoutException e) {
                System.out.println("[||-->CLIENT<--||]>>>>>| The connection time to the server is exhausted ! \n");
                System.out.println("[||-->CLIENT<--||]>>>>>| The comunication with the server it's closed ! \n");
                System.out.println("[||-->CLIENT<--||]>>>>>| Shutdown \n");
                try {
                	in.close();
				} catch (IOException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
                try {
                	server.shutdownInput();
                	server.shutdownOutput();
					server.close();
				} catch (IOException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
                System.exit(0); 
                start=false;
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}finally {
				try {
					in.close();
				} catch (IOException e) {
					// TODO Auto-generated catch block
					
				}
			}
		}
		
	
	
	

}
