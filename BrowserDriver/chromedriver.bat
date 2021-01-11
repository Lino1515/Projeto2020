from selenium import webdriver
   url="C:\\wamp64\\www\\Projeto2020\\BrowserDriver\\chromedriver.exe"
   driver=webdriver.Chrome(url)
   driver.get("http://www.google.com")
   driver.close()
   driver.quit()