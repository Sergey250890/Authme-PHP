<?

require_once "./includes/libs/redbean/rb-mysql.php";

class Auth{


	function AccountExists($name) {
		$result = R::findOne('m_authme', 'username = ?', [$name]);
		if($result){	 
			return true;
		}else{
			return false;
		}
	}
	
	function Login($name,$password) {
	
		if ($this->AccountExists($name) == false) { return false; }
	
		$query = R::findOne('m_authme', 'username = ?', [$name]);
		print '<pre>';
		print_r($query['password']);
		print '</pre>';


		$sha_info = explode('$', $query['password']);
		if( $sha_info[1] === "SHA" ) {
			$salt = $sha_info[0];
			$sha256_password = hash('sha256', $password);
			$sha256_password .= $sha_info[2];
			if( strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password) ) == 0 ){
				echo "true";
				return true;
			} else {
				echo "false";
				return false;
			}
		}
	}
}
