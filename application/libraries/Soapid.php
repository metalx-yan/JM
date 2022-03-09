<?php
/**
 * PHP LDAP Code porting for Codeigniter
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @porting author	wie.istn@gmail.com
 * @porting author	dwi.admojo@Bankmega.com
 * @original author	gek123 ITSO
 * 
 * @version		1.0
 */
 
class Soapid
{
  var $cache = true;
  var $salt = "gek123";  
  var $secret = "iknowwhatyoudidlastnigth";  
	var $ldapserver = "http://10.14.18.159:8080/middleware/services/ServicePortTypeBndPortServiceLdap?wsdl";

  function Verify($data=null)
  {
    if(empty($data['user'])){
      $res['nouser'] = 'no user';
      return $res;
      die;
    }

    try{
      $client = new SoapClient($this->ldapserver);
    }catch(Exception $e){	
      $_SESSION["_ERR_SYS"] = "ERROR CONNECTION LDAP";
      echo "ERROR CONNECTION LDAP";
    }  

    $user = $data['user'];
    $pass = $data['pass'];
    $encriptloginpass =  $this->encrypt( $pass );
    //$encriptloginpass ="Z2VNulQgE3+TnAh";

    $requestItems1['Request'] = "cn=$user , o=megauser";
    $requestItems2['Request'] = $encriptloginpass;
    $request['item'] = array($requestItems1, $requestItems2);
    
    $params = array(
      "ServiceName" => "SERVICE_VERIFY",
      "ClientId" => "47715538-aff8-4fc6-a8e4-ccf9531bbe28",
      "Signature" => "Z2V2nmgXawzm+14H7lkbwzVbJds6QSJPo6QIQrwQXZo=",
      "ArrRequest" => $request
    );

    $response = $client->__soapCall("getServiceLdap", array($params));
    $response->id = $user;

    return $response;
  }

  function Changepass($data=null)
  {
    if(empty($data['user'])){
      $res['nouser'] = 'no user';
      return $res;
      die;
    }

    try{
      $client = new SoapClient($this->ldapserver);
    }catch(Exception $e){	
      $_SESSION["_ERR_SYS"] = "ERROR CONNECTION LDAP";
      echo "ERROR CONNECTION LDAP";
    }  

    $user = $data['user'];
    //$pass = $data['pass'];
    $newpass = $data['newpass'];
    $encriptloginpass =  $this->encrypt( $newpass );
    //$encriptloginpass ="Z2VNulQgE3+TnAh";

    $requestItems1['Request'] = "cn=$user , o=megauser";
    $requestItems2['Request'] = $encriptloginpass;
    $request['item'] = array($requestItems1, $requestItems2);
    
    $params = array(
      "ServiceName" => "SERVICE_SET_PASSWORD",
      "ClientId" => "24ba8a43-edfe-43b1-85d5-15da5c73fb01",
      "Signature" => "Z2V2nmgXawzm+1sH6E8N22YIcpRoBSJPo6QIQrwQXZo1WyXbOkE=",
      "ArrRequest" => $request
  );

    $response = $client->__soapCall("getServiceLdap", array($params));
    $response->id = $user;

    return $response;
  }





  		  

function encrypt($password) 
{
  $salt = $this->salt;
  $secret = $this->secret;

	try {
		$salt = ($salt == null || strlen(trim($salt)) == 0) ? $this->getRandomSalt() : $salt;		
		while(strlen($salt) < 2) {
			$salt .= "A";
		}
		if(strlen($salt) > 2) {
		        $salt = substr($salt,0,2);	
		}
		$bsalt = array_slice(unpack("C*", "\0".$salt),1);		
		$bpwd = array_slice(unpack("C*", "\0".$password),1);		
		$digest = array_slice(unpack("C*", "\0".pack("H*",hash("md5", $salt.$secret))),1);	
		
		$len = strlen($salt) + (count($digest) * ((count($bpwd) + 16) / 16));		
		$i = 0;
		$p = 0;
		$j = 0;
		$result = array();
		for(;$i<count($bsalt);$i++) {
			$result[$i] = $bsalt[$i];
		}
		for(;$i<$len;$i++) {
			if($p < count($bpwd)) {
				$result[$i] = ($bpwd[$p] ^ $digest[($j % count($digest))]); 
			} else {
				$result[$i] = (0 ^ $digest[($j % count($digest))]);
			}
			$j++;
			$p++;
		}	
		return base64_encode(implode(array_map("chr", $result)));
	} catch(Exception $e){}
}

function doencrypt($password, $secret) {
	return encrypt($password, null, $secret);
}

function decrypt($password, $secret) {
	$decode = array_slice(unpack("c*", "\0".base64_decode($password)),1);			
	$bsalt = array();
	$bsalt[0] = $decode[0];
	$bsalt[1] = $decode[1];
	
	$bxorp = array();
	for($x = 2; $x < count($decode); $x++) {
		$bxorp[$x - 2] = $decode[$x];
	}
	$salt = implode(array_map("chr", $bsalt));
	$digest = array_slice(unpack("c*", "\0".pack("H*",hash("md5", $salt.$secret))),1);	
	
	$len = count($digest) * ((count($bxorp) + 15) / 16);	
	$j = 0;
	$p = 0;
	for($i = 0; $i < $len; $i++) {
		if($p < count($bxorp)) {
			$bxorp[$p] = ($bxorp[$p] ^ $digest[($j % count($digest))]);
		}
		$p++;
		$j++;
	}
	
	$sDecode = implode(array_map("chr", $bxorp));
	return trim($sDecode);
}

function getRandomSalt(){
	$pattern = "/^[\w]+$/";
	$rand = chr("0");
	$salt = "";
	for($i=0; $i<2;){
		$rand=chr(($this->getRandomInt()%62)."");
		preg_match($pattern,$rand, $matches);
		if(count($matches) == 0){	
			continue;
		}
		$salt .= $matches[0];
		$i++;
	}
	return $salt;
}

function getRandomInt(){
	$n = rand(0,100000);
	return $n;
}

  

}

/* end of file */