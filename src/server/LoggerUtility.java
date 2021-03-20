package server;

import org.apache.log4j.Logger;
import org.apache.log4j.PropertyConfigurator;

/**
 * 
 * Utility class used to generate Log4j logger.
 */
public class LoggerUtility {
	private static final String TEXT_LOG_CONFIG = "./src/log4j-text.properties";
	private static final String HTML_LOG_CONFIG = "./src/log4j-html.properties";
	//private static final String CONSOLE_LOG_CONFIG = "src/log/log4j-console.properties";

	public static Logger getLogger(Class<?> logClass, String logFileType) {
		
		switch (logFileType) {
			
			case "text":
				PropertyConfigurator.configure(TEXT_LOG_CONFIG);
				break;
			case "html":
				PropertyConfigurator.configure(HTML_LOG_CONFIG);
				break;
			case "console" :
				//PropertyConfigurator.configure(CONSOLE_LOG_CONFIG);
				break;
			default :
				throw new IllegalArgumentException("Unknown log file type !");		
		}
		String className = logClass.getName();
		return Logger.getLogger(className);
	}
}
