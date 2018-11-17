in .htaccess are some apache directive.
1-> mod.rewrite is to redirect the page
2-> Multiviews - avoid confusion with /something and /something.php..
3-> RewriteEngine on    ..to switch on the rewrite engine.. !
4-> RewriteBase  is the url, the base url
5-
 .6-it serach for the file name if does not filnd it continues with the following roule
7->is routing verything throught that.. index.php  with parameter

.. so everything in the publc folder is getting routed thrught index.php, attaching the url parameter.. unless the folder has a file with that name so it will normallly route to that..
the allow to do instead of /url=post    ..   /post
a.. what this file is doing is pointing all to index and the possibility to use cleaner url
if we write: http://localhost/ganzerlimvc/public/whateverLitteraly.php  in the browser
or every other url in /public will be redirect to index.php . and we see that..
if in the folder there is a file whateverLitteraly.php and we insert the url
then we see the /whateverLitteraly content, because is an existing route

- SINCE INDEX.PHP is an entry point for every other url , we need to require other files from the app folder..
- first requiring the bootstrap file..
so requring the file bootstrap.php in the index, going to the index for example 
localhost/ganzerlimvc/public , THERE IS THE CONTENT OF BOOTSRTAP.PHP ..
as first thing of the file.. has sense..

first should be done the bootstrap file then the index with all the route situation..

-- to get rid of the /public an .htcaccess file can allow the Apache features 
 with this URL http://localhost/ganzerlimvc/       the server opens the directory structor
 of apache, the .htaccess should fix that, and just redirect to the public,
 without the opportunity to go to /app, also if forbidden, just in case..
this is the .htaccess file in the root, beside public and app folder
- so alo going to /ganzerlimvc we get the content of index.html, that load the content
of bootstrap..  that... .. ... .    . 

in Core the mothod controller is changing regarding the url
basically fetching all in the url, the array $params takes the ones from the URL

public function getUrl(){
        echo $_GET['url'];
    }
    .. gets the url.. it runs in the constructor.. as soon is instanciated something of the class

with the core loaded in index.php going to
http://localhost/ganzerlimvc/index.php?url=something

the requred file in bootstrap has a class with the constructor echo ing the url,
so we get the content of the page and also "     something      " , the paraeter.
 and if we go to localhost/ganzerlimvc/somethingnotintheurl
 we get also somethingnotintheurl .. taken as parameter, from the Core class, required from bootstrap, required from index.php, that takes all the routes or the parameters
 from ganzerlimvc/parameters.. 
 if we go to http://localhost/ganzerlimvc/one/2/tri
 we get one/2/tri writtren in the body, jeah!

 so
 http://localhost/ganzerlimvc/index.php?url=lsadkfalskdfj%C3%B6lsdf%C3%B6a
 is the same as, or, is directing to and getting the params ..
 http://localhost/ganzerlimvc/lsadkfalskdfj%C3%B6lsdf%C3%B6a

 the content is the same , thanks to the strange apache directives in the .htaccess
 so we can take the /one/thw/treeee and make an array..

 THIS IS A BASIC SUPER SETUP TO PREVENTING ERRORS AND NOT RECOGNIZED ROUTES AND SUPER EASYLY TAKE THE PARAMETERS
    
    taking the url paraeters we check which controller is hit and also for methods in it,

when the core is done, mapping the url .htcacces and so on ..
is needed a controller, the base controller is a class and the classes that extends controller are getting the parent methods..
the base controller in libraries/Controller has methods to load a model (for the DB) snd load the view(the page.)
--this controller is imported in bootstrap.php , so every other controller loaded in that file bootstap, can access to the other files.. 
so, the file Controllers is beside Core in the libraries folder, all the files in libraries folder are imported in bootstrap, the Core takes the url as soon as it is instanciated , it is instanciated in the Core class self, from the url this Core class 
points default to Pages controller, or if there are other controllers in the controller folder, pointing to another currentcontroller if there is, it loads the controllers there,
then the file in class controller has access to the base controller class and can use the methods to show the pae and load modules, 
so just giving an url the core it maps the url to the controller and gives the parameters and all , and the controller can show the page and do stuff with the db..

so all the controllers like Page and so that extends this one have the methods to load the model and show the page

in one of the controllers loading the view is requiring the file in pages/index.html for example, if we pas an array, as parameter
the pareameter is the $data, calling this method the page get loaded and into the page we can pass the variable and use it in the page

to make path more dinamic in config are set to variables, deploing or if the path is something else like so we can have the paths easier to manage
in config.php we need to point to the app root c:/xampp/htdocs/ganzerlimvc/app ... ...  
if in config we insert an echo __FILE__ we get c:/xampp/htdocs/ganzerlimvc/app/config/config.php -- is a magic function, finds the paths
echo dirname(__FILE__) we have the path until config, the previous parent diretory, dirname(dirnmae(dirnmae(__FILE__)))
nesting it we get down the parents tree until the app dir, the //APP ROOT
    define() method is to define a constant.. $ = value; for variables,   define("NAME" , $value ) for constants .

-- Core is instanciated from index.php the default file, core takes the url, searches for a class , if the method and class exist this class get called
and his methods are loading views and models for the db..

--bootstrap phpcan have na auto loader for the libraries to call..

for the view we create an header and footer file, to give for all the views
-- including constants for the path:
when including something from the app folder there is APPROOT , if using in the frontend, the public folder, then the URLROOT.

also for the PDO is easier to define the cinstants in  config
the defined config constants for database can be used in the Database.php library

the Database clas is used in the models

with the Database class the controllers can call the model and the model qeries the database, with the result a variable can be passed into the view frpm the controller once got the result set from DB.


-----------------FRONT ---------

    in the db get created a post table and a user table , so there is also the autentication
    -in ligin controller is reaching to the model, User that reaches to the DB library

    for registration an connection with db the User class should be implemented , like a findUserByEmail() 
    , a rgister() and all what is needed from this model 

to register the user for redirecting the helper folder can hold helper functions for example .
loading them into the bootstrap we can access them as soon as the site loads..  index.html public.

the function flash makes a message to show at the next page, only one time when a new page is loaded.
is called in the Users to create it and it can be used in Login , because that is the page redirected to in that case

once user can register and log in a session record is stored for the authentication, the user can now access to the posts or whatever
so for the posts the route can be managed from another controller Posts

to fetch the posts is a post model needed to reach into the DB

