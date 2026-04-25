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
class contract_14
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
            
            $pdf->multicell(100,10,'श्री.छत्रपति सहकारी साखर कारखाना लि., भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'ता.इंदापूर, जि.पुणे तर्फे कार्यकारी संचालक,',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'श्री.अशोक भार्गव जाधव, उ.व.54 वर्षे, धंदा - नोकरी',0,'L',false,1,15,$liney,true,0,false,true,10);
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
            $html0 = '<span style="text-align:justify;">
आपल्या कारखान्यातर्फे केन हार्वेस्टरव्दारे ऊस तोडणी करण्याची शक्यता सभासदांपुढे मांडली असता इच्छुक सभासदांनी वैयक्तिकरित्या असे हार्वेस्टर घेण्याची व कारखान्याकडे ऊस तोडणीकामी देण्याचे मान्य केले. मात्र त्यासाठी अशा इच्छुक सभासदांना बँकेचे वा कंपन्यांचे कर्ज घेणे आवश्यक आहे. व त्यासाठी कारखान्याने फक्त प्राथमिक मदत करावी अशी विनंती केल्यानंतर हा करारनामा लिहून देणार यांनी करून दिला असे.
<br></span>';
$pdf->SetFont('siddhanta', '', 11, '', true);
$pdf->writeHTML($html0, true, 0, true, true);
$html0 = '<span style="text-align:center;">
या कराराच्या अटी खालीलप्रमाणे<br></span>';
$pdf->SetFont('siddhanta', '', 13, '', true);
$pdf->writeHTML($html0, true, 0, true, true);
			$html1 = '<span style="text-align:justify;">
1)	कारखान्यातर्फे हार्वेस्टर घेणा-या इच्छुक सभासदांना त्यांनी हार्वेस्टर विक्री करणा-या कंपनीकडे बुकींग करणेकामी जी ॲडव्हान्स रक्कम भरावी लागते त्यासाठी अशा सभासदास रक्कम रू.25-00 लाख (अक्षरी रूपये पंचवीस लाख) देतील की जी ते कारखाना कंपनीच्या नावे चेक ड्राफ्ट आर.टी.जी.एस. रूपाने देईल. सदर रक्कम सभासदांस ॲडव्हान्स रूपाने दिली जाईल. जी त्यांच्या येणा-या ऊसाच्या बिलातून तसेच हार्वेस्टरने केलेल्या कामाच्या रक्कमेतून दरवर्षी ठरावीक रक्कम रू.5-00 लाख (अक्षरी पाच लाख) वळती करून घेतली जाईल.<br>
2)	सदर ॲडव्हांन्सची रक्कम फेडायची मुदत 5 वर्षांची आहे. या काळातील लिहून देणार यांच्या येणा-या ऊसातून व भाडे रक्कमेतून कारखान्याने रक्कम वसुल करून घेण्याची आहे. व उभयतातील समजुतीप्रमाणे लिहून देणार यांच्या येणा-या ऊसातून व भाडे रक्कमेतून दरवर्षी रू.5-00 लाख एवढी रक्कम वळती करून घेण्याची आहे.<br>
3)	लिहून देणार हे वरील ॲडव्हान्स 5 वर्षे मुदतीत फेडणेसाठी दोन सक्षम जामीनदार देतील. जे लिहून देणार यांनी घेतलेल्या ॲडव्हांन्स रक्कम रू.25-00 लाख वैयक्तिक ल सामुहिकरित्या जबाबदार राहतील व तसा जामीन करावा ते हि कारखान्यास लिहून देतील.<br>
4)	लिहून देणार या कराराव्दारे असे आश्वासन देतात की, ते कारखान्याच्या 2024-25 ते 2030-31 या प्रत्येक वर्षीच्या क्रशींग सिझनमध्ये आणि ॲडव्हांन्स रक्कम फिटेपावेतो हार्वेस्टर लिहून घेणार कारखान्याच्या ऊस तोडणीकामी लावतील. अन्य कोणत्या कारखान्यास वा अन्य कोणास लावणार नाहीत. अन्यथा असे कृत्य कारखान्याची फसवणूक या सदरात पडेल याची लिहून देणार यांना पुर्ण कल्पना आहे.<br>
5)	लिहून घेणार कारखाना हा ज्या कोणत्या कंपनीचा हार्वेस्टर त्याच कंपनीच्या कर्जांने घेतील अथवा बँक प्रकरण करून घेतील त्या कर्जांस वा त्याच्या हप्त्यास कारखाना जबाबदार असणार नाही. तसेच 5 वर्षापावेतो अगर लिहून घेणार यांच्या ॲडव्हांन्स रक्कमेची पुर्ण फेड होईपावेतो लिहून देणार हे अशा कंपनीमार्फत वा बँकेमार्फत त्यांच्या येणा-या ऊसातून पेमेंट घ्यावे, असे अधिकार कंपनीस वा बँकेस देणार नाहीत. व ही अट स्पष्टपणे त्यांचे निदर्शनास
आणणेसाठी हा करार व त्यातील प्रस्तुत अट क्र.5 हायलाईट करून लिहून देणार हे कंपनीच्या वा बँकेच्या निदर्शनास आणतील व त्याची पोहोच कारखान्यास देतील.<br>
6)	लिहून देणार हे दरवर्षी रू.5-00 लाख रूपयाचा हप्ता त्यांच्या ऊस बिलातून व हार्वेस्टरच्या भाड्यातून देवू न शकल्यास त्यावर द.सा.द.शे. 12 टक्के प्रमाणे व्याज नुकसानी देण्याचे त्यांना मान्य आहे.<br> 
7)	कारखान्याच्या पुर्ण रक्कमेची फेड झाल्यास व झाल्यावरच कारखाना आपले भाड्याची रक्कम वा ऊस बिलाची रक्कम आमच्या संमतीने ( वा कोर्ट हुकूमाने ) संबंधीत बँकेस वा कंपनीस देवू शकेल . अन्यथा कारखान्याची ॲडव्हांन्स रूपाने घेतलेल्या रक्कमेची पुर्ण फेड होईपावेतो आम्हांस तसे करता येणार नाही.<br>
येणेप्रमाणे करार करून दिला असे.<br>
8) मी व माझे वहातुकदार ऊस तोडणी हार्वेस्टर घेऊन श्री.छत्रपति सहकारी साखर कारखाना लि., चे ऊस उत्पादकांचे ऊस तोडणीसाठी चालू हंगामात कारखाना कार्यक्षेत्रात येऊ व ऊस पुरवठादाराकडून तोडणी वाहतूकीचे काम जय भवानी सर्व सेवा संघ (ट्रस्ट), भवानीनगर यांच्याशी योग्य तो करार करून 2024-2025 ते 2029-2030 पर्यंतची ऊस तोडणी व वहातूकीचे काम करू.<br>
9) ऊस उत्पादक यांनी पिकविलेला ऊस तोडणी प्रोग्रॅम प्रमाणे व कारखान्याकरिता हार्वेस्टर व त्यापाठीमागील ट्रक-ट्रॅक्टर भरून व वहातूक करून कारखान्याचे वजन काट्यावर वजन करून गव्हाणी पर्यंत आणून देणेचे सर्व कामाची जबाबदारी घेऊन सिझन संपेपर्यंत काम पूर्ण करू.<br>
10) कंत्राटदारांनी ऊस व्यवस्थित भुईसपाठ तोडून पालापाचोळा पाचट विरहीत वाढे व्यवस्थित मारलेला, काढलेली मुळ्याची माती साफ केलेला, ऊस पुरवठा करणेचा आहे.<br>
11) कंत्राटदारांस ऊस तोडणी वाहणामध्ये भरणे व तो कारखान्यामार्फंत आणून पोहोच करणे यासाठी वेळोवेळी ठरवले जाते त्याप्रमाणे दर देणेत येईल. तो दर आम्हांस व तोडणीदारास मान्य आहे.<br>
12) हार्वेस्टर मशिन मालक व त्यांचे मजूरांची संपुर्ण माहिती गळीत हंगाम चालू झाल्यानंतर 15 दिवसांत संस्थेस द्यावयची आहे. माहिती मिळाल्यानंतर मजूरांस कोणत्याही प्रकारची दुखापत, अपघात, मृत्यू झालेस विमा कंपनीस कळविण्यात येईल. व विमा कंपनीच्या अटी व शर्तीप्रमाणे पुढील कार्यवाही करण्यात येईल. त्याची कागदपत्रे विमा कंपनीस देणेची जबाबदारी काँन्ट्रॅक्टर यांची राहील.<br>
13) या कराराची मुदत सन 2024-2025 ते 2029-2030 या गळीत हंगामासाठी असलेने सदर गळीत हंगाम सुरू झालेपासुन बंद होईपर्यंत राहील.<br>
14) ऊस तोडणी हार्वेस्टर मशिनसाठी व ऊस वहातूकीसाठी नेमलेल्या ड्रायव्हर्स, क्लिनर्स, गाडीवान मजूर यांचे गैरवर्तणुकीस व बेजबाबदार कृतीस हार्वेस्टर मशिन मालक हे जबाबदार राहतील व यासंबंधित इसमाच्या वर कारवाई करण्याची जबाबदारी ही सर्वस्वीपणे हार्वेस्टर मशिन मालक यांची राहील. या प्रकारामध्ये संस्थेस अथवा सभासदास अगर बिगर-सभासदास आलेल्या नुकसानीची भरपाई हार्वेस्टर मशिन मालक यांनी करून देणेची आहे.<br>
15) या कराराच्या कालावधीमध्ये ऊस तोडणी हार्वेस्टर मशिन मालक यांनी त्यांचेकडील वाहने व मजूर संस्थेच्या सुचनेप्रमाणे सभासदांचे बिगर सभासदांचे ऊस तोडणी व वाहतूकीसाठीच वापरणेचे आहे.<br>
16) ऊस तोडणी / वाहतूकीमध्ये सभासद व बिगर-सभासद वा संस्थेचे कोणत्याही प्रकारचे नुकसान होणार नाही याची जबाबदारी हार्वेस्टर मशिन मालक यांचेवर राहील. यासाठी योग्य ते नियंत्रण तोडणी हार्वेस्टर मशिन मालक यांनी त्याचे मजूरांवर ठेवणेचे आहे. असे नुकसान झाल्यास त्याची नुकसान भरपाई हार्वेस्टर मशिन मालक यांनी करणेची आहे. व अशी रक्कम हार्वेस्टर मशिन मालक यांचे बिलातून व इतर देय रक्कमेतून कपात करून घेणेचे अधिकार संस्थेस राहील.<br>
17) सभासद व बिगर-सभासद ऊस तोडणी हार्वेस्टर मशिन मालक यांनी नेमलेले मजूर अथवा नियोजित केलेले वाहन नादुरूस्त झाल्यास त्यांसंबंधी पर्यायी व्यवस्था करणेची संपूर्ण जबाबदारी हार्वेस्टर मशिन मालक यांची राहील. यासंदर्भांत कोणतीही सबब हार्वेस्टर मशिन मालक सांगणार नाही.<br>
18) करार काळात हार्वेस्टर मशिन मालक हे करार केलेले हार्वेस्टर मशिन दुसरीकडे कामास लावणार नाही, अशा प्रकारे वाहन दुसरीकडे लावल्याचे संस्थेचे निदर्शनास आल्यास संस्थेची नुकसान भरपाईची रक्कम हार्वेस्टर मशिन मालकाच्या संस्थेकडे असलेल्या देय रक्कमेतून अथवा रोखीने संस्था ठरवतील ती रक्कम वसुल करील अथवा रक्कम वसुल न झाल्यास त्याची कायदेशीर कारवाई करावी लागल्यास त्याच्या संपुर्ण खर्चांची जबाबदारी हार्वेस्टर मशिन मालक यांची राहील.<br>
19) हार्वेस्टर मशिन मालक यांचे वाहनांसाठी डिझेल, आँईल इत्यादी सामान पुरविले असेल त्यांचे बील हार्वेस्टर मशिन मालक यांचे पुढील नजीकच्या बिलातून कपात करून घेतले जाईल.<br>
20) हार्वेस्टर मशिन मालक यांचेकडीूल ड्रायव्हर्स, क्लिनर्स, मजूर इत्यादीचे हजेरी पुस्तक , रजा पगार सुट्टया वैगेरेचे रेकाँर्ड ठेवणेची जबाबदारी हार्वेस्टर मशिन मालक यांची आहे. व या सर्व इसमाचे बाबतीत उदभवणा-या कामगार प्रश्नांची सोडवणूक हार्वेस्टर मशिन मालक यांनी सर्वस्वी स्वतः करणेची आहे. त्याची तोषिस कारखान्यास लागू देणार नाही, तशी तोषिश संस्थेस लागलेस त्याची भरपाई कंत्राटदार यांनी करून देणेची आहे. किंवा त्यांचे बिलातून कपात करून घेणेची आहे. अशा सर्व व्यक्ती निव्वळ हार्वेस्टर मशिन मालकाचे नोकर अथवा त्यांचे नियंत्रणाखाली आहेत त्यामुळे कामगार कायद्याच्या काही तरतुदी लागू होत असलेस त्याची पूर्ण जबाबदारी हार्वेस्टर मशिन मालक यांची आहे. संस्थेचा त्यांचेशी कसल्याही प्रकारचा संबंध नाही.<br>
21) हार्वेस्टर मशिन मालक यांचे मजूरांची राहणेची सोय त्यांनी करणेची आहे. प्रसंगी अशी सोय करणेसाठी कोयते, वायररोप, चटई, बांबू, तंबू वगैरे साहित्य तुम्ही घेवुन द्यावे. त्याची रक्कम आमच्या कामाच्या बिलातून, डिपाँझिट व कमिशन रक्कमेतून परस्पर वसुल करून घ्यावी.<br>
22) संस्थेने दर पंधवड्याचे बिल हार्वेस्टर मशिन मालक यांना सर्व कपाती करून देणेचे आहे.<br>
23) हार्वेस्टर मशिन मालक यांनी त्यांच्या पंधरवड्याच्या बिलातून शेकडा 10 % रक्कम डिपाँझिट म्हणून संस्थेकडे ठेवणेचे आहेत. सदर डिपाँझिट रक्कम गाळप हंगाम संपल्यानंतर बिनव्याजी परत देणेचे आहेत.<br>
24) हार्वेस्टर मशिन मालक यांनी कराराच्या कोणत्याही अटीचा भंग केल्यास जनरल स्पेशल लिव्कीडेटेड डॅमेजेस रक्कम म्हणून रू.---------------------------------- नुकसान भरपाई दाखल कंत्राटदार यांनी संस्थेस देणेची आहे.<br>
25) सदर कराराचे पोटी हार्वेस्टर मशिन मालक यांना खालीलप्रमाणे ॲडव्हान्स रक्कम दिलेल्या आहेत.<br>
लिहून देणार हार्वेस्टर मशिन मालक<br>
1	हप्ता	रू.		दिनांक<br>
2	हप्ता	रू.		दिनांक<br>
3	हप्ता	रू.		दिनांक<br>
प्रमाणे माझे बँक                      शाखा                अकौंट नंबर             वर मला मिळाले काही तक्रार नाही.<br>
सदरची ॲडव्हान्स रक्कम कामापोटी कराराप्रमाणे लिहून देणार यांना वरील रक्कम दिलेली असून, सदरची रक्कम स्विकारून त्याच्या वैयक्तिक व संयुक्त जबाबदारीवर खातेवरून काढणेचे आहे. सदर तिन्ही हार्वेस्टर मशिन मालक यांनी ॲडव्हान्स रक्कम कराराप्रमाणे कामाच्या बिलातून मुदतीत फेड न केलेस अगर कराराप्रमाणे मुदतीत काम सुरू न केलेस ॲडव्हान्सची रक्कम व त्यावर द.सा.द.शे. 18 % प्रमाणे व दंड अशी सर्व रक्कम रोखीने चेकने परत करणेची आहे. ऊस तोडणी हार्वेस्टर मशिन मालक यांची उचल ॲडव्हान्स वजा जाता शिल्लक राहिलेली रक्कम हार्वेस्टर मशिन मालक यांच्या खातेवर वर्ग करण्यात येईल.<br>
26)	संस्थेस हार्वेस्टर मशिन मालक यांनी दर पंधरवड्यास होणा-या कामाच्या बिलातून ॲडव्हान्सची संपूर्ण रक्कम वसूलीसाठी परत देणेची आहे. सर्व बिलातून अथवा हार्वेस्टर मशिन मालक व जामीनदार यांची कारखान्याकडे काही रक्कम जमा असलेस त्यातून कमिशन व डिपाँझिट अगर ॲडव्हान्स जमा रक्कमेतून अगर जामीनदाराचे देय रक्कमेतून ॲडव्हान्स व व्याजाची रक्कम कपात करून घेणेचा संस्थेस हक्क राहील.<br>
27)	सिझनच्या काळात कमीत कमी 100 % दिवस हार्वेस्टर मशिन व त्यामागील वहाने कामावर असतील त्याची नोंद हार्वेस्टर मशिन मालक यांनी घ्यावयाची आहे. व काम कमी झालेस त्या तोषीसला कारखान्यास जबाबदार धरू नये.<br>
28)	ॲडव्हान्स रक्कम व त्यावरील व्याज पूर्ण फेडीसाठी हार्वेस्टर मशिन मालक यांनी संस्थेस हार्वेस्टर मशिन तारण दिले आहे. व त्यांनी मौजे ------------------ ता.-----------------जि.---------------------- गट नं.------------- ची जमीन मिळकत तारण दिली आहे. तसा बोजा नोंद करून हार्वेस्टर मशिन मालक यांनी संस्थेस देणेचा आहे. त्याचा होणारा संपूर्ण खर्च हार्वेस्टर मालक यांनी करावयाचा आहे.<br>
29)	सदर वाहन कराराचे मुदतीत ऊश तोडणी वाहतूकीसाठी जरूर पडलेस आपले वाहन ताब्यात घेवुन चालविणेस व त्यासाठी जरूर तो खर्च करणेचा व तोडणी वाहतूक बिलातून तो खर्च काढून घेणेचा अधिकार संस्थेस राहील. मात्र वाहन चालविलेच पाहिजे, असे जबाबदारी संस्थेची नाही व त्याबाबत तक्रार करणेचा अधिकार हार्वेस्टर मशिन मालकास नाही. संस्थेच्या ॲडव्हान्स रक्कमेची परतफेड होईपर्यंत सदरचे वाहन केव्हाही ताब्यात घेणेचा अधिकार संस्थेस राहील. मशिन ताब्यात ठेवलेल्या मुदतीत कोणतीही नुकसानी हार्वेस्टर मशिन मालकांस मागता येणार नाही. तसे जरूरी वाटलेस संस्थेस जाहीर लिलावाव्दारे वाहन विक्रीचा अधिकार राहील. यासाठी हार्वेस्टर मशिन मालक यांची पूर्ण संमती आहे. वेगळ्या संमतीची आवश्यकता गरजेची नाही.<br>
30)	या कराराचे सर्व अटीचे पूर्ततेसाठी हार्वेस्टर मशिन मालक यांनी खालीलप्रमाणे जामीन दिले आहेत. कंत्राटदार व जामीनदार संस्थेचे अ वर्ग सभासद झाले आहेत.<br>
31)	कारखान्याच्या सोईच्या दृष्टीने व संस्थेच्या धोरणाप्रमाणे ऊसाचा पुरवठा व्यवस्थित होणेसाठी वाहन बदली केली जाईल. त्या त्या वेळी बदलीच्या ठिकाणी हार्वेस्टर मशिन मालक यांना आपले वाहन स्वखर्चांने विनातक्रार वेळेवर हजर ठेवणेचे आहे.<br>
32)	संस्थेने हार्वेस्टर मशिन मालक यांचेकरिता हार्वेस्टर मशिनचा विमा उतरविणेचा आहे. विम्याकरीता हार्वेस्टर मजूर यांची यादी हार्वेस्टर मशिन मालक यांनी संस्थेस देणेची आहे व सदर विमा हप्ता रक्कम कार्यवाही संस्थेच्या धोरणानुसार अगर शासकीय धोरणाचे करारानुसार करेल. हार्वेस्टर मशिन मालक यांनी संस्थेमार्फंत भरावयाचा आहे.<br>
33)	या कराराची व त्यातील सर्व तरतुदींची जबाबदारी लिहून देणार हार्वेस्टर मशिन मालक व त्यांचे वारसदारांचेवर तसेच जामीनदार यांचेवर संयुक्तिकरित्या व वैयक्तिकरित्या राहील. रक्कमेची परतफेड करार लिहून देणार (हार्वेस्टर मशिन मालक) तसेच जामीनदार यांची वैयक्तिक व संयुक्तिकरित्या राहील. अशी रक्कम करार लिहून देणार यांचेकडून येणे असल्यास व जामीनदारांची कारखान्याकडे काही रक्कम जमा असलेस त्यातून तशी रक्कम संस्था वसूल करून घेईल. याबाबत काही वाद निर्माण झालेस संस्था वसूलीकामे दावे अथवा फौजदारी खटले दाखल करेल. यास लिहून देणार व त्यांचे जामीनदार यांची मान्यता आहे. सदर कायदेशीरबाबींचे निवारणासाठी योग्य त्या न्यायालयात निराकरण होईल.<br>
34)	संबंधित कंत्राटदार यांनी त्यांचे वाहन, नियमित कामास ठेवुन सिझन सुरूवातीपासुन अखेरपर्यंत सोपविलेले काम नियमितपणे न केल्यास त्यांचे गैरहजेरीचे प्रमाण 20 % ते 50 % च्या दरम्यान असलेस त्याची कमिशन डिपाँझीटची रक्कम कपात करणेचा अधिकार संस्थेस राहील.<br>
35)	संबंधित हार्वेस्टर मशिन मालक यांनी त्यांचे वाहन, नियमित कायम ठेवुन सिझन सुरूवातीपासुन सिझन अखेरपर्यंत सोपविलेले काम नियमितपणे करणेचे आहे.<br>
36)	कारखान्याचे केनयार्डमध्ये वे ब्रीजवर हार्वेस्टर मशिन मालक अगर त्याचे मजूर भरतीच्या व रिकाम्या ट्रक, ट्रॅक्टरचे वजन कारखान्याचे नियमाप्रमाणे करून व त्या वजनाच्या स्लिपा घवुन त्या स्लिपप्रमाणे दाखवलेले वजन अंतिम / बरोबर समजणेत येईल. व त्याबाबत तक्रार असणार नाही.<br>
37)	कारखाना गळीत हंगाम सुरू होण्याच्या अगोदर 48 तास हार्वेस्टर मशिन मालक त्याचे हार्वेस्टर मशिन / ट्रक / ट्रॅक्टर / मजूर कारखान्याकडे हजर करेल. कारखाना सुरू होणेचा दिवस हार्वेस्टर मशिन मालक अगोदर संस्थेकडे येवुन माहिती करून घेणेची आहे. अथवा संस्था  त्यांना तो दिवस कळवेल.<br>
38)	मी ठरविल्याप्रमाणे ऊस तोडणी कामासाठी येणार आहे. मी सांगितल्यावरून त्याप्रमाणे माझे जामीनदाराने खाली सही करून दिलेवरून तुम्ही माझेवर जामीनदारावर विश्वास ठेवुन मजला तोडणी मजूराप्रमाणे ॲडव्हान्स दिला आहे. तरी मी वरीलप्रमाणे हार्वेस्टर मशिन घेवुन कामास आलो नाही. तर जाणुनबुजून अप्रामाणिकपणे मी तुम्हांस फसविले आहे. व अप्रामाणिकपणे संस्थेकडून रक्कम घतली आहे., असे समजून आय.पी.सि.कलम 420 प्रमाणे फिर्यांद करावी. अगर लवादामार्फंत योग्य तो उपाय करावा. दोन्ही एकदम करावे.<br>
39)	आपणाकडून घेतलेला ॲडव्हान्सबद्दल मी जर आपणाकडे तोडणी ऊस तोडणी मशिन कामावर दिले नाहीत तर नुकसान व आपलेकडून ॲडव्हान्स घेतलेली रक्कम द.सा.द.शे. 18 % व्याजासह देईन. ते पैसे न दिल्यास मला झालेले जामीनदार त्यांच्याकडून वसूल करून घ्यावेत.<br>
40)	मी संस्थेच्या नियमाप्रमाणे नाममात्र सभासद झालो आहे. हा करार मी व माझे जामीनदारावरती तसेच वालीवारसांचेवर कायमस्वरूपी बंधनकारक राहील. प्रस्तुत प्रकरणी झालेले वाद दिवाणी व फौजदारी प्रकरणे योग्य त्या न्यायालयाचे न्यायकक्षेमध्ये निर्णित होतील.<br>
41)	या कराराप्रमाणे संस्थेमार्फंत श्री.छत्रपति सहकारी साखर कारखाना लि., भवानीनगर साठी झालेल्या करारान्वये सभासद व बिगर-सभासद, ऊस उत्पादक शेतकरी यांचेमार्फंत त्यांचे शेतातील आपले कारखान्याकडे नोंद झालेल्या ऊसाची कारखाना गव्हाणीपर्यंत तोड व वाहतूक करणेचे काम आम्ही स्वीकारले असून, माझा व माझेकडील मजूरांचा कारखान्याशी मालक / नोकर असा कोणताही संबंध अगर नाते असणार नाही, हे आम्हांस मान्य व कबूल आहे.<br>
42)	हार्वेस्टर मशिन मालक व सहभागीदाराने ऊस उत्पादक शेतक-याकडून सहमतीने ऊस खरेदी करून स्वतःच्या नावाने ऊस गळीतास आणावयाचा नाही. तसे निदर्शनास आल्यास आपणाविरूध्द कारवाई करण्यात येईल. कारखान्याचे शेतकी विभागाची परवानगीनुसार तोडणी वाहतूक करणे बंधनकारक राहील.<br>
43)	हार्वेस्टर मशिन व वहानाकरिता भरावी लागणारी लायसन्स फी, रोड टॅक्स, गुड टॅक्स, विमा रक्कम व इतर कायदेशिर कर भरण्याची जबाबदारी कंत्राटदार यांची राहील.<br>
44)	सदर योजनेत सहभागी झालेल्या हार्वेस्टर मशिन मालकास संस्थेमार्फंत रू. 25,00,000/-(अक्षरी रक्कम रूपये पंचवीस लाख फक्त) ॲडव्हान्स प्रती मशिन देणेत येणार आहे. तसेच ॲडव्हान्स रक्कम मशिन खरेदी केल्यापासुन पुढे येणा-या पाच (5) गाळप हंगामामध्ये समान हप्त्यात वसुल केली जाईल.<br>
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
            if ($liney+20 >= 260)
				{
					//$pdf->line(15,$liney,200,$liney);
					$liney = 30;
					$pdf->AddPage();
					//$this->printpageheader($pdf,$liney,$date,$saletransactionid);
				}
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
            if ($liney+20 >= 260)
            {
                //$pdf->line(15,$liney,200,$liney);
                $liney = 30;
                $pdf->AddPage();
                //$this->printpageheader($pdf,$liney,$date,$saletransactionid);
            }
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
            if ($liney+20 >= 260)
            {
                //$pdf->line(15,$liney,200,$liney);
                $liney = 30;
                $pdf->AddPage();
                //$this->printpageheader($pdf,$liney,$date,$saletransactionid);
            }
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
            if ($liney+20 >= 260)
            {
                //$pdf->line(15,$liney,200,$liney);
                $liney = 30;
                $pdf->AddPage();
                //$this->printpageheader($pdf,$liney,$date,$saletransactionid);
            }
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