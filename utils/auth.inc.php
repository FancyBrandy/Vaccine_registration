<?php

class Auth {
  private $user_storage;
  private $user = NULL;
  

  public function __construct(IStorage $user_storage) {
    $this->user_storage = $user_storage;

    if (isset($_SESSION["user"])) {
      $this->user = $_SESSION["user"];
    }
  }

  public function register($data) {
    $user = [
      "fullname"  => $data["fullname"],
      "password"  => password_hash($data["password"], PASSWORD_DEFAULT),
      "address"  => $data["address"],
      "SSN"=>$data["SSN"],
      "email"=>$data["email"],
      "roles"=> ["user"],
    ];
    return $this->user_storage->add($user);
  }

  public function user_exists($username) {
    $users = $this->user_storage->findOne(["username" => $username]);
    return !is_null($users);
  }
  
  public function email_exists($email)
  {
    $users = $this->user_storage->findOneemail(["email" => $email]);
    return !is_null($users);
  }
  public function authenticate($username, $password) {
    $users = $this->user_storage->findMany(function ($user) use ($username, $password) {
      return $user["username"] === $username && 
             password_verify($password, $user["password"]);
    });
    return count($users) === 1 ? array_shift($users) : NULL;
  }

  public function authenticate_email($email, $password) {
    $users = $this->user_storage->findMany(function ($user) use ($email, $password) {
      return $user["email"] === $email&&password_verify($password, $user["password"]);
    });
    return count($users) === 1 ? array_shift($users) : NULL;
  }
  public function is_authenticated() {
    return !is_null($this->user);
  }

  public function authorize($roles = []) {
    if (!$this->is_authenticated()) {
      return FALSE;
    }
    foreach ($roles as $role) {
      if (in_array($role, $this->user["roles"])) {
        return TRUE;
      }
    }
    return FALSE;
  }

  public function login($user) {
    $this->user = $user;
    $postStorage = new Storage(new JsonIO(__DIR__ . "/../data/posts.json"));
    $posts = $postStorage->findAll(); // Array of topics
        $_SESSION["user"] = $user;
        $_SESSION["email"]=$user["email"];
        $_SESSION["fullname"]=$user["fullname"];
        $_SESSION["SSN"]=$user["SSN"];
        $_SESSION["booked"]=false;
        foreach($posts as $post)// check whether the user already have an appoitment or not 
        {
          if($post["fullname"]==$user["fullname"])
          {
            $_SESSION["booked"]=true;
            $_SESSION["id"]=$post["id"];
          }
        }
        
        
      
    
  }

  public function logout() {
    $this->user = NULL;
    unset($_SESSION["user"]);
  }

  public function authenticated_user() {
    return $this->user;
  }
}