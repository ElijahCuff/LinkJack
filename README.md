# LinkJack

### LinkJack is a customisable URL Honey Trap System that has advanced device recognition features for anybody that loads a constructed link.
[![demo button](https://i.imgur.com/3Ugm8J7.jpg)](https://linkstats.ml) 
![screen](https://i.imgur.com/CetGtaL.jpg)

## History
> This was originally designed for a security report to facebook, however Facebook said that this wasn't a concern toward security - since then it has slowly evolved over time to become a powerful visitor tracking service using a combination of other free services. 
thanks to the security research efforts of Venomo under the WokeWorld Project 2020.
    
## Updates on report     
> Facebook Like Jacking Successfully performed 7 November 2020 using a Cross-Site Request Forgery to the sister website mbasic.facebook   
* Load Facebook in mbasic.facebook.com    
* Go to the desired Page to Like Jack    
* Hold ( Long Press ) on Like button and Select Copy URL    
* Paste the Like URL into a new text document
* Open the Facebook News Feed and find a Link    
* Extract the Facebook Linkshim URL from the Link    
* Format your Like URL in urlEncoded format     
* Inject Like URL into Linkshim URL   
 
Eg,   
Like URL    
`https://mbasic.facebook.com/a/profile.php?fan&id=116472816929607&origin=page_profile&pageSuggestionsOnLiking=1&gfid=AQCxHP9_rBs9hWEIUBA&refid=17&ref=bookmarks`   
        
Link URL    
`https://lm.facebook.com/l.php?u=[url]&h=AT0Q...`      
      
Injection URL     
`https://lm.facebook.com/l.php?u=https%3A%2F%2Fmbasic.facebook.com%2Fa%2Fprofile.php%3Ffan%26id%3D116472816929607%26origin%3Dpage_profile%26pageSuggestionsOnLiking%3D1%26gfid%3DAQCxHP9_rBs9hWEIxwk%26refid%3D0&h=AT0QwiCjR8pUK_Lgr-w9hZWHMRUXNq-W9Wm5Vp5Ssq8x7C1rHJ4Jbfgm0ssXmqzU5NJH85zRkT886DKRQ_iWyRz0NQIZhobUMRUzlHyd582pZvKSAJMmrEOuD-6Y4vk0C73HAZZc2v0VcylgwtxAXni2DmJan1T99ObuVmQB5iIqnRfe5n5zCKWtJpD91hJV60wsN1Hn6LRxkZ5zx4uIatCmuFSIiosOV38E0spJRQdUZ2neUsLJc6vgv2p4mi2dfYIsJQKEANddyGjF3cP8oPHIbsjQz5LiU1NozYOoRgaUHe0k-0S8oq2D217f-Cy3CUkRI5AOPQxDR-EVFrs-YS6r2nGb8Ez_8rfsiFPr0F3DEvqRwMLGqfRcqxYqgHtJn36dzXUZyVFo5R-d7qc7fCN2sjdNx9n7SLLetrMA1P4Ru9Fua-XwTE4cAbT-PS6fEYkD45unAX3Ydu0uufq7mZq1t_BBfiUbncMr9TdvQ0PAIeWV6IapoaMH0x9BRThMyNUENthJQQnBpMUfvz_j4wu7VItZGBNL2-C1g9wg8nevzsAMIvCO_xm3XOIqwR-_pdw1SN5pnstDz-EESA`
     
  
Like Jacking Successful within H parameters Time Allowance, each H param is unique to the time of Click and therefore will allow about 1 hour with that same H id.
   
GFID  Facebook GFID is also time limited to the same cookie expirations.
   

## Facebook Post Spoofing   
* Set Target as ( Facebook, FB )   
* Choose the URL Facebook will see - Target URL    
* Add Real URL - Default URL    


## Technology
* PHP 7
* BootStrap 4
* jQuery

## Installation
* The project is a self installing website that uses the config.php file included by all other php files to create a universal installation configuration script.
* Edit the **config.php** file to suite your installation environment.
* Get an API Key from [UserStack](https://userstack.com) and add it into the **config.php** for device analysis on the user agent - or use the provided test key.
* Place the files onto your host and open the **home.php** file using a web browsers - this will initialize the **config.php** file 
* After the **config.php** has created necessary files and folders for the environment, you're all good to start using.


### Heroku Deployment
#### Heroku runs under CGI environment and some things have been changed to work with Heroku, the Time will now be displayed in (Seconds Ago) and the IP address information is still not loading from the API.   
[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)        
Create a FREE account first if you do not yet have one:  
https://signup.heroku.com/    
### Heroku Demo Deployment     
#### Full featured heroku deployment, has issues loading additional ip address information
https://linkstat.herokuapp.com/

## Development Notes
### Security Improvement
I built and distributed the entire project by myself in about 3 days, so please keep that in mind - it needs a thorough run through for security with proper sanitization of input and descriptions.

## Usage
### Create A Link
* Open the **Add Link** Page
* Enter a device target or IP address to match against the link viewer's
* Press **Get Link** 
* Write Down Your Private Key - important !
* Test the Link, it will automatically copy to clipboard when you press **Get Link**

### Watch A Link
* Open the **Link Stats** page
* Enter Your Link that was Created
* Enter Your Private Key ( Link PIN )
* Press **Get Stats**

### Remove A Link
* Open the **Remove Link** page
* Enter Your Link that was Created
* Enter Your Private Key ( Link PIN )
* Press **Remove Link**


## Page Screenshots
### Get Link
![screen](https://i.imgur.com/dtBXBzR.jpg)

### Link Stats Key Check
![screen](https://i.imgur.com/Sh5m5he.jpg)

### Link Stats 
![screen](https://i.imgur.com/cusF2xO.jpg)


### Remove Link 
![screen](https://i.imgur.com/UGtYzru.jpg)


### Origin Report Graphic 
![screen](https://github.com/WokeWorld/LinkJack/blob/master/IMG_20200310_084516.jpg)


### Response on Report Danger
![screen](https://github.com/WokeWorld/LinkJack/blob/master/Screenshot_2020-06-15-13-02-56.jpg)

## Design & Theme 
MIT Licensed Design
> See [Mobirise](https://mobirise.com) for more information on the software used to build LinkJack's html frontend.
* I've added the project file so you can keep working on the same theme.


