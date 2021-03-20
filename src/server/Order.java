package server;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;
import java.util.Map.Entry;

import org.apache.log4j.Logger;

public class Order {
	private int id_order;
	private String num_card_c;
	private String fidelity_card;
	private String payment_method;
	private String customer;
	private String date;
	private Float total_price;
	private int points;
	private int newPoints;
	private ArrayList<String> articles;
	private HashMap<String,Float> basket;
	private static Logger logger = LoggerUtility.getLogger(Order.class, "text");
	
	
	public Order() {
		this.articles=new ArrayList<String>();
		this.fidelity_card="";
		this.date=java.time.LocalDate.now().toString();
		this.newPoints=0;
		this.points=0;
		this.customer="318";
		this.basket=new HashMap<String,Float>();
		this.id_order=0;
	}

	public String getFidelity_card() {
		return fidelity_card;
	}

	public void setFidelity_card(String fidelity_card) {
		this.fidelity_card = fidelity_card;
	}

	public ArrayList<String> getArticles() {
		return articles;
	}

	public void setArticles(ArrayList<String> articles) {
		this.articles = articles;
	}

	public int getId_order() {
		return id_order;
	}

	public void setId_order(int id_order) {
		this.id_order = id_order;
	}

	public String getNum_card_c() {
		return num_card_c;
	}

	public void setNum_card_c(String num_card_c) {
		this.num_card_c = num_card_c;
	}

	public String getPayment_method() {
		return payment_method;
	}

	public void setPayment_method(String payment_method) {
		this.payment_method = payment_method;
	}
	
	public String getDate() {
		return date;
	}

	public void setDate(String date) {
		this.date = date;
	}

	public Float getTotal_price() {
		return total_price;
	}

	public void setTotal_price(Float total_price) {
		this.total_price = total_price;
	}

	public String getCustomer() {
		return customer;
	}
	
	public int getNewPoints() {
		return newPoints;
	}

	public void setNewPoints(int newPoints) {
		this.newPoints = newPoints;
	}

	
	public int getPoints() {
		return points;
	}

	public void setPoints(int points) {
		this.points = points;
	}

	public void setCustomer(String customer) {
		this.customer = customer;
	}
	
	

	public void setBasket(HashMap<String, Float> basket) {
		this.basket = basket;
	}

	public String getPrintedFacture() {
		 String facture="\n"
			   		+ "     	  FOX CERGY \n"
			   		+ "TELEPHONE : 01 40 37 16 55 \n"
			   		+ "Ouvert du lundi au samedi 8h30-22h00 \n"
			   		+ " et  le dimanche de 9h à 13h \n"
			   		+ "	Merci de votre fidelité \n"
			   		+ "    >>> www.foxStrore.fr <<< \n "
			   		+"Date : "+this.date+"\n"
			   		+ "------------------------------------\n"
			   		+ "Identification carte FOX : \n"
			   		+ "N°: "+this.num_card_c+"\n"
			   		+ "Points : "+this.newPoints+" \n"
			   		+ "------------------------------------ \n"
			   		+ "Total Price : "+this.getTotal_price()+" \n"
		 			+ "Articles :                           \n";
		 int i=0;
		 for (Entry mapentry : basket.entrySet()) {
			 i++;
			 	facture+="| "+i+"  "+mapentry.getKey()+"  "+mapentry.getValue()+" € | \n";
	      }
		 logger.info("Printing the facture");
		 return facture;
	}

	@Override
	public String toString() {
		return "Order [id_order=" + id_order + ", num_card_c=" + num_card_c + ", fidelity_card=" + fidelity_card
				+ ", payment_method=" + payment_method + ", total_price=" + total_price + ", articles=" + articles.toString()
				+ "]"; 
	}

	public void  addArticle(String key,Float art) {
		this.basket.put(key, art);
	}
	
	public void calculateTotalPrice() {
		Float hello=0.0f;
		Iterator<Entry<String, Float>> itr = basket.entrySet().iterator();
		while(itr.hasNext()) 
        { 
             Entry<String, Float> entry = itr.next(); 
             Float a=entry.getValue();
             hello+=a;
        }
		setTotal_price(hello);		
	}
}
