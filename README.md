Linkjack
======
LinkJack is a customizable URL shortening service that has advanced device recognition features for anybody that loads a shortened link.

## History
> This was originally designed for a security report to facebook, however Facebook said that this wasn't a concern toward security - since then it has slowly evolved over time to become a powerful visitor tracking service using a combination of other free services. 

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

### Live Demo
[![demo button](https://i.imgur.com/3Ugm8J7.jpg)](https://naxlo.ml/app/linkly) 


## Design & Theme 
MIT Licensed Design
> See [Mobirise](https://mobirise.com) for more information on the software used to build LinkJack's html frontend.
* I've added the project file so you can keep working on the same theme.
