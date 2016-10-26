<?php
session_start();


$timezone = new DateTimeZone("Asia/Kolkata" );
$date = new DateTime();
$date->setTimezone($timezone );
//echo  $date->format( 'H:i:s A  /  D, M jS, Y' );




require 'dbconnect.php'; 
require 'connect.php'; 

function cleaninput($str){
	global $conn;

	$input = trim($str);

	$input = mysqli_real_escape_string($conn, $input);

	//strip HTML tags from input data
	$input = strip_tags($input);

	//disable magic quotes...
	$input = get_magic_quotes_gpc() ? stripslashes($input) : $input;

	//prevent xss...
	$input = htmlspecialchars($input,ENT_QUOTES,"UTF-8");

	return $input;
}

if(isset($_GET["utm_source"])){
	$utm_source = cleaninput($_GET["utm_source"]);
}
else{
	$utm_source = "";
}
if(isset($_GET["utm_medium"])){
	$utm_medium = cleaninput($_GET["utm_medium"]);
}
else{
	$utm_medium = "";
}
if(isset($_GET["utm_campaign"])){
	$utm_campaign = cleaninput($_GET["utm_campaign"]);
}
else{
	$utm_campaign = "";
}

$created = $date->format( 'Y-m-d H:i:s' );

if(!empty($utm_source) && !empty($utm_medium) && !empty($utm_campaign))
{
	$sql = "SELECT id FROM utm_tracking where session_id='".session_id()."' and utm_source='".$utm_source."' and utm_medium='".$utm_medium."' and utm_campaign='".$utm_campaign."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 0)
	{
		$sql2 = "INSERT INTO utm_tracking(utm_source, utm_medium, utm_campaign, session_id, date_time)VALUES('".$utm_source."', '".$utm_medium."', '".$utm_campaign."', '".session_id()."', '".$created."')";
		$conn->query($sql2);
	}
}
?>

<!DOCTYPE html><!--[if lt IE 9]> <html class="no-js ie aui ltr" dir="ltr" lang="en-GB"> <![endif]-->
<html data-multi-fonts="" class="aui ltr latin " dir="ltr" lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Homepage - Tic Tac</title>
        <link rel="apple-touch-icon" sizes="57x57" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/apple-touch-icon-120x120.png">
        <link rel="icon" type="image/png" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="shortcut icon" href="http://www.tictac.co.in/new-tic-tac-theme/favicon/favicon.ico">
       
      
		
        <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
        <meta content="Homepage - Tic Tac" lang="en-US" name="description" />
        <link class="lfr-css-file" href="css/aui.css" rel="stylesheet" type="text/css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />
       

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/normalize.css" rel="stylesheet">
        <script src="js/modernizr.full.min.js"></script>

	<script type="text/javascript">   
	   var _gaq = _gaq || [];   
	   _gaq.push(         
		  function() {
			 _gat._createTracker('UA-61459690-1', 'local');            
		  },
		  function() {
			 _gat._createTracker('UA-35453978-1', 'regional');
		  },
		  function() {
			 _gat._createTracker('UA-27233235-1', 'global');  
		  },        
		  ['local._trackPageview'],         
		  ['regional._trackPageview'],           
		  ['global._trackPageview']
	   );           
	   (function() {
		 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	   })();   
	</script>

    </head>
    <body id="root">

        
        

        <!-- SITE CONTENT -->
        <div id="tictac" class="with-modal">
            <div class="site site--home" id=""> 



                

                <!-- MAIN CONTENT -->
                
                <section class="shareandwin" style="margin-top: 0px;">
                    <!-- <div class="container"> -->

                        <div class="row">
                            <div class="col-sm-6 clearfix samsungPhone">
                                <img src="img/samsung/share-txt.png" class="gusto-img01" alt=""/>
                                <h4><storng>Samsung <br/> Galaxy J7 2016 Edition</strong></h4>
                                <img src="img/samsung/samsung-phone.png" alt=""/>
                            </div>
                            <div class="col-sm-6 clearfix paddZeroResp">

                                <h1></h1>
                                <!-- <h5>Follow 3 simple steps & you could win a <br class="hidden-xs" /><span>Mahindra Gusto!</span></h5> -->
                                <img src="img/samsung/steps-2.png" class="step-01" alt=""/>
                                <ul class="steps">
                                    <li>Step1:
                                            <b>BUY THE PACK</b><br/> 
                                            Buy & Share Tic Tac with 
                                            your friends.
                                    </li>

                                    <li>
                                        Step2: <b>give a Missed call</b> on<br/>
                                        1800 - 120 - 2345 
                                    </li>

                                    <li>
                                        Step3: <b>WIN</b><br/>
                                        Stand a chance to win <br/>
                                        <bdi>samsung Galaxy J7</bdi> daily!
                                    </li>
                                </ul>

                                <div class="social"> 
                                    <ul>
                                        <li><a href="https://www.facebook.com/tictacindia/?fref=ts" target="_blank"><img src="img/samsung/fb-ico.png" alt=""/></a></li>
                                        <li><a href="https://www.instagram.com/tictacindia/" target="_blank"><img src="img/samsung/in-ico.png" alt=""/></a></li>
                                        <li><a href="https://www.youtube.com/channel/UC47vSrlLAcnXyWwyDgqEf4A" target="_blank"><img src="img/samsung/you-ico.png" alt=""/></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>

                    <!-- </div> -->
                </section>

                <div class="scroll"><a id="scroll-down" class="scroll-btn" href="#" title=""><img src="img/samsung/scroll.png" alt=""/></a></div>

                <section class="gusto-video">
                    <div class="video-box">
                    
                    	<div class="video-container">    
                                <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/BZZzj1KZnUA?rel=0&controls=1&hd=1&showinfo=0" frameborder="0" allowfullscreen></iframe>--> 
								<iframe width="560" height="315" src="https://www.youtube.com/embed/8tw3Ib6uyGc?rel=0&controls=1&hd=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
						</div>
                        <!--<a href="#" class="video" title="" data-toggle="modal" data-target="#myModal">
                        	<img src="img/samsung/video-big.png" class="hidden-xs hidden-md visible-lg" alt=""/>
                            <img src="img/samsung/video-lg.png" class="hidden-xs visible-sm visible-md" alt=""/>
                            <img src="img/samsung/video-m.png" class="visible-xs" alt=""/>
                        </a>-->
                    </div>
                </section>


                <section class="termsandcond">
                    <!-- <h1>Terms &amp; Conditions</h1> -->
                    <!-- <div class="scroll"><a id="scroll-down1" class="scroll-btn-01" href="javascript:void(0);" title=""><img src="img/samsung/drop.png" alt=""/></a></div> -->
                    

                        <div class="row">
                            <div class="col-sm-6 clearfix hidden-sm hidden-xs">
                                <div class="terms-condtion-slider">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <img src="img/samsung/03.jpg" alt=""/>
                                            </div>
                                            <div class="item">
                                                <img src="img/samsung/01.jpg" alt=""/>
                                            </div>
                                            <div class="item">
                                                <img src="img/samsung/02.jpg" alt=""/>
                                            </div>
                                        </div>
                                        <!-- Indicators -->
                                        <div class="indicators">
                                            <!-- <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                            </ol> -->

                                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                <img src="img/samsung/left-arrow.png" alt=""/>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                <img src="img/samsung/right-arrow.png" alt=""/>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-12 col-md-6 terms-condtion-bgColr clearfix paddZeroResp">
                                <h1>  </h1>
                                <div class="scroll-box">
                                    <div id="scrollbox3">
                                        <p>
                                            <strong>TERMS &amp; CONDITIONS FOR TIC TAC &amp; SAMSUNG CONTEST 2016</strong><br>
                                            BY PARTICIPATING IN THE CONTEST THE PARTICPANT ACCEPTS THE TERMS AND CONDITIONS OF THE CONTEST AS MENTIONED BELOW.
                                        </p>

                                        <p>
                                        <strong>1. The Contest</strong><br>
                                        - Tic Tac & Samsung Contest 2016 (“Promotion” / “Promo” / “Contest”) is sponsored by Ferrero India Pvt. Ltd. (“Organizers” / “Company” / “Ferrero”). The Contest is available for participation on purchase of Tic Tac Promo Pack in India (excluding the State of Tamilnadu) only during the Promo Period.
                                        </p>

                                        <p>
                                        <strong>2. Contest Period, Timing &amp; Contest Packs </strong><br>

                                        - Contest will be open for participation during the “Contest period” / “Promo Period” i.e. from 15th November 2016 00:01 hours to 13th January 2017 20:00 hours (both days included), till stocks last, on purchase of Tic Tac Packs of MRP (Incl. of all taxes) Rs. 10, 15, 20 and 30 as listed below:<br/>

                                        o   Tic Tac Mint –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Orange –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Elaichi Mint –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Apple Treat –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Popcorn –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Raw Mango –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.2 grams<br/>
                                        o   Tic Tac Peach & Passion fruit –MRP Rs. 10 (Incl. of all taxes) and Net Weight of 10.7 grams<br/>
                                        o   Tic Tac Strawberry Fields- MRP Rs. 15 (Incl. of all taxes) and Net Weight of 13.1 grams<br/>
                                        o   Tic Tac Mintensity- MRP Rs. 15 (Incl. of all taxes) and Net Weight of 13.1 grams<br/>
                                        o   Tic Tac Banana- MRP Rs. 15 (Incl. of all taxes) and Net Weight of 13.1 grams<br/>
                                        o   Tic Tac Cherry Passion- MRP Rs. 15 (Incl. of all taxes) and Net Weight of 13.1 grams<br/>
                                        o   Tic Tac Cherry Cola- MRP Rs. 20 (Incl. of all taxes) and Net Weight of 16 grams<br/>
                                        o   Tic Tac Just Kidding- MRP Rs. 30 (Incl. of all taxes) and Net Weight of 24 grams<br/>
                                        o   Tic Tac Banana- MRP Rs. 30 (Incl. of all taxes) and Net Weight of 24 grams<br/>

                                        - Herein referred to as Promo Pack(s).<br/>

                                        - Contest is applicable only on purchase of the Promo Pack(s) as stated above and not on any other pack. The Promo Packs are limited in quantity and will available in select territories. The Contest will be open only till stocks of Promo Packs last or end of the Contest Period, whichever is earlier. The Company does not provide any guarantee or warrantee about the availability of Promo Packs in all the territories and / or during the entire Promo Period.<br/>
                                        
                                        - Successful participation during any day of the Contest Period from 08:00 hours till 20:00 hours will be considered as participation on that day and the participation from 20:01 hours on that day till 07:59 hours the next day will be considered as participation on the next day (Contest Timing). Participation after 20:00 hours on 13th January 2017 will not be considered. Participation during 00:01 hours till 08:00 hours on 15th November 2016 would be considered as participation on 15th November 2016.<br/>
                                        
                                        - The Company reserves the right to change the Contest Period or Contest Timing of the Promo at its sole and absolute discretion without any consent, connivance, notice or intimation to anyone. 
                                        </p>

                                        <p>
                                        <strong>3. Eligibility Criteria</strong><br>
                                        - Individual consumers residing in India (excluding those residing in the State of Tamilnadu) and purchasing the Promo Pack(s) in India (outside the State of Tamilnadu), during the Promo Period, other than for trade / business Purpose, are eligible to participate in the Contest (Eligible Participants). <br/>
                                        - Eligible Participants below age of 18 years may participate in the Promo only with the consent of and under the supervision of and through their parent / legal guardian.<br/>
                                        - Customers purchasing the Promo Pack(s) for further sale, distribution, and marketing or for trade or business purpose (collectively “Trade / Business Purpose” shall not be eligible for participation in the Contest).<br/>
                                        - Companies, Partnership Firms, Proprietary Concerns, HUFs, Association of Persons, Trusts and other entities or organizations are not eligible for participating in the Contest and the Contest is open for individual human beings only.<br/>
                                        - The employees of Ferrero, its associate companies and their children and other family members, the employees of the agencies associated with Ferrero for the organization of the Contest and their children and other family members are not eligible to participate in this Contest. <br/>
                                        - The consumer(s) participating in the Promo is referred to as Participant(s).
                                        </p>

                                        <p>
                                        <strong>4. How to participate</strong><br>

                                        - Purchase Tic Tac Promo Pack during the Promo period in India (outside the State of Tamilnadu). Empty Promo Pack is required to be retained by the Participant for claiming the prize, if selected.<br/>
                                        - Visit <a href="www.tictac.com" target="_blank">www.tictac.com</a> or contact consumer care for the Contest terms and conditions. Read and understand the Contest terms and conditions and proceed to participate only if, Contest terms and conditions are fully acceptable.<br/>
                                        - Give a missed call on toll free number 1800-120-2345.<br/>
                                        - The caller will get a call back on his number and will be taken through the steps to participate through an Interactive Voice Response System (IVRS).<br/>
                                        - Please follow the instructions given through the IVRS.<br/>                                          
                                        - Enter the last 3 digits of the bar code or the 3 digits after the letter “L” of lot code (Code). The Participant will be asked a question.<br/>
                                        - Answer the question in 30 seconds after the beep sound.<br/> 
                                        - The Participant then needs to confirm the entry by pressing ‘#’ (hash) key after the answer. The entry may not be accepted if the # key is not pressed within 30 seconds.<br/>
                                        - After the call ends the participant gets an SMS with a link to refer to the terms and conditions of the Contest which is also available on <a href="www.tictac.com" target="_blank"></a>. If any of the terms and conditions is not acceptable the participant need to immediately inform the same in writing to the Organizers, in which case the participation shall be deemed to have been withdrawn.<br/>
                                        - An entry / participation is invalid in case of:<br/>
                                        o   The # button is not executed after recording<br/>
                                        o   The answer exceeds the time limit of 30 seconds<br/>
                                        o   Answer is irrelevant to the question asked to the participant<br/>
                                        o   In case the recording is  non-audible or incomplete<br/>

                                        -   The Participants are required to retain the Promo Pack containing the Code used for participation and hand over the same to the Organizer for claiming the Prize, if selected.<br/>
                                        -   Only one entry would be considered for prize(s) from one mobile number and other entries from the same mobile number are liable to be rejected, irrespective of the number of Promo Packs purchased.<br/>
                                        -   The Participants are required to keep their Promo Packs and Code secret and not to share the same with anyone else. The Company is not obliged to verify or correlate the identity of the participant or winner with the identity of the purchaser and the Company shall not entertain any claims or disputes in this regard. In case of any dispute, it shall be the responsibility of the participant to prove that he / she has purchased the Promo Pack  and he / she is eligible to participate in the Contest and use the Code on the Promo Pack for such participation.<br/>
                                        </p>

                                        <p>
                                        <strong>5.  Voluntary and Free Participation</strong><br/>

                                        -   Promo is a voluntary brand promotion initiative.<br/>
                                        -   No fees, charges, costs, etc. required to be paid for participating in the Promo apart from purchase of Tic Tac Promo Pack.<br/>
                                        -   It is not mandatory to participate in the Promo.<br/>
                                        -   Tic Tac is available at same price irrespective of the availability of or participation in the Promo.<br/>
                                        </p>

                                        <p>
                                        <strong>6.  Prizes</strong><br/>
                                        -   One of the valid participants every day will be selected as winner based on the entry and shall be entitled to one mobile phone handset as a winning prize (Prize). The make, color, model and vendor/dealer of the Prize shall be selected by Ferrero at its sole and absolute discretion. The winner is required to complete all the formalities and provide required information and documents within 07 days of communication of his selection as a winner. <br/>
                                        -   Ferrero would not be liable or held responsible for any lack or lapse in any communication on account of failure or delay by any of the internet, telecom, and SMS and e-mail, courier  service provider. No correspondence in this regard will be entertained.<br/>
                                        -   In the event the participant’s number is busy, unreachable or he/she does not attend the call in the 1st attempt , 1 more attempts will be made to reach the participant. If even on the second  attempt the participant does not attend the call, or is unreachable, the participant’s participation in the Promo comes to an end and the participant’s entry stands cancelled and participant becomes ineligible to receive the Prize.<br/>
                                        -   The responses will be judged by the by the Company representatives and the Participants shall not be entitled to challenge or dispute the judgment or selection on any ground whatsoever.<br/>
                                        -   The winner(s), the number of winners, the quantity, size, type, value and category of the prizes shall be determined by the company at its sole and absolute discretion and the Company reserves the right to vary the same to resolve the practical difficulties, if any.<br/>
                                        -   Prizes are non-transferable and will not be substituted by cash or any other benefit. Unclaimed  / un-availed prizes will be forfeited.<br/>
                                        -   The winner(s) shall bear and pay all applicable, taxes, duties, etc. on or with respect to the prizes.<br/>
                                        -   The winners are required to provide valid address and identity proofs and such other documents as may be required by the Organizer within seven days of communication of the requirements by the Organizer to the winners.<br/>
                                        -   The Prize will be dispatched by the Organizer by courier or post to the address provided to the Organizer. The responsibility of the Organizer shall be limited to dispatch of the Prize by courier / post to the address provided to the Organizer. The Organizer as well as Prize manufacturer shall not be responsible or liable for any loss, damage, non-delivery, delay, etc. in transit. <br/>
                                        -   The Organizer shall provide the prize on an “as-is basis" and without any warranty or guarantee concerning the quality, suitability or comfort, and the Organizer and/or its associates, affiliates and/ or its management, directors, officers, agents, representatives shall not be responsible for or liable (including but not limited to the product and service liabilities) for deficiency and/ or defect of any product / service and / or the Prize or for any kind of consequential damages / loss, in any manner whatsoever. If any Participant has any grievance with respect to the Prize, he / she may directly contact the respective manufacturer / service provider.<br/>
                                        -   The image of the prize depicted in the advertisements, promotional material, etc. are for illustrative purposes only and the actual prize / look of the prize may vary from the depiction made.<br/>
                                        -   In the event of inadequate participants the no. prizes would be reduced to by the Organizer.<br/>
                                        -   Winner will be disqualified in case of any mismatch or defect or discrepancy in the information, details or documents provided by the winner / parent or guardian. <br/>
                                        -   The Participant / Winner shall bear and pay on his own all the costs and expenses for participation, submission of information, documents and records for claiming the prizes and completing all formalities in this regard.<br/>
                                        </p>


                                        <p><strong>7.  Publicity</strong><br/>
                                        -   The Participant/s undertake and irrevocably and unconditionally permit the Organizer and / or its execution agency to cover the Promo through various media including newspapers, radio television news channels, internet, point of sale materials, etc. and use the details of the participants for this purpose. The Participants shall not raise any objection, protest or demur to such coverage or content in this regard.  
                                        -   The winners shall, at the request of the Organizers and / its execution agency, participate in all promotional activity (such as publicity and photography) surrounding the winning of the prize, free of charge, and they consent to using their name and image in promotional material.
                                        </p>

                                        <p><strong>8.  Intellectual property</strong><br/>
                                        -   All right, title and interest, including but not limited to the Intellectual Property Rights, in the promotional material(s) and in any and all responses received shall vest solely and exclusively with Organizer at all times. The Organizer or any person or entity permitted by Organizer in this regard shall be entitled to use the responses received or any information in connection with the entry in any media for future promotional, marketing, publicity and any other purpose, without any permission and / or payment to the Participant.
                                        -   All material submitted in connection with the Promo (whether written, audio, electronic or visual form, or a combination of those) or any photographs, video and/or film footage and/or audio recording taken of Participants are assigned to Organizer upon submission and become the property of Organizer exclusively. Organizer may use the material in any medium in any reasonable manner it sees fit. Copyright in any such material remains the sole property of Organizer.
                                        </p>

                                        <p><strong>9.  Data Privacy</strong><br/>
                                        -   Release 
                                        The participant (includes the parent / guardian of participating child) hereby grant permission to Ferrero India Pvt. Ltd., its officers, employees, agents, independent contractors, licensees, successors, assigns and any third party it may authorize (hereby collectively referred to  as “Company”) to record his / her name, address, contact details, comment, likeness, message, image, voice, interview and performance on film, tape, or otherwise (hereinafter referred to as the “materials”) in the following context:
                                        EVENT: TIC TAC & SAMSUNG CONTEST 2016
                                        PERIOD: 15th November 2016 00:01 hours to 13th January 2017 20:00 hours (both days included)
                                        The Participant further grant to the Company the full right to use, in any form and modality of exploitation, reproduce, alter by digital means, edit, create derivative works of, display, publish, make available to the public in streaming and/or downloading, broadcast, distribute, sell, license, lend, rent and give away the originals, reproductions, editions, adaptations, alterations and derivations of the materials in any media now known or later developed, including but not limited to websites (including but not limited to publicly accessible websites, intranet sites and third party content hosted sites), social media and social networks, blogs, electronic publications, webcasts, multimedia links, app for tablet and/or smart-phone and/or similar devices, anywhere in the world, and in perpetuity, in connection with promoting, publicizing or explaining the Company’s products and/or activities. The Participant understand and agree that the materials can be used without mentioning his / her name and by modifying and / or altering his / her image and / or voice, with no right to inspect or approve the use of the materials or of any reproduction, alteration, or derivation of the materials in any medium. The Participant further waive all moral rights and all claims to royalties or other compensation arising from or related to the making or use of the materials or reproductions, alterations or derivations of the materials. The Participant hereby forever release and discharge the Company from any claims, actions, damages, liabilities or demands that may arise regarding the use of the materials to promote, publicize or explain the Company’s products and/or activities, including any claims of defamation and invasion of privacy as well as of infringement of moral rights, rights of publicity or copyright or neighboring rights. The Participant understand and agree that all the materials, their adaptations, alterations and derivations, are the sole property of the Company, which owns all rights, title and interest, including the copyright, in and to the same, to be used and disposed of, without limitation, as the Company shall in the Company’s sole discretion determine. The Participant agree that there shall be no obligation to utilize the permission granted by them hereby. The terms of this permission shall commence on the date hereof and be without limitation. The Participant acknowledge that no further agreement between the Participant and the Company regulates the subject matter hereof. The Participant irrevocably agree that the Participant has no future claim for any indemnity or money. The Participant confirm that the Participant is either 18 years of age or older and that the Participant is competent to contract in its own name or minor Participant is participating with the consent and under the supervision of his / her parent / guardian. The Participant has read this release and fully understand its contents, meaning and impact. The Participant agree that this release, including all its contents, are binding on him / her, my heirs, executors, administrators and assigns.
                                        -   Privacy Notice
                                        The participant (including the parent / guardian of participating child) hereby agree to Company's use of his / her / participating child’s personal data, including, by way of illustration, the name, images and voices, or any personal data which the participant may submit voluntarily as part of the materials in the manner and for the purposes set out herein. The personal data may be used by the Company (by authorized personnel) for the purposes set out under the release herein above and may be visible and publicly available to anyone anywhere in the world on any means as described above. The Company may share the personal data with selected service providers that process the personal data under the instructions given by the Company and with any other third party it deems appropriate for the purposes described herein. 
                                        The participant acknowledge that he / she can exercise the rights granted under the applicable data protection legislation, including by way of illustration, the right to access, to have personal data rectified, blocked, completed or, under certain circumstances, deleted and to object to the processing of such data. The participant also acknowledge that to exercise these rights and for any questions with respect to this privacy statement or how the Company handles personal data as data controller, the Participant can direct it to Privacy Officer, Ferrero India Pvt. Ltd., 201-204, Pentagon Tower 1, Magarpatta City, Hadapsar, Pune 411028, India. 
                                        </p>

                                        <p><strong>10. Other terms and conditions</strong><br/>
                                        -   The participant shall not use the Promo to post any defamatory, obscene, offensive response or response which may hurt the personal, religious, social, political or other sentiments or feelings of anyone in any manner whatsoever. The participant shall be solely responsible and liable for such response. The Company shall have the right to exclude such responses from the Promo.  <br/>
                                        -   The participant shall not use the Promo to harm the reputation of the Company or its associate companies or any of its products including Tic Tac. <br/>
                                        -   The Promo is available for participation on first come basis and will be open for such participation by such no. of participants as the Organizers may select at its sole and absolute discretion.<br/>
                                        -   All decisions of the Organizers in any matter relating to the Promo shall be final and no discussion, correspondence, dispute will be entertained.<br/>
                                        -   Organizers reserve the sole right to change / edit Promo details at any time at its discretion and /or alter these terms and conditions without any consent, connivance, notice or intimation to anyone to resolve the difficulties, if any, during implementation of the Promo.<br/>
                                        -   Organizers do not guarantee continuous or uninterrupted conduct of Promo and is not liable in case of any interruption or discontinuation of the Promo or the non-availability of the stock of Promo Packs.<br/>
                                        -   The Participants agree to have their name, personal details including photo published or uploaded on social or other media, to be used by the Organizers without any consideration, compensation and limitation. <br/>
                                        -   The Participants agree that the Organizers may store and use the personal information of the Participant shared for the purposes of or in connection with the Promo for the purpose of conducting the Promo as well promoting and marketing its products.<br/>
                                        -   Organizers do not guarantee any security and privacy to the published or uploaded details and photographs and is not liable for any consequences caused by and resulting from such publication or upload.<br/>
                                        -   Organizers reserve the right to modify or pull out the Promo without prior consent, connivance, intimation or notification.<br/>
                                        -   Organizers reserve the right to disqualify the participant for infringement of these terms and conditions, before or after participations / gratification. <br/>
                                        -   Promotion is in no way sponsored, endorsed or administered, by Prize manufacturer, Facebook or any other social media.<br/>
                                        -   By participating into the contest, each Participant represents and warrants that he/she is legally competent to enter into binding contracts under applicable laws. By taking part and/or entering into the Promo the Participant warrants that all information provided by Participant regarding Participant’s name, age, state, city, address, phone number, etc., is true, correct, accurate and complete.<br/>
                                        -   By participating you hereby release and hold harmless Organizers and its employees and directors from any and all liability associated with the participation.<br/>
                                        -   Notwithstanding anything contained herein or in any other document or correspondence the responsibility and liability of the Organizer shall be limited to payment for the prize(s) as aforesaid.<br/>
                                        -   The Organizer reserves the right to exclude any person from the Promo on the ground of misconduct / criminal record / infringement of these terms and conditions.<br/>
                                        -   The Organizer reserves the right to terminate, modify or extend the Promo at its absolute discretion, without assigning any reason. <br/>
                                        -   The Organizer and or its execution agencies shall not be liable for any loss or damage due to Act of God, government / statutory action and other force majeure circumstances and shall not be liable to pay any compensation whatsoever for such losses.<br/>
                                        -   The Organizer and the execution agency appointed by it shall not be responsible for any technical or other problems beyond their control.<br/>
                                        -   The Participants irrevocably agree that Organizer and / or the execution agency appointed by it are authorized to contact the Participant(s) in connection with the Contest even if the Participant(s) is / are registered under National Do Not Call (NDNC) or DND (Do Not Disturb) or any other facility.<br/>
                                        -   The Promo is subject to all applicable central, state and local laws, rules and regulations.<br/>
                                        -   These Terms and Conditions and the participation in the Promo shall be governed by Indian law and the court at Pune, India shall have exclusive jurisdiction in any matter in this regard.<br/>
                                        </p>




                                        

                                    </div>
                                </div>

                            </div>
                        </div>

                    
                </section>
                <?php 
                $winners = $db->get_array("select * from winners order by position asc, id desc");
                ?>
                <section class="leaderboard">
                    <!-- <h1>Leaderboard</h1>
                    <div class="scroll"><a id="scroll-down3" class="scroll-btn-01" href="javascript:void(0);" title=""><img src="img/samsung/drop.png" alt=""/></a></div> -->

                    <div class="container">

                        <div class="row">
                            <div class="leaderboard-working col-sm-12">
                                <img src="img/samsung/leaderboard-heading.png" class="leaderHeadResp">
                            <div class="col-sm-5 clearfix hidden-sm hidden-xs">
                                <div class="win-box">
                                    <div class=""><img src="img/samsung/troffy.png"></div>
                                    <h2 class="text-center">
                                        Today's Winner
                                        <br>
                                        <div style="border-top:1px dotted"></div>
                                        <span id="today_winner"><?php
                                            if ($winners) {
                                                echo $winners[0]->name;
                                            } else {
                                                ?> Shiv Nair<?php } ?>
                                        </span>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="sucess">

                                    <!-- <h1>Congratulations!</h1> -->
                                    <div id="scrollbox3" style="height:300px">
                                        <ul class="list winnerlist">
                                            <?php if ($winners) { ?>
                                                <?php foreach ($winners as $key => $winner) { ?>
                                                    <li class="<?php if($key == 0) { echo 'active'; } ?>" >
                                                        <div class="winnerlistInner">
                                                        	<img src="img/samsung/lf.png" class="lf" alt=""/>
                                                            <img src="img/samsung/cup.png" alt=""/>
                                                            <div class="winnerlistName">
                                                                <p><winnerlist><?php echo $winner->name; ?></winnerlist></p>
                                                            </div>
                                                            <div class="winnerlistDate">
                                                                <p>24/10/16</p>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <img src="img/samsung/rt.png" class="rt" alt=""/>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Biplab Ghosh  <span>28/4/16</span></p>
                                                </li>
                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Shruti Ganu <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Ankit Kini <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Matthew Neel <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Neeraj Shah <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Shruti Ganu <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Tridib Ram <span>28/4/16</span></p>
                                                </li>

                                                <li>
                                                    <img src="img/samsung/cup.png" alt=""/>
                                                    <p>Deep Doshi <span>28/4/16</span></p>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- main working area -->
                        </div>

                    </div>



                </section>





                





                <div class="tt-portlets-caps"></div>

            </div>
        </div>


        




        <!-- SCRIPTS --> 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/enscroll-0.6.2.min.js" type="text/javascript"></script> 
        <script type="text/javascript">
            $('#scrollbox3').enscroll({
                showOnHover: true,
                verticalTrackClass: 'track3',
                verticalHandleClass: 'handle3'
            });
            jQuery(document).ready(function(){
              /*  jQuery(document).on('mouseover','.winnerlist li',function(){
                    jQuery(this).addClass('active');
					
                });*/
                
                /*jQuery(document).on('mouseout','.winnerlist li',function(){
                    jQuery(this).removeClass('active');
                });*/
                
                jQuery(document).on('click','.winnerlist li',function(){
                    jQuery('#today_winner').html(jQuery(this).find('winnerlist').html())
					 jQuery('.winnerlist li.active').removeClass('active');
					jQuery(this).addClass('active');
                });
                
                jQuery(document).on('click','#scroll-down',function(){
                    var gustoPosition = jQuery('.gusto-video').offset().top;
                    jQuery('body,html').animate({scrollTop:gustoPosition});
                });
				//jQuery(".modal-backdrop, #myModal .close, #myModal .btn").live("click", function() {
					jQuery(document).on('click','.modal-backdrop, #myModal .close, #myModal .btn',function(){
					jQuery("#myModal iframe").attr("src", jQuery("#myModal iframe").attr("src")); 
				});
				
				
				$('#myModal').on('hidden.bs.modal', function (e) {
  					jQuery("#myModal iframe").attr("src", jQuery("#myModal iframe").attr("src")); 
				})
				
            });
        </script>

    </body>
</html>