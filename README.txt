Project Description:
College Search is a web based apllication which renders search results(related to B-Tech colleges) matching a query given by the 
user. The queries supported are any city name or a "siksha.com" URL. All data shown in th e project is scraped from "siksha.com".

Files:
helpers.php : Consists of all functions required for various operations throughout the website. Helps in reducing redundancy of code.

index.php : Displays the home page of the website.

pages.php : Renders different page numbers in the form of buttons for navigation between pages of a particular search result.

processing.php : Consists of the main scraping logic of the website and also the code to save scraped data into database.

results.php : Displays the interstitial loading icon until scraped data is ready to be displayed.

apology.php : Renders apology message in case of an error. Also stops all operation after na error has occured.

footer.php : View to render footer of a page(reduces redundancy of code).

header.php : View to render footer of a page(reduces redundancy of code). Mainly consists of HTML with the title, favicon, link to 
CSS file etc.

pages_view.php : View to render the page buttons. Takes pageno. from pages.php and uses jQuery to post a modified URL to results.php
to render the page corresponding to the new page number. Also changes class of the concerned button to render it differently.

results_view.php : Renders view for the results of a search query. Consists of a div "replace" with the loading icon which is 
replaced with the search results once the scraping is done.

table.php : Renders the table with the search results taken from the data saved in the database.

How to use in CS50 IDE:
1. Start the webserver(with project1/public as root) by typing the following in the terminal window,
    apache50 start project1/public
    
   Start the mysql database by entering the following in the command window
    mysql50 start
    
2. Enter the following address in your browser to visit the website.
    https://project-1-namantiwari.c9users.io

3. Enter any city name to search for colleges or URL of the form "http://www.shiksha.com/b-tech/colleges/b-tech-colleges-{yourcity}"
to search.