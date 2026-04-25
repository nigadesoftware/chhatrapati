<?php
    include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contracttransportdetail_db_oracle.php");
	include_once("../api_oracle/contractharvestdetail_db_oracle.php");
	include_once("../api_oracle/contracttransporttrailerdetail_db_oracle.php");
	include_once("../api_oracle/contractguarantordetail_db_oracle.php");
	include_once("../api_oracle/servicecontractor_db_oracle.php");
	include_once("../api_oracle/contractperformancedetail_db_oracle.php");
    include_once("../api_oracle/contractnomineedetail_db_oracle.php");
    include_once("../api_oracle/contractadvancedetail_db_oracle.php");
    include_once("../api_oracle/contractreceiptdetail_db_oracle.php");
    include_once("../api_oracle/contractphotodetail_db_oracle.php");
    include_once("../api_oracle/contractfingerprintdetail_db_oracle.php");
    include_once("../api_oracle/contractsigndetail_db_oracle.php");
class contract_13
{	
	public $contractid;
    public $connection;
    
	public function __construct(&$connection)
	{
		$this->connection = $connection;
	}

    function printpageheader(&$pdf,&$liney,$contractid)
    {
        $contract1 = new contract($this->connection);

		if ($contract1->fetch($contractid))
		{
            $liney = 190;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'हंगाम:'.$contract1->seasonname_unicode,0,'L',false,1,65,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'शुगर केन हार्वेस्टर (मशीन) ऊस तोडणी-वाहतूक करारनामा',0,'L',false,1,65,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $curdate = date('d/m/Y');
			$pdf->multicell(180,10,'आज तारीख '.$curdate.' रोज चे दिवशी मौजे भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून घेणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->SetFont('siddhanta', '', 11, '', true);
            $liney = $liney+5;
            $pdf->multicell(100,10,'मा. मॅनेजर / सेक्रेटरी',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट), भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
            $servicecontractor11 = new servicecontractor($this->connection);
			$servicecontractor11->fetch($contract1->servicecontractorid,$contract1->contractcategoryid);
            
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून देणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(25,10,'वय: '.$contract1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'वहातूकदार',0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            /* $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid); */
            
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);

			/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,110,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);
 */
   			$liney = $liney+5;
			$pdf->line(43,$liney,200,$liney);
            $liney = $liney+2;
            //$liney = $liney+10;

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor11->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+3;
            $pdf->multicell(25,10,'वय: '.$contract1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'तोडणीदार',0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+3;
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor11->address_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->AddPage();
            $html0 = '<span style="text-align:center;">
<br>कराराच्या शर्ती व अटी<br></span>';
            $pdf->SetFont('siddhanta', '', 13, '', true);
			$pdf->writeHTML($html0, true, 0, true, true);
            $html = '<span style="text-align:justify;">
            1) मी श्री.छत्रपति सहकारी साखर कारखाना लि., भवानीनगर यांचेमार्फत शुगर केन हार्वेस्टर मशीन खरेदी केलेले असून सदरचे हार्वेस्टर मशीनचा कारखान्याकडे तोडणीचा करार केलेला आहे. सदरचे करारान्वये तोडणी केलेला ऊस कारखान्यावर वाहतूक करणेकरिता माझे मार्फत खालील नावाप्रमाणे 8 (आठ) ट्रॅक्टरचे करार करून देत आहे.<br>
2) चालु गळीत हंगामासाठी म्हणजे <u>'.$contract1->seasonname_unicode.'</u> च्या गळीत हंगामासाठी मी तुम्हांला केवळ ऊसाच्या वाहतूकीच्या कामासाठी संस्थेस 8 ट्रॅक्टर पुरविण्याचे या करारान्वये मान्य करत आहे. मी तुमच्या संस्थेस वाहतुकीसाठी जे 8 ट्रॅक्टर लावत आहे. त्यांची नावे व ट्रॅक्टर रजिस्टर नंबर्स खालीलप्रमाणे <br>
</span>';
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->writeHTML($html, true, 0, true, true);
            $html =
            '<table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width:5%;">अ.नं.</th>
                <th style="width:45%;">ट्रॅक्टर मालकाचे नाव</th>
                <th style="width:20%;">ट्रॅक्टर रजिस्टर नंबर</th>
                <th style="width:15%;">ट्रेलर १ </th>
                <th style="width:15%;">ट्रेलर २ </th>
            </tr>
        </thead>
        <tbody>';
        $query = "select s.name_unicode,d.vehiclenumber
        from contract c,contracttransportdetail d,servicecontractor s 
        where c.active=1 and d.active=1 
        and c.contractid=d.contractid 
        and c.servicecontractorid=s.SERVICECONTRACTORID
        and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $html .= '<tr>
                <td style="width:5%;">' . $i++ . '</td>
                <td style="width:45%;">' . $row['NAME_UNICODE'] . '</td>
                <td style="width:20%;">' . $row['VEHICLENUMBER'] . '</td>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
            </tr>';
        }
        

        $html .= '</tbody>
            </table>
        </span>';
        $pdf->writeHTML($html, true, 0, true, true);
            
			
            
			$html1 = '<span style="text-align:justify;">
3) आपली संस्था ही एक विश्वस्त संस्था आहे व तिचा व्यवसाय सहकारी साखर कारखान्यात ऊस तोडणी-मजूर, वाहतूक व्यवस्था पुरविणे असा आहे. तुमच्या संस्थेशी बैलगाडी मुकादम हे मजूर, गडी-माणसे, बैलगाड्या पुरविणेसाठी करार मदार करतात तर ट्रक, ट्रॅक्टर, हार्वेस्टर मालक स्वतः समक्ष तुमचेशी करार मदार करतात.<br>
4) तुमचे संस्थेशी आम्ही फक्त ऊस वाहतूकीसाठी ट्रॅक्टर्स पुरविण्याचाच करार देत आहे. सबब ट्रॅक्टरवरील ड्रायव्हर, क्लीनर, यांशी तुमच्या संस्थेचा कसलाही संबंध नाही. ते सर्व इसम आमचे असतील व राहतील व त्यांचे पगार त्यांच्या कामाबाबतच्या अटी त्यांचा काही अपघात किंवा अपघाती मृत्यु झाल्यास त्याची सर्व जबाबदारी आमची राहील. व आमची आहे.<br>
5) कामगार संबंधितच्या सर्व कायद्यांचे पालन अगर त्या संदर्भांत होणा-या कोणत्याही संभाव्य कार्यवाहीची जबाबदारी आमचेवरच असेल त्यांच्याशी आपला संबंध नाही.<br>
6) ऊस तोडणी यंत्राणे (हार्वेस्टर मशीन) तोडणी केलेल्या ऊसास प्रति टनास रू. 365.94 तोडणी दर राहील. तसेच तोडणी दरावर 30 टक्के कमिशन राहील.<br>
7) माझेमार्फंत ऊस वाहतूक करणारे ट्रॅक्टर यंत्रणेस ऊस वाहतूक बिले ट्रॅक्टर यंत्रणेचे प्रचलित वाहतूक दराने अदा करावयाचे आहे. तसेच वाहतूक दरावर 20 टक्के कमिशन द्यावयाचे आहे. कोणत्याही कारणास्तव जादा कमिशन द्यावयाचे नाही. हे मला मान्य आहे.<br>
8) वाहतूकी दरम्यान अगर अन्य कोणत्याही कारणाने आमच्या ट्रॅक्टरचे काही रिपेरींग ही करणे निघाल्यास ती आम्ही आमच्या खर्चांने करावयाची आहेत त्याच्याशी तुमचा संबंध नाही.<br>
9) ऊस तोडणी यंत्राने सकाळी 8:00 वाजलेपासुन सांय.6:00 वाजेपर्यंतचे कालावधीमध्येच ऊस तोडणी करावयाची असलेने मी करार करून देत असलेने फक्त 8 ट्रॅक्टरच त्याच कालावधीमध्ये तोड केलेला ऊस वाहतूक करणेची जबाबदारी माझी राहील. तसेच करार करून देत असलेले ट्रॅक्टरचे व्यतिरिक्त अन्य कोणताही ट्रॅक्टर मी भरून कारखान्यावर पाठविणार नाही.<br>
10) हार्वेस्टर मशीनचे ऊस तोडणी चालु असताना प्लाँटमध्ये ऊसाच्या कांड्या पडणार नाहीत. याची दक्षता लिहून देणार यांनी घेणेची असून ऊस तोडणी केले नंतर प्लाँटमध्ये ऊसाच्या कांड्या पडलेचे निदर्शनास आलेस त्याची नुकसान भरपाईची रक्कम लिहून देणार यांचे तोडणी बिलातून कपात केले जाईल. हे लिहुन देणार यांना मान्य आहे.<br>
11) हार्वेस्टर ने ऊस तोडणी करताना ऊसाच्या स्वच्छ कांड्या गळीतास पाठवने आवश्यक आहे. ऊस कांड्या बरोबर पाचट आल्यास त्याचा कारखान्याचे रिकव्हरीवरती परिणाम होत असलेने या नुकसानीची जबाबदारी लिहुन देणार यांची राहील. व नुकसानीची रक्कम लिहून देणार यांचे ऊस तोडणी बिलातून लिहून घेणार यांनी परस्पर कपात करणेची आहे. त्यास लिहून देणार यांची मान्यता आहे.<br>
12) लिहून देणार यांनी लिहून घेणार यांचे ऊस तोडणी प्रोग्राँम प्रमाणे ऊस तोडणी करणेची असून तोडणी प्रोग्राँम व्यतिरिक्त ऊसाची तोड केलेस लिहून देणार यांचे तोडणी बिलातून दंडात्मक रक्कम कपात करणेत येईल. हे लिहून देणार यांना मान्य आहे.<br>
13) आम्ही करारान्वये वाहतूकीकरिता दिलेले ट्रॅक्टर अर्ध्यातून काम सोडून गेल्यास त्या ट्रॅक्टरचे जागी तोडणी केलेले ऊसाची वाहतूकीकरिता पर्यायी ट्रॅक्टरची व्यवस्था करणे माझेवर बंधनकारक राहील. परंतु मधुनच काम सोडून जाणारा ट्रॅक्टर मी वाहतूकीचे कामावर पुन्हा आणणार नाही.<br>
14) ट्रॅक्टरने ऊसाची करावयाची वाहतूक तत्परतेने व शेतक-यांचे कोणतेही नुकसान न होईल अशाच प्रकारे करू. ऊस तोडणी यंत्र अथवा इनफिल्डर ट्रॅक्टर चुकीचे चालविल्याने उत्पादकाचे ऊसाचे, मालमत्तेचे नुकसान झालेस अथवा जिवीत हानि झाल्यास त्यास सर्वस्वी मी म्हणजे लिहून देणार जबाबदार राहील. त्यास ट्रस्ट जबाबदार राहणार नाही.<br>
15) ऊस तोडणी यंत्र, इनफिल्डर तसेच वाहतुकीचे ट्रॅक्टर वरील ड्रायव्हर व अन्य मजुरांचा अपघाती विमा उतरविण्याची संपुर्ण जबाबदारी माझी राहील. ऊस तोडणी वाहतूकीचे कामाचे दरम्यान अपघात होऊन मजुराचा मृत्यू झाल्यास त्यांचे भरपाईची संपुर्ण जबाबदारी माझी राहील. त्याची तोषीस आपणास लागु देणार नाही. हे मला मान्य आहे.<br>
16) कारखान्याचे गाळप काही तांत्रिक अडचणीमुळे थांबलेस भरून येणारे ट्रॅक्टर खाली होणेस विलंब लागलेस त्याबाबत माझी कोणतीही तक्रार राहणार नाही.<br>
17) वाहतूकीदरम्यान अगर अन्य वेळी ट्रॅक्टरला कोणताही अपघात ब्रेकडाऊन घडल्यास त्याची सर्व जबाबदारी आमची राहील. तुमची संस्था वा संबंधीत कारखाना त्यास जबाबदार असणार नाही.<br>
18) कारखान्याचे दैनंदिन गाळपास अनुसरून कारखान्यावर दररोज भरून येणारे सर्व तोड-वाहतूक यंत्रणेचे केलेले नियोजनानुसारच माझे करारातील ट्रॅक्टर खाली करून घेतले जातील. त्यामध्ये सदरचे ट्रॅक्टर कोणताही अडथळा येईल. असे वर्तन करणार नाही. याची संपुर्ण जबाबदारी माझेवर राहील.<br>
19) आपणाकडून ॲडव्हान्स पोटी हार्वेस्टर मशीन देखभाल व दुरूस्तीकरिता रक्कम रूपये – 10,00,000/-(अक्षरी रक्कम रूपये दहा लाख फक्त) आम्हांस मिळणार आहे. त्याची अलहिदा पावत्या दिल्या जाणार आहेत. सदर रक्कम आपलेकडून ठरवून दिलेल्या हप्त्याप्रमाणे आम्हांस मिळणार आहे.<br>
सदर एकूण मिळालेल्या रक्कमेचा वसुल कारखान्याचे होणारे ऊसतोड वाहतूकीचे बिले, डिपाँझिट, कमिशन, फायनल पगारातून तुमचे नियमानुसार वसूल करून द्यावयाची आहे.<br>
20) माझे मार्फत वाहतूक करणारे वरील एकूण 8 (आठ) ट्रॅक्टर मालकांनी वहातूक केलेल्या ऊसाची वाहतूक बिले प्रत्येक ट्रॅक्टर मालकांचे नावे आमचे हिशोबाकरिता काढणेत यावीत. मात्र वाहतूक बिलातून डिझेलची रक्कम परस्पर कपात करून घेवून वाहतूक रक्कम रोखीने निघत असलेस सदरची रक्कम शुगर केन हार्वेस्टरचे तोडणी खात्यावर जमा करून घेणेत यावी.<br>
21) माझे नाव मु.पो.'.$servicecontractor1->address_unicode.' येथे गट नंबर ----------- / सर्व्हे नंबर ------------ मध्ये (7/12 व 8 अ इ.मिळकतीचे उतारे या करारासोबत जोडले आहेत.) जमीन मिळकत / घर मिळकत आहे. सदरील कराराचे पुर्ततेसाठी हमी व थकीत रक्कमेस सुरक्षा अनामत म्हणुन या कराराचा व त्या अनुषंगाने मी घेतलेल्या ॲडव्हान्सच्या पुर्ण अथवा उर्वरीत थकीत रक्कम कारखान्यास परतफेड करेपर्यंत सदर थकित रक्कमेचा बोजा माझे मिळकतीवर नोंदविण्यास मी या कराराने संमती देत आहे. मी स्वतः तशी नोंद करून द्यावयाची आहे. नोंद करून न दिल्यास कारखान्यास या कारारान्वये नोंद करून घेणेचा पुर्ण अधिकार राहील. हे मान्य व कबुल असलेबाबत मी या दस्ताव्दारे संमती व मान्यता देत आहे.<br>
22) कारखाना ट्रक, ट्रॅक्टर, ट्रॅक्टर-गाडी, बैलगाडी / टायरगाडी यांची वाहतूक मार्गावरील स्थिती जाणुन घेणेकामी प्रत्येक वाहनास जी.पी.एस. उपकरण देणार आहे. कंत्राटदारास मान्य व कबूल आहे कि, गळीत हंगामाच्या काळात वाहनास लावलेले जी.पी.एस.उपकरण चालू स्थितीत ठेवणे आवश्यक आहे. जर बंद ठेवल्यास त्या कालावधीकरिता दंड आकारला जाईल. आणि दंडाची रक्कम वाहतूकीच्या बिलातून कपात करून घेण्यात येईल. कारखाना बंद झालेचे जाहीर केल्यानंतर ऊस तोडणी व वाहतूकदाराने जी.पी.एस.उपकरण पुन्हा कारखान्यास सुस्थितीत परत करावयाचे आहे. जी.पी.एस.उपकरणाच्या मोबदल्याची रक्कम अनामत म्हणुन ऊस तोडणी व वाहतुकीच्या बिलातून कपात करून घेणेस मी या दस्ताव्दारे संमती व मान्यता देत आहे.<br>
23) प्रस्तुतच्या कराराव्दारे मी मान्य व कबुल करतो कि, कोरोना विषाणुचा अथवा तत्सम विषाणुचा प्रादुर्भाव रोखण्यासाठी आणि इतर कुठलीही परिस्थिती / घटना जी कारखान्याचे नियंत्रणाबाहेर आहे अथवा शासनाने जारी केलेल्या आदेशानुसार आणि अथवा जारी केलेल्या मार्गदर्शक तत्वांचे पालन करण्यास कारखाना बंद ठेवावा लागल्यास त्या दरम्यान बंदच्या काळात कारखाना कंत्राटदारास / ऊस तोडणी वाहतूकदारांस कोणतीही रक्कम अदा करणार नाही. तसेच कंत्राटदारास / ऊस तोडणी व वाहतूकदारांस होणा-या कोणत्याही प्रकारच्या आर्थिंक नुकसानीस कारखाना जबाबदार राहणार नाही. तसेच त्यावरून मी भविष्यात कोणताही वाद अथवा भांडण / तंटा उपस्थित करणार नाही.<br>
</span>';
            
            
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$pdf->writeHTML($html1, true, 0, true, true);

            //$liney = $liney+60;
            //$pdf->writeHTML($html6, true, 0, true, true);
            //$liney = $liney+60;
            //$liney = 160;

            $pdf->SetFont('siddhanta', '', 11, '', true);
            //$pdf->addpage();
            $liney = $pdf->getY();
            if ($liney+20 >= 260)
				{
					//$pdf->line(15,$liney,200,$liney);
					$liney = 30;
					$pdf->AddPage();
					//$this->printpageheader($pdf,$liney,$date,$saletransactionid);
				}
			$pdf->multicell(40,10,'स्थळ: भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$curdate = date('d/m/Y');
            $pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            
			$contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contracttransportphotodetail($this->connection,$contract1->contractid,1);

			$imgdata = $contractphotodetail1->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,170,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contracttransportfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,130,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

            $contractsigndetail1 = new contractsigndetail($this->connection);
			$contractsigndetail1 = $this->contracttransportsigndetail($this->connection,$contract1->contractid,1);

			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

			$pdf->multicell(60,10,'करारनामा लिहून देणार वाहतूकदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+10;

            $contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contractharvestphotodetail($this->connection,$contract1->contractid,1);

			$imgdata = $contractphotodetail1->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,170,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contractharvestfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,130,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

            $contractsigndetail1 = new contractsigndetail($this->connection);
			//$contractsigndetail1 = $this->contractharvestsigndetail($this->connection,$contract1->contractid,1);

			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

			$pdf->multicell(60,10,'करारनामा लिहून देणार तोडणीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor11->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+10;

			//QRCODE,H : QR-CODE Best error correction
			//$pdf->write2DBarcode('www.swapp.co.in', 'QRCODE,H', 140, 210, 25, 25, $style, 'N');
			//$pdf->Text(140, 205, 'Swapp Software Application');

			$name_unicode = $this->contractagriofficername($this->connection,$contract1->seasonid);
            $sign = $this->contractagriofficersign($this->connection,$contract1->seasonid);
			$signdata = $sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

            $pdf->multicell(60,10,'करारनामा लिहून घेणार',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
			//$liney = $liney+5;
			$pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
			$pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
			$pdf->line(30,$liney,100,$liney);
			$liney = $liney+2;
			$pdf->multicell(100,10,'मा. शेतकी अधिकारी सो',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$liney = $liney+5;

            /* $contractguarantordetail1 = new contractguarantordetail($this->connection);
			$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1);
			$servicecontractor_guarantor1 = new servicecontractor($this->connection);
			$servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);

            /* $area1 = new area($this->connection);
            $area1->fetch($servicecontractor_guarantor1->areaid); */

            /* $contractguarantordetail2 = new contractguarantordetail($this->connection);
			$contractguarantordetail2 = $this->contractguarantordetail($this->connection,$contract1->contractid,2);
			$servicecontractor_guarantor2 = new servicecontractor($this->connection);
			$servicecontractor_guarantor2->fetch($contractguarantordetail2->servicecontractorid);
 */
            /* $area2 = new area($this->connection);
            $area2->fetch($servicecontractor_guarantor2->areaid); */

            /* $contractphotodetail2 = new contractphotodetail($this->connection);
			$contractphotodetail2 = $this->contractguarantorphotodetail($this->connection,$contract1->contractid,1);

			$imgdata2 = $contractphotodetail2->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata2,120,$liney,25,25);

			$contractfingerprintdetail2 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail2 = $this->contractguarantorfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata2 = $contractfingerprintdetail2->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata2,160,$liney,25,25); */ 

            $contractguarantordetail1 = new contractguarantordetail($this->connection);

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(35,10,'जामीनदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            
            $list1 = $contract1->guarantorcontractorlist();
            $i=0;
            foreach ($list1 as $value)
            {
                if ($liney+20 >= 260)
				{
					//$pdf->line(15,$liney,200,$liney);
					$liney = 30;
					$pdf->AddPage();
					//$this->printpageheader($pdf,$liney,$date,$saletransactionid);
				}
                $val = intval($list1[$i]);
                $contractguarantordetail1 = new contractguarantordetail($this->connection);
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1 = new servicecontractor($this->connection);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
                
                $pdf->multicell(35,10,++$i.')जामीनदार',0,'L',false,1,15,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->rect(70,$liney,10,10);
                $liney = $liney+14;
                $pdf->multicell(60,10,'सही',0,'L',false,1,70,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->multicell(35,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
                $pdf->multicell(100,10,$servicecontractor_guarantor1->name_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);
                $liney = $liney+5;
                
                $contractphotodetail1 = new contractphotodetail($this->connection);
			    $contractphotodetail1 = $this->contractguarantorphotodetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $imgdata2 = $contractphotodetail1->photo;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                $pdf->setJPEGQuality(90);
                $pdf->Image('@'.$imgdata2,170,$liney-25,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

                $contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
                $contractfingerprintdetail1 = $this->contractguarantorfingerprintdetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $fingerprintdata1 = $contractfingerprintdetail1->fingerprint;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                $pdf->setJPEGQuality(90);
                $pdf->Image('@'.$fingerprintdata1,130,$liney-25,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);


                $contractsigndetail1 = new contractsigndetail($this->connection);
			    $contractsigndetail1 = $this->contractguarantorsigndetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $signdata2 = $contractsigndetail1->sign;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                //$pdf->setJPEGQuality(90);
                $pdf->Image('@'.$signdata2,50,$liney-25,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
                /* $file_pointer = '../fingerprint/bmp/'.$contractfingerprintdetail1->contractfingerprintdetailid.'.bmp';
                if (file_exists($file_pointer)) 
                {
                    $file_pointer1 = '../fingerprint/jpg/'.$contractfingerprintdetail1->contractfingerprintdetailid.'.jpg';
                    if (file_exists($file_pointer1)) 
                    {
                        //$pdf->Image($file_pointer,120,$liney-25,25,25);
                        $pdf->Image($file_pointer1, 130,$liney-25,25,25, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
                    }
                    else
                    {
                        $this->convertImage($file_pointer,$file_pointer1,100);
                    }
                }
                else
                {
                    $pdf->multicell(100,10,$contractfingerprintdetail1->contractfingerprintdetailid,0,'L',false,1,45,$liney-25,true,0,false,true,10);
                } */
                $liney = $liney+5;
            }
            
            $liney = $liney+5;
            $pdf->line(30,$liney,60,$liney);
            $pdf->line(70,$liney,100,$liney);
            $liney = $liney+2;
            $liney = $liney+5;
			
            /* $servicecontractor_ao1 = new servicecontractor($this->connection);
			$servicecontractor_ao1 = $this->contractagriofficerdetail($this->connection);

			$pdf->multicell(60,10,'सही',0,'L',false,1,110,$liney,true,0,false,true,10);
			//$liney = $liney+5;
            $pdf->rect(150,$liney,10,10);
            $liney = $liney+14;
			$pdf->multicell(100,10,'नाव:',0,'L',false,1,110,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_ao1->name_unicode,0,'L',false,1,130,$liney,true,0,false,true,10);
            $liney = $liney+5;
			$pdf->line(120,$liney,200,$liney);
			$liney = $liney+2;
			$pdf->multicell(100,10,'मुख्य शेतकी अधिकारी',0,'L',false,1,110,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'श्री छत्रपति सहकारी साखर कारखाना लि.',0,'L',false,1,110,$liney,true,0,false,true,10);
 */
		}
    }

    function contracttransportdetail(&$connection,$contractid)
    {
        $contracttransportdetail1 = new contracttransportdetail($connection);
        $query = "select d.contracttransportdetailid from contract c,contracttransportdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contracttransportdetail1->fetch($row['CONTRACTTRANSPORTDETAILID']);
            return $contracttransportdetail1;
        }
    }

    function contractharvestdetail(&$connection,$contractid)
    {
        $contractharvestdetail1 = new contractharvestdetail($connection);
        $query = "select d.contractharvestdetailid from contract c,contractharvestdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractharvestdetail1->fetch($row['CONTRACTHARVESTDETAILID']);
            return $contractharvestdetail1;
        }
    }

    function contracttransporttrailerdetail(&$connection,$contracttransportdetailid,$sequencenumber)
    {
        $contracttransporttrailerdetail1 = new contracttransporttrailerdetail($connection);
        $query = "select t.contracttransporttrailerdetailid from contract c,contracttransportdetail d, contracttransporttrailerdetail t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.contracttransportdetailid=t.contracttransportdetailid and t.contracttransportdetailid=".$contracttransportdetailid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contracttransporttrailerdetail1->fetch($row['CONTRACTTRANSPORTTRAILERDETAILID']);
                return $contracttransporttrailerdetail1;
                exit;
            }
            else
            {
                $i++;	
            }
        }
    }

    function contractperformancedetail(&$connection,$contractid)
    {
        $contractperformancedetail1 = new contractperformancedetail($connection);
        $query = "select d.contractperformancedetailid from contract c,contractperformancedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractperformancedetail1->fetch($row['CONTRACTPERFORMANCEDETAILID']);
            return $contractperformancedetail1;
        }
    }

    function contractguarantordetail(&$connection,$contractid,$sequencenumber)
    {
        $contractguarantordetail1 = new contractguarantordetail($connection);
        $query = "select d.contractguarantordetailid from contract c,contractguarantordetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.servicecontractorid=t.servicecontractorid and c.contractid=".$contractid." order by t.servicecontractorcategoryid desc,d.contractguarantordetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractguarantordetail1->fetch($row['CONTRACTGUARANTORDETAILID']);
                return $contractguarantordetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractnomineedetail(&$connection,$contractid,$sequencenumber)
    {
        $contractnomineedetail1 = new contractnomineedetail($connection);
        $query = "select d.contractnomineedetailid from contract c,contractnomineedetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.nomineeid=t.servicecontractorid and c.contractid=".$contractid." order by d.contractnomineedetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractnomineedetail1->fetch($row['CONTRACTNOMINEEDETAILID']);
                return $contractnomineedetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractadvancedetail(&$connection,$contractid,$sequencenumber)
    {
        $contractadvancedetail1 = new contractadvancedetail($connection);
        $query = "select d.contractadvancedetailid from contract c,contractadvancedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractadvancedetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractadvancedetail1->fetch($row['CONTRACTADVANCEDETAILID']);
                return $contractadvancedetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractreceiptdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractreceiptdetail1 = new contractreceiptdetail($connection);
        $query = "select d.contractreceiptdetailid from contract c,contractreceiptdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractreceiptdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractreceiptdetail1->fetch($row['CONTRACTRECEIPTDETAILID']);
                return $contractreceiptdetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contracttransportphotodetail(&$connection,$contractid,$sequencenumber)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        $query = "select d.contractphotodetailid from contract c,contracttransportdetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractphotodetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
                return $contractphotodetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contracttransportsigndetail(&$connection,$contractid,$sequencenumber)
    {
        $contractsigndetail1 = new contractsigndetail($connection);
        $query = "select d.contractsigndetailid from contract c,contracttransportdetail t,contractsigndetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractsigndetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractsigndetail1->fetch($row['CONTRACTSIGNDETAILID']);
                return $contractsigndetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    /* function contractguarantorphotodetail(&$connection,$contractid,$sequencenumber)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        $query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
                return $contractphotodetail1;
            }
            else
            {
                $i++;
            }
        }
    } */

    function contracttransportfingerprintdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        $query = "select d.contractfingerprintdetailid from contract c,contracttransportdetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractfingerprintdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
                return $contractfingerprintdetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    /* function contractguarantorfingerprintdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        $query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
                return $contractfingerprintdetail1;
            }
            else
            {
                $i++;
            }
        }
    } */

    function contractmddetail(&$connection)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select t.servicecontractorid from servicecontractor t where t.active=1 and t.servicecontractorcategoryid = 874536268";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $servicecontractor1->fetch($row['SERVICECONTRACTORID']);
                return $servicecontractor1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractagriofficername(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select agriofficernameuni from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['AGRIOFFICERNAMEUNI'];
        }
    }
    function contractagriofficersign(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select sign from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['SIGN']->load();
        }
    }
    function contractguarantorphotodetail(&$connection,$contractid,$guarantorid)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        //$query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,1) as CONTRACTPHOTODETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
            return $contractphotodetail1;
        }
    }

    function contractguarantorsigndetail(&$connection,$contractid,$guarantorid)
    {
        $contractsigndetail1 = new contractsigndetail($connection);
        //$query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,3) as CONTRACTSIGNDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractsigndetail1->fetch($row['CONTRACTSIGNDETAILID']);
            return $contractsigndetail1;
        }
    }

    function contractguarantorfingerprintdetail(&$connection,$contractid,$guarantorid)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        //$query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,2) as CONTRACTFINGERPRINTDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($connection, $query);             $r = oci_execute($result);
        $i=1;
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
            return $contractfingerprintdetail1;
        }
    }
   function contractharvestphotodetail(&$connection,$contractid,$sequencenumber)
{
    $contractphotodetail1 = new contractphotodetail($connection);
    $query = "select d.contractphotodetailid from contract c,contractharvestdetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractharvestdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=254156358 order by d.contractphotodetailid";
    $result = oci_parse($connection, $query);             $r = oci_execute($result);
    $i=1;
    while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
    {
        if ($i==$sequencenumber)
        {
            $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
            return $contractphotodetail1;
        }
        else
        {
            $i++;
        }
    }
}

function contractharvestfingerprintdetail(&$connection,$contractid,$sequencenumber)
{
    $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
    $query = "select d.contractfingerprintdetailid from contract c,contractharvestdetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractharvestdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=254156358 order by d.contractfingerprintdetailid";
    $result = oci_parse($connection, $query);             $r = oci_execute($result);
    $i=1;
    while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
    {
        if ($i==$sequencenumber)
        {
            $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
            return $contractfingerprintdetail1;
        }
        else
        {
            $i++;
        }
    }
}
}
?>