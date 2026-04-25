<?php
include("../api_base/formbase.php");
class contract extends swappform
{	
	public $contractid;
	public $seasonid;
	public $sugarfactoryid;
	public $servicecontractorid;
	public $contractcategoryid;
	public $applicationnumber;
	public $applicationdatetime;
	public $contractnumber;
	public $contractnumber_prefixsuffix;
	public $contractdatetime;
	public $entityglobalgroupid;
	public $finalreportperiodid;
	public $age;
	public $casteid;
	public $fieldarea;
	public $isadvance;
	//information properties
	public $servicecontractorname_eng;
	public $servicecontractorname_unicode;
	public $seasonname_eng;
	public $seasonname_unicode;
	public $contractcategoryname_eng;
	public $contractcategoryname_unicode;
	/* public $areaid; */
	public $contactnumber;
	public $pannumber;
	public $aadharnumber;
	public $bankbranchname_eng;
	public $bankbranchname_unicode;
	public $bankaccountnumber;
	public $chequenumber;
	public $harvestlabourcategoryname_eng;
	public $harvestlabourcategoryname_unicode;
	public $address_unicode;
	public $caste_unicode;

	public function __construct(&$connection)
	{
		parent::__construct($connection);
		$this->contractid = '';
		$this->seasonid = '';
		$this->sugarfactoryid = '';
		$this->servicecontractorid = '';
		$this->contractdatetime = '';
	}

	private function entryvalidation()
	{
		$this->start_validation();
		$this->checkrequired($this->seasonid,'Season');
		$this->checkrequired($this->sugarfactoryid,'Sugar Factory');
		$this->checkrequired($this->servicecontractorid,'Service Contractor');
		$this->checkrequired($this->contractcategoryid,'Service Contract Category');
		$this->checkrequired($this->applicationdatetime,'Application Date');
		$this->checkrequired($this->casteid,'Caste');
		$this->checkrequired($this->age,'Age');
		$this->end_validation();
		return $this->invalidid;
	}

	private function datavalidation()
	{
		$this->start_validation();
		if ($this->contractid == '')
		{
			$query = "select count(*) as cnt from contract a where a.active=1 and a.seasonid=".$this->seasonid." and a.sugarfactoryid=".$this->sugarfactoryid." and a.servicecontractorid=".$this->servicecontractorid." and a.contractcategoryid=".$this->contractcategoryid;
			//$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
		}
		else
		{
			$query = "select count(*) as cnt from contract a where a.active=1 and a.contractid<>".$this->contractid." and a.seasonid=".$this->seasonid." and a.sugarfactoryid=".$this->sugarfactoryid." and a.servicecontractorid=".$this->servicecontractorid." and a.contractcategoryid=".$this->contractcategoryid;
			//$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
		}
		//$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
		$row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);
		if ($row["CNT"] > 0)
		{
			$this->invalidid=-201;
			$this->invalidmessagetext='Contract is already exists';
		}
		else
		{
			$this->invalidid=0;
			$this->invalidmessagetext='Validated';
		}
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
		if ($this->contractid == '')
		{
			$query = "select nvl(max(contractid),125478523)+4256 as contractid from contract";
			/* $result = mysqli_query($this->connection, "select nvl(max(contractid),125478523)+4256 as contractid from contract");
			$result = oci_parse($this->connection, $query);             $r = oci_execute($result); */
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
			$row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);
			$this->contractid = $row["CONTRACTID"];
		}
		if ($this->applicationdatetime!='')
		{
			$this->applicationdatetime = DateTime::createFromFormat('d/m/Y',$this->applicationdatetime)->format('d-M-Y');	
		}
		if ($this->applicationdatetime!='' and $this->applicationnumber== '')
		{
			$query = "select nvl(max(applicationnumber),0)+1 as applicationnumber from contract where sugarfactoryid=".$this->sugarfactoryid." and seasonid=".$this->seasonid." and contractcategoryid=".$this->contractcategoryid;
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
			$row2 = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);
			$this->applicationnumber = $row2["APPLICATIONNUMBER"];
		}
		if ($this->contractdatetime!='')
		{
			$this->contractdatetime = DateTime::createFromFormat('d/m/Y',$this->contractdatetime)->format('d-M-Y');	
		}
		if ($this->contractdatetime!='' and $this->contractnumber== '')
		{
			$query = "select nvl(prefix,'') as prefix from contractcategory where active=1 and contractcategoryid=".$this->contractcategoryid;
			//$result = oci_parse($this->connection, $query);             $r = oci_execute($result);
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
			if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
			{
				$pos = strpos($row["PREFIX"],'@sy',0);
				if ($pos !=false)
				{
					$prefix = substr($row["PREFIX"],0,$pos);
					$suffix = substr($row["PREFIX"],$pos+3,strlen($row["PREFIX"]));
					$query_11 = "select name_eng from season f where f.active=1 and f.seasonid=".$this->seasonid;
/* 					$result_11 = mysqli_query($this->connection, $query_11);
					if ($row_11 = mysqli_fetch_assoc($result_11)) */
					$result_11 = oci_parse($this->connection, $query_11);
					$r = oci_execute($result_11);
					if ($row_11 = oci_fetch_array($result_11,OCI_ASSOC+OCI_RETURN_NULLS))
					{
						$prefix .= substr($row_11['NAME_ENG'],2,2).'-'.substr($row_11['NAME_ENG'],7,2).$suffix;
					}
					else
					{
						return 0;
						$this->invalidid=-200;
						$this->invalidmessagetext='Communication Error';
						exit;
					}
				}
				else
				{
					$prefix = $row["PREFIX"];
				}
			}
			else
			{
				return 0;
				$this->invalidid=-200;
				$this->invalidmessagetext='Communication Error';
				exit;
			}
			$query_12 = "select nvl(max(contractnumber),0)+1 as contractnumber from contract where entityglobalgroupid=".$this->entityglobalgroupid." and finalreportperiodid=".$this->finalreportperiodid." and sugarfactoryid=".$this->sugarfactoryid." and seasonid=".$this->seasonid." and contractcategoryid=".$this->contractcategoryid;
			/* $result_12 = mysqli_query($this->connection, $query_12);
			$row_12 = mysqli_fetch_assoc($result_12); */
			$result_12 = oci_parse($this->connection, $query_12);
			$r = oci_execute($result_12);
			$row_12 = oci_fetch_array($result_12,OCI_ASSOC+OCI_RETURN_NULLS);
			$this->contractnumber = $row_12["CONTRACTNUMBER"];
			$this->contractnumber_prefixsuffix = $prefix.str_pad($row_12["CONTRACTNUMBER"],5,'0',STR_PAD_LEFT);
		}
		$query = "insert into contract(transactionid,contractid,seasonid,sugarfactoryid,servicecontractorid,contractcategoryid,applicationnumber,applicationdatetime,contractnumber,contractnumber_prefixsuffix,contractdatetime,casteid,age,fieldarea,entityglobalgroupid,finalreportperiodid,isadvance,active,cruserid) values ((select nvl(max(transactionid),0)+1 from contract),$this->contractid,$this->seasonid,$this->sugarfactoryid,$this->servicecontractorid,$this->contractcategoryid,".$this->invl($this->applicationnumber,true).",'$this->applicationdatetime',".$this->invl($this->contractnumber,true).",".$this->invl($this->contractnumber_prefixsuffix,false).",".$this->invl($this->contractdatetime,false).",".$this->casteid.",".$this->age.",".$this->invl($this->fieldarea,false).",".$this->entityglobalgroupid.",".$this->finalreportperiodid.",".$this->invl($this->isadvance,false).",1,".$_SESSION["usersid"].")";
		//echo $query;
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
		}
	}

	public function display()
	{
		$this->dataoperationmode = operationmode::Select;
		if ($this->seasonid==0)
		{
			$this->seasonid = '';
		}
		if ($this->sugarfactoryid==0)
		{
			$this->sugarfactoryid = '';
		}
		if ($this->contractcategoryid==0)
		{
			$this->contractcategoryid = '';
		}
		$cond='';
		if ($this->seasonid!='')
		{
			if ($cond=='')
			{
				$cond=$cond."s.seasonid = ".$this->seasonid;
			}
			else
			{
				$cond=$cond." and s.seasonid = ".$this->seasonid;
			}
		}
		if ($this->sugarfactoryid!='')
		{
			if ($cond=='')
			{
				$cond=$cond."sugarfactoryid = ".$this->sugarfactoryid;
			}
			else
			{
				$cond=$cond." and sugarfactoryid = ".$this->sugarfactoryid;
			}
		}
		if ($this->servicecontractorid!='')
		{
			if ($cond=='')
			{
				$cond=$cond."c.servicecontractorid =".$this->servicecontractorid;
			}
			else
			{
				$cond=$cond." and c.servicecontractorid =".$this->servicecontractorid;
			}
		}
		if ($this->contractcategoryid!='')
		{
			if ($cond=='')
			{
				$cond=$cond."contractcategoryid =".$this->contractcategoryid;
			}
			else
			{
				$cond=$cond." and contractcategoryid =".$this->contractcategoryid;
			}
		}
		if ($cond!='')
		{
			$query = "select c.contractid,t.name_eng,t.name_unicode,s.name_eng as seasonname_eng,s.name_unicode as seasonname_unicode,c.contractnumber,t.servicecontractorid from contract c, season  s,servicecontractor t where c.active=1 and s.active=1 and c.seasonid=s.seasonid and c.servicecontractorid=t.servicecontractorid and ".$cond;
			//echo $query;
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
			return $result;
		}
		else
		{
			$query = "select c.contractid,t.name_eng,t.name_unicode,s.name_eng as seasonname_eng,s.name_unicode as seasonname_unicode,c.contractnumber from contract c, season  s,servicecontractor t where c.active=1 and s.active=1 and t.active=1 and c.seasonid=s.seasonid and c.servicecontractorid=t.servicecontractorid";
			//echo $query;
			$result = oci_parse($this->connection, $query);
			$r = oci_execute($result);
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
    	$query = "update contract set active=0,dluserid=".$_SESSION["usersid"]." where active=1 and contractid=".$this->contractid;
    	$result = oci_parse($this->connection, $query);
		if (oci_execute($result,OCI_NO_AUTO_COMMIT))
		{
    		$ret1 = $this->insert();
	    	if ($ret1 == 1)
			{
	    		$proc = 'BEGIN deleteguarchain(p_contractid=>'.$this->contractid.',p_contractcategoryid=>'.$this->contractcategoryid.'); END;';
				$resultp = oci_parse($this->connection, $proc);
				if (oci_execute($resultp, OCI_NO_AUTO_COMMIT))
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
				}
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
		$this->dataoperationmode =operationmode::Delete;
		if ($this->entryvalidation() <> 0)
		{
			return 0;
			exit;
		}
    	$query = "update contract set active=0,dluserid=".$_SESSION["usersid"]." where active=1 and contractid=".$this->contractid;
    	$result = oci_parse($this->connection, $query);
		if (oci_execute($result,OCI_NO_AUTO_COMMIT))
		{
			$proc = 'BEGIN deleteguarchain(p_contractid=>'.$this->contractid.',p_contractcategoryid=>'.$this->contractcategoryid.'); END;';
			$resultp = oci_parse($this->connection, $proc);
			if (oci_execute($resultp, OCI_NO_AUTO_COMMIT))
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
			}
	    }
		else
		{
    		return 0;
			exit;
		}
	}
	public function gurantorcount($category=0)
	{
		//0 = ALL
		if ($category == 0)
		{
			$query = "select count(*) as cnt from contractguarantordetail r where r.active=1 and r.contractid=".$this->contractid;
		}
		//1 = Contractor
		elseif ($category == 1)
		{
			$query = "select count(*) as cnt from contractguarantordetail r where r.active=1 and iscultivator=0 and r.contractid=".$this->contractid;
		}
		//2 = Cultivator
		elseif ($category == 2)
		{
			$query = "select count(*) as cnt from contractguarantordetail r where r.active=1 and iscultivator=1 and r.contractid=".$this->contractid;
		}
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			return $row['CNT'];
		}
		else
		{
			return 0;
		}
	}
	public function itemloancount()
	{
		$query = "select count(*) as cnt from contractitemloandetail c where c.active=1 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			return ($row['CNT']);
		}
		else
		{
			return 0;
		}
	}
	public function documentlist()
	{
		$query = "select contractdocumentdetailid from contractdocumentdetail c where c.active=1 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		$data = array();
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$data[] = $row['CONTRACTDOCUMENTDETAILID'];
		}
		return $data;
	}
	public function itemloanlist()
	{
		$query = "select contractitemloandetailid from contractitemloandetail c where c.active=1 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		$data = array();
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$data[] = $row['CONTRACTITEMLOANDETAILID'];
		}
		return $data;
	}
	public function transportlist()
	{
		$query = "select contracttransportdetailid from contracttransportdetail c where c.active=1 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		$data = array();
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$data[] = $row['CONTRACTTRANSPORTDETAILID'];
		}
		return $data;
	}
	public function guarantorcontractorlist()
	{
		$query = "select contractguarantordetailid from contractguarantordetail c where c.active=1 and iscultivator=0 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		$data = array();
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$data[] = $row['CONTRACTGUARANTORDETAILID'];
		}
		return $data;
	}
	public function guarantorcultivatorlist()
	{
		$query = "select contractguarantordetailid from contractguarantordetail c where c.active=1 and iscultivator=1 and c.contractid=".$this->contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		$data = array();
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$data[] = $row['CONTRACTGUARANTORDETAILID'];
		}
		return $data;
	}
	public function fetch($contractid)
	{
		$this->dataoperationmode = operationmode::Select;
		$query = "select c.*,s.name_eng as seasonname_eng,s.name_unicode as seasonname_unicode,r.contractcategoryname_eng,r.contractcategoryname_unicode from contract c, season  s,contractcategory r where c.active=1 and s.active=1 and r.active=1 and c.seasonid=s.seasonid and c.contractcategoryid=r.contractcategoryid and c.contractid=".$contractid;
		$result = oci_parse($this->connection, $query);
		$r = oci_execute($result);
		if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$this->contractid = $row['CONTRACTID'];
			$this->seasonid = $row["SEASONID"];
			$this->seasonname_unicode = $row["SEASONNAME_UNICODE"];
			$this->sugarfactoryid = $row["SUGARFACTORYID"];
			$this->servicecontractorid = $row["SERVICECONTRACTORID"];
			$this->contractcategoryid = $row["CONTRACTCATEGORYID"];
			$this->applicationnumber = $row["APPLICATIONNUMBER"];
			$this->applicationdatetime = date('d/m/Y',strtotime($row['APPLICATIONDATETIME']));
			$this->contractnumber = $row["CONTRACTNUMBER"];
			$this->contractnumber_prefixsuffix = $row["CONTRACTNUMBER_PREFIXSUFFIX"];
			$this->contractdatetime = date('d/m/Y',strtotime($row['CONTRACTDATETIME']));
			$this->casteid = $row['CASTEID'];
			$this->age = $row['AGE'];
			$this->fieldarea = $row['FIELDAREA'];
			$this->entityglobalgroupid = $row["ENTITYGLOBALGROUPID"];
			$this->finalreportperiodid = $row["FINALREPORTPERIODID"];
			$this->isadvance = $row['ISADVANCE'];
			if ($this->contractcategoryid==521478963)
			{
				$this->harvestlabourcategoryname_eng ='Harvesting Transportation Labour';
				$this->harvestlabourcategoryname_unicode ='तोडणी वाहतूक मजूर';
			}
			elseif ($this->contractcategoryid==785415263)
			{
				$this->harvestlabourcategoryname_eng ='Bulluckcart Labour';
				$this->harvestlabourcategoryname_unicode ='बैलगाडी मजूर';
			}
			$this->contractcategoryname_unicode = $row['CONTRACTCATEGORYNAME_UNICODE'];
			$this->contractcategoryname_eng = $row['CONTRACTCATEGORYNAME_ENG'];
			
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>