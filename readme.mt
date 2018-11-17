
    in the db is created a post table and a user table , so there is also the autentication
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
---------------------------------
to add new features in the project is just needed to create a controller for it, model and DB tables for that and view..
since the core loads from the url which controller to load and the methods we can easly just create new controllers and models to
pass in the Thing extends Controller to load the new paths and whatever needed for the DB connection.


,-.,-.,-.,<-.<,<-.<,<-.,<,-2-23-.3,<42-.-.,<-.,<+<<ö.<,-<<-<<#,<#<



    public function getPosts(){

        // create a join with the users table, user and post hava an id , is needed an alias for the post user id
        $this->db->query('SELECT * ,
                        posts.id as postId,                 /*selecting joining fields and giving a name*/
                        users.id as userId,
                        FROM posts,
                        INNER JOIN users,                   /*what to join*/
                        ON posts.user_id = users.id,        /*where to join it*/
                        ORDER BY posts.creation_date DESC
                        ');
        // now should be possible to access the user datas within the posts wiew

        // fills the posts tables with the fields of users, and fills the tables of the posts with the fields of users targeting
        //the posts.user_id to choose which users tables goes in which posts table for each row in posts.
        $results = $this->db->resultSet();

        return $results;
    }


    .,.,.-.,-.,-.,-.,-.,-.,-.,<-.<,<-.<,<-.,<,-2-23-.3,<42-.-.,<-.,<+<<ö.<,-<<-<<#,<#<


    to add a post a function in Posts controller is created to take title and body in data array and load the view.
    in the controller for Posts , add method should check the request, to know what it is with the data..

    the user model can be loaded in Posts controller so to have access to the user data from the database if queriyng by the content
    in the user_id field that has every posts record,, this has to be in the constructor so we can access it from every function
    User  model needs a method getUserById.. until now was created only for the email..

    for the modification of posts the Posts controller will be a bit similar to the add.. modify the data and sends everything back
    in this method we have to prevent that the user registrated in session is the owner of the post.
    the model for that will be similar to add post too.
