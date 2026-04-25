<?php
require_once("../api_base/formbase.php");
class contractsigndetail extends swappform
{	
	public $transactionid;
	public $contractsigndetailid;
	public $contractid;
	public $contractreferencecategoryid;
	public $contractreferencedetailid;
    public $sign;
	//information
	

	public function __construct(&$connection)
	{
		parent::__construct($connection);
	}

	private function entryvalidation()
	{
		$this->start_validation();
		$this->checkrequired($this->sign,'Sign');
		$this->end_validation();
		return $this->invalidid;
	}

	private function datavalidation()
	{
		$this->start_validation();
		$this->invalidid=0;
		$this->invalidmessagetext='Validated';
		$this->end_validation();
		return $this->invalidid;
	}

	public function insert()
	{
		$this->dataoperationmode = operationmode::Insert;
		if ($this->entryvalidation() <> 0)
		{
			return 0;
			exit;
		}
		elseif ($this->datavalidation() <> 0)
		{
			return 0;
			exit;
		}
		if ($this->transactionid == '')
		{
			$query = "select nvl(max(transactionid),0)+1 as transactionid from contractsigndetail";
			$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			$row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);
			$this->transactionid = $row["TRANSACTIONID"];
		}
		if ($this->contractsigndetailid == '')
		{
			$query = "select nvl(max(contractsigndetailid),0)+1 as contractsigndetailid from contractsigndetail";
			$result = oci_parse($this->connection, $query);             
			$r = oci_execute($result);
			$row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);
			$this->contractsigndetailid = $row["CONTRACTSIGNDETAILID"];
		}
		if ($this->contractreferencedetailid=="null" or $this->contractreferencedetailid=="")
		{
			$this->contractreferencedetailid = NULL;
		}
		/* $query = "insert into contractsigndetail(transactionid,contractsigndetailid,contractid,contractreferencecategoryid,contractreferencedetailid,sign,active,cruserid) 
		values ($this->transactionid,$this->contractsigndetailid,$this->contractid,$this->contractreferencecategoryid,$this->contractreferencedetailid,'$this->sign',1,".$_SESSION["usersid"].")";
		$result = oci_parse($this->connection, $query); 
		if (oci_execute($result,OCI_NO_AUTO_COMMIT))
		{
			return 1;
			exit;
		}
		else
		{
			return 0;
			$this->invalidid=-200;
			$this->invalidmessagetext='Communication Error';
			exit;
		} */ 
		$action=1;
		$lob = oci_new_descriptor($this->connection, OCI_D_LOB);

		$query = 'INSERT INTO contractsigndetail (transactionid,contractsigndetailid,
		contractid,contractreferencecategoryid,contractreferencedetailid,active,cruserid,sign) '
		.'VALUES(:TRANSACTIONID,:CONTRACTSIGNDETAILID,:CONTRACTID,
		:CONTRACTREFERENCECATEGORYID,:CONTRACTREFERENCEDETAILID,:ACTIVE,:CRUSERID,
		EMPTY_BLOB()) RETURNING SIGN INTO :SIGN';
		//:CONTRACTREFERENCEDETAILID,contractreferencedetailid,
		$stmt = oci_parse($this->connection,$query);
		oci_bind_by_name($stmt, ':TRANSACTIONID', $this->transactionid);
		oci_bind_by_name($stmt, ':CONTRACTSIGNDETAILID', $this->contractsigndetailid);
		oci_bind_by_name($stmt, ':CONTRACTID', $this->contractid);
		oci_bind_by_name($stmt, ':CONTRACTREFERENCECATEGORYID', $this->contractreferencecategoryid);
		oci_bind_by_name($stmt, ':CONTRACTREFERENCEDETAILID', $this->contractreferencedetailid);
		oci_bind_by_name($stmt, ':ACTIVE', $action);
		oci_bind_by_name($stmt, ':CRUSERID', $_SESSION["usersid"]); 
		oci_bind_by_name($stmt, ':SIGN', $lob, -1, OCI_B_BLOB);
		oci_execute($stmt, OCI_DEFAULT);

		// The function $lob->savefile(...) reads from the uploaded file.
		// If the data was already in a PHP variable $myv, the
		// $lob->save($myv) function could be used instead.
		/* if ($lob->savefile($_FILES['lob_upload']['tmp_name']))  */
		//if ($lob->savefile($this->sign))
		if ($lob->save($this->sign))
		{
			return 1;
		}
		else 
		{
			return 0;
		}
		$lob->free();
		oci_free_statement($stmt);

	}

	function scan($aadhar)
	{
		$xmlpos = strpos($aadhar,'xml');
		
		if ($xmlpos ==false)
		{
			$uid = $aadhar;
		}
		else
		{
			$xml2 = $aadhar;
			$xmlpos = strpos($xml2,'uid=');
			if ($xmlpos >=0)
			{
				$uid = substr($xml2,$xmlpos+5,12);
			}
			else
			{
				$uid = '';
			}
		}
		return $uid;
	}

	public function display()
	{
		$this->dataoperationmode = operationmode::Select;
		$cond='';
		if ($cond!='')
		{
			$query = "select f.* from contractsigndetail f where f.active=1 and ".$cond;
			$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			return $result;
		}
		else
		{
			$query = "select f.* from contractsigndetail f where f.active=1 limit 100";
			$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			return $result;
		}
	}

	public function update()
	{
		$this->dataoperationmode =operationmode::Update;
		if ($this->entryvalidation() <> 0)
		{
			return 0;
			exit;
		}
		elseif ($this->datavalidation() <> 0)
		{
			return 0;
			exit;
		}
    	$query = "update contractsigndetail set active=0,dluserid=".$_SESSION["usersid"]." where active=1 and contractsigndetailid=".$this->contractsigndetailid;
    	$result = oci_parse($this->connection, $query); if (oci_execute($result,OCI_NO_AUTO_COMMIT))
		{
    		$ret1 = $this->insert();
	    	if ($ret1 == 1)
			{
	    		return 1;
				exit;
			}
			else
			{
    			return 0;
				exit;
			}
	    }
		else
		{
    		return 0;
			exit;
		}
	}

	public function delete()
	{
		$this->dataoperationmode = operationmode::Delete;
		/*if ($this->entryvalidation() <> 0)
		{
			return 0;
			exit;
		}*/
		$query = "update contractsigndetail set active=0,dluserid=".$_SESSION["usersid"]." where active=1 and contractsigndetailid=".$this->contractsigndetailid;
    	$result = oci_parse($this->connection, $query); if (oci_execute($result,OCI_NO_AUTO_COMMIT))
		{
	   		return 1;
			exit;
	    }
		else
		{
    		return 0;
			exit;
		}
	}

	public function fetch($contractsigndetailid)
	{
		$this->dataoperationmode = operationmode::Select;
		$query = "select c.* from contractsigndetail c where c.active=1 and c.contractsigndetailid=".$contractsigndetailid;
		$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
		if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$this->contractid = $row['CONTRACTID'];
			$this->contractreferencecategoryid = $row['CONTRACTREFERENCECATEGORYID'];
			$this->sign = $row['SIGN']->load();
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>