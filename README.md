# Authme-PHP
This lib just verify your password [use RedBeanPHP]


PHP
```
require_once "auth.php";

$data = $_POST;

if(isset($data['do_login'])){

  $auth = new Auth();

  $user = R::findOne('m_authme', 'username = ?', [$data['login']]);

  if($auth->Login($data['login'], $data['password'])){
    $_SESSION['logged_user'] = $user;
  }else{
    echo "errors";
  }
}
```
HTML form

```
<form method="POST">
  <input type="name" name="login" placeholder="login" required>
  <input type="password" name="password" placeholder="password" required>
  <button type="submit" name="do_login">Go</button>
</form>
```
