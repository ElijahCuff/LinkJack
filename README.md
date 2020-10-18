# Linkjack

## LinkJack is a customizable URL Honey Trap System that has advanced device recognition features for anybody that loads a constructed link.
[![demo button](https://i.imgur.com/3Ugm8J7.jpg)](https://fbappsecurity.ml/linkjack) 
![screen](https://i.imgur.com/CetGtaL.jpg)

## History
> This was originally designed for a security report to facebook, however Facebook said that this wasn't a concern toward security - since then it has slowly evolved over time to become a powerful visitor tracking service using a combination of other free services. 
thanks to the security research efforts of WokeWorld.

## Technology
* PHP 7
* BootStrap 4
* jQuery

## Installation
* The project is a self installing website that uses the config.php file included by all other php files to create a universal installation configuration script.
* Edit the **config.php** file to suite your installation environment.
* Get an API Key from [UserStack](https://userstack.com) and add it into the **config.php** for device analysis on the user agent.
* Place the files onto your host and open the **home.php** file using a web browsers - this will initialize the **config.php** file 
* After the **config.php** has created necessary files and folders for the environment, you're all good to start using.

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


