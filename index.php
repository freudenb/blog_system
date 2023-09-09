<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Tribus Gispersleben Blog</title>
<meta name="title" content="Tribus Gispersleben Blog">
<meta name="description" content="Der inoffizielle Blog rund um Gispersleben und Umgebung (off-topic sometimes)">
<meta name="keywords" content="Blog, Gispersleben, Tribus">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="German">
<meta name="revisit-after" content="1 days">
<link rel="stylesheet" type="text/css" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css"/><script src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script><script>window.addEventListener("load", function(){window.wpcc.init({"border":"thin","corners":"small","colors":{"popup":{"background":"#222222","text":"#ffffff","border":"#fde296"},"button":{"background":"#fde296","text":"#000000"}},"position":"bottom","content":{"message":"Diese Website benutzt Cookies und überträgt mittels Google, Facebook, Youtube, Twitter und weitere, Daten über Sie. Dies geschieht um die Nutzererfahrung zu verbessern. Wenn Sie dem nicht zustimmen verlassen Sie selbstständig diese Website unverzüglich.","button":"Ich stimme zu!","link":"Mehr Erfahren","href":"/impressum.php"}})});</script>
<script>
var gaProperty = 'G-7C345CQDMY';

var disableStr = 'ga-disable-' + gaProperty;

if (document.cookie.indexOf(disableStr + '=true') > -1) {

  window[disableStr] = true;

}

function gaOptout() {

  document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';

  window[disableStr] = true;
  alert('Google Analytics wurde deaktiviert / Google Analytics was disabled');
}

</script>
<script data-ad-client="ca-pub-3675767177176962" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3675767177176962"
     crossorigin="anonymous"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7C345CQDMY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7C345CQDMY');
  gtag('config', 'G-7C345CQDMY', { 'anonymize_ip': true })
</script>
<script>
//Musik Player
var m = new Audio("assets/aegyptian.m4a");
m.loop = true;

function toggleMusic(){
	console.log("toggle");
	var p = document.getElementById("musicLink");
	var mc = document.getElementById("musicCredits");
	var md = document.getElementById("musicDiv");
	
	if(m.duration > 0 && !m.paused) {

		m.pause();
		p.textContent = "Play Music";
		mc.style.display = "none";
		md.style.backgroundColor = "transparent";
		
	} else {

    	m.play();
		p.textContent = "Stop Music";
		mc.style.display = "block";
		md.style.backgroundColor = "rgba(26, 26, 26)";
	}

}

</script>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="styleCustom.css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v10.0" nonce="2cB6SuqS"></script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

	<?php
		
		$pdo = "";
		
		if($_SERVER['HTTP_HOST'] == "localhost"){
			$pdo = new PDO('mysql:host=localhost;dbname=tribusblogdata;charset=utf8', 'root', '');
		}
		else{
			//connect to bplaced mysql database
			$pdo = new PDO('mysql:host=sql102.epizy.com;dbname=epiz_31074891_tribusg;charset=utf8', 'epiz_31074891', 'PlLwKnxJllG5vs');
		}
		
	?>
	
	<!--<div id='pagePreview'> 
	<canvas id='previewCanvas'></canvas>
	</div>-->
	
	<div id='musicDiv'>
		<a onclick='toggleMusic()' id='musicLink' href='#'>Play Music</a><br>
		<div style='display:none' id='musicCredits'>
			<p>Credits:</p>
			<a href='https://www.youtube.com/channel/UC0Cf21ahxlbODHpQkrBtVHw'>World Music Official</a><br>	
			<a href='https://www.youtube.com/channel/UCs4_kcNnGNd5uW8l7EuPAew'>RKFM</a>
		</div>
	</div>
	<div id='content'>
		<div id='header'>
			<img id='headerLogo' src='theTribus.png'>
			<h1>Tribus Gispersleben</h1>
			<p>Der inoffizielle Blog rund um Gispersleben und Umgebung (off-topic sometimes)</p>
			<!--<p><i>kritisch, alternativ</i></p>-->
			<p><i>mächtig, selbstverwirklichend</i></p>
			<ul>
				<li><a href='index.php'>Home</a></li>
				<li><a href='index.php?q=feedback'>Feedback</a></li>
				<li><a href='index.php?q=support'>Support</a></li>
				<li><a href='index.php?q=autoren'>Autoren</a></li>
				<li><a href='index.php?q=projekte'>Projekte</a></li>
			
			</ul>
		</div>
		
		
		<?php
		
			function printLast5PostTitles($pdo){
				
				$sql = "SELECT Title,ID FROM blogentry ORDER BY Timestamp DESC LIMIT 5";
				echo "<div id='last5Posts'><ul>";
				foreach ($pdo->query($sql) as $row) {

					echo "<li><h3><a href='index.php?q=".$row['ID']."'>".$row['Title']."</a></h3></li>";
				}
				echo "</ul><br><br></div>";
			}
			
			function printEntrys($pdo){
				
				$sql = "SELECT * FROM blogentry ORDER BY Timestamp DESC";
				foreach ($pdo->query($sql) as $row) {
					
					echo "<div class='blogPost'>";
					
					echo "<div class='blogPostHead'>";
					echo "<h1><a href='index.php?q=".$row['ID']."'>".$row['Title']."</a></h1>";
					echo "<p>Autor: ".$row['Autor']." | ".$row['Timestamp']."<p><br />";
					echo "</div>";
					
					echo "<div class='blogPostContent'>";
					echo "<p>".$row['Text']."</p><br /><br />";
					echo "</div>";
					
					echo "<a style='padding-bottom:10px;'  href='index.php?q=feedback'>Feedback</a>";
					echo "<br/><br/>";
					echo "</div>";
					
				
				}
				
			}
			
			function printAutoren($pdo, $withBio = True){
				
				$sql = "SELECT * FROM autoren ORDER BY ID";
						
						echo "<div class='blogPost'>";
						echo "<h1>Autoren</h1>";
						
						$result = $pdo->query($sql);
						
						foreach ($result as $row) {
							
							
							
							echo "<p>".$row["Name"]."</p>";
							if($withBio){
								echo "<p>About: <i>".$row["Bio"]."</i></p>";
							}
							echo "</br>";
					
						}
						
						echo "</div>";
				
			}
			
			
			function printAdminPanelForm($pdo){
				
				echo "<h1>Neuer Beitrag</h1>";
									//admin forms anzeigen
				require_once 'formr/class.formr.php';
				$aform = new Formr\Formr();
				
				$aform->open('','','index.php?q=admin','','');
				$aform->create_form('Title, Autor, Autor Bio, Description, Text|textarea');
				$aform->required = '*';
				
				if ($aform->submitted())
				{	
							// get our form values and assign them to a variable
							$data = $aform->validate('Title, Autor, Autor Bio, Description, Text(allow_html)');
							
							// show a success message if no errors
							if($aform->ok()) {
								
								//insert new autor in db
								
								
								$statement = $pdo->prepare("SELECT count(Name) FROM autoren WHERE Name = ?");
								$statement->execute(array($data['autor']));
								$row = $statement->fetch(PDO::FETCH_ASSOC);
								
								//if autor not already in db
								if($row["count(Name)"] == 0){
									
									//insert new autor
									$statement = $pdo->prepare("INSERT INTO autoren (Name, Bio) VALUES (?, ?)");
									$statement->execute(array($data['autor'],$data['autor_bio']));
									echo "<p style='color:lightblue'>Neuer Autor wurde geaddet! ".$data['autor']."</p>";
									
								}
						
								
								
								
								
								//insert eintrag in db
								$statement = $pdo->prepare("INSERT INTO blogentry (Autor, Title, Description, Text) VALUES (?, ?, ?, ?)");
								$statement->execute(array($data['autor'], $data['title'], $data['description'], $data['text']));
								
								$aform->success_message = "Neuer Beitrag mit Titel: ".$data['title']." eingetragen!";
								echo "<p style='color:lightgreen'>".$aform->success_message."</p>";
							}
							else{
								echo "<p>NEUER BEITRAG: Fehlerhafte Eintragung. Alle Felder müssen ausgefüllt sein.</p>";
							}
					
				}
				
			}
			
			
			function printDetailedView($pdo, $id){
				
				$sql = "SELECT * FROM blogentry WHERE ID = ".$id;
				foreach ($pdo->query($sql) as $row) {
					
					echo "<br><br><a href='index.php'>zurück</a>";
					echo "<div class='blogPost'>";
					
					echo "<div class='blogPostHead'>";
					echo "<h1><a href='index.php?q=".$row['ID']."'>".$row['Title']."</a></h1>";
					echo "<p>Autor: ".$row['Autor']." | ".$row['Timestamp']."<p><br>";
					echo "</div>";
					
					echo "<div class='blogPostContent'>";
					echo "<p>".$row['Text']."</p><br /><br>";
					echo "</div>";
					
					echo '<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text='.$row['Title'].'" data-hashtags="Tribus" data-size="small">Tweet this!</a>';
					echo "<br>";
					echo '<div class="fb-like" data-href="http://localhost/Tribus_Gispersleben/index.php" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>';
					
					
					
					echo "<br></div>";
					echo "<a href='index.php'>zurück</a>";
					echo "<a style='margin-left:10px;'  href='index.php?q=feedback'>Feedback</a>";
				}
				
			}
			
			
			if (isset($_GET["q"])){
				
				$q = htmlspecialchars($_GET["q"]);
				
				if(is_numeric($q)){
					//DETAILS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
					printLast5PostTitles($pdo);
					printDetailedView($pdo, $q);
					
					
				}
				else
				
				switch ($q) {
					
					case "feedback":
						//FEEDBACK----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						require_once 'formr/class.formr.php';
						$form = new Formr\Formr();
						$form->open('','','index.php?q=feedback','','');
						$form->create_form('Name, Betreff, Email, Nachricht|textarea');
						
						$form->required = '*';
						
						if ($form->submitted())
						{	
							// get our form values and assign them to a variable
							$data = $form->validate('Name, Betreff, Email, Nachricht(min[5]|max[20000])');
							
							// show a success message if no errors
							if($form->ok()) {

								
								$statement = $pdo->prepare("INSERT INTO feedback (Name, Betreff, EMail, Nachricht) VALUES (?, ?, ?, ?)");
								$statement->execute(array($data['name'], $data['betreff'], $data['email'], $data['nachricht']));
								
								$form->success_message = "Danke fuer Ihre Mitteilung, ".$data['name']."!";
								echo "<p>".$form->success_message."</p>";
								
								$msg = $data['name']."\n".$data['email']."\n\n\n".$data['nachricht'];
								mail("tribus-gispersleben@hotmail.com","Feedback ".date("Y-m-d h:i:sa")." ".$data['betreff'],$msg);
										
							}
							else{
								echo "<p>Fehlerhafte Eintragung. Nachricht muss mindestens 5 Zeichen lang sein. Alle Felder müssen ausgefüllt sein.</p>";
							}
					
						}
						
						break;
						
					case "support":
						//SUPPORT----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						echo "<div class='blogPost'>";
						echo "<h1>Support</h1>";
						echo "<p>Wen dir die Seite gefällt und du mich unterstützen willst kannst du dies hier tun.</p>";
						echo '<form action="https://www.paypal.com/donate" method="post" target="_top">
							<input type="hidden" name="hosted_button_id" value="Z99BAS7A7YK4C" />
							<input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
							<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1" />
							</form>';
						
						echo "<br/>";
						
						echo '<a href="https://nowpayments.io/donation?api_key=WZSWRRR-CJ74K8J-P6J00TC-DBC84SE" target="_blank">
							<img src="https://nowpayments.io/images/embeds/donation-button-black.svg" alt="Crypto donation button by NOWPayments">
							</a>';
						
						echo "</div>";
						break;
						
					case "autoren":
						//AUTOREN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						printAutoren($pdo);

						break;
						
					case "admin":
						//ADMIN----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						echo "<div class='blogPost'>";
						echo "<h1>Admin</h1>";
						echo "</div>";
						
						
						if(isset($_SESSION['loggedIn'])){
							
							echo "<p style='color:red'>Logged in as ADMIN!</p>";
							printAdminPanelForm($pdo);
							echo "<br><a href='https://html-online.com/editor/'>HTML Online Editor</a>";
							printAutoren($pdo, False);
						}
						else
						{	
							require_once 'formr/class.formr.php';
							$form = new Formr\Formr();
							$form->open('','','index.php?q=admin','','');
							$form->fastform('login');
							$form->required = '*';
							
							if ($form->submitted())
							{	
								// get our form values and assign them to a variable
								$data = $form->validate('username, password');
								
								
								
								
								
								// show a success message if no errors
								if($form->ok()) {
									
									//Print fake message
									$form->success_message = "Du hast jetzt Admin rechte, ".$data['username']."!";
									echo "<p>".$form->success_message."</p>";
									
									
									//check for right password and username
									$statement = $pdo->prepare("SELECT * FROM adminuser WHERE Name = ?");
									$statement->execute(array($data['username']));
									$row = $statement->fetch(PDO::FETCH_ASSOC);
									
									//with sha256 hashed password
									$dbusername = $row["Name"];
									$dbpassword = $row["Password"];
									
									$unhashedPW = $data['password'];
									$data['password'] = hash("sha256",$data['password']);

									
									if($dbpassword == $data['password'] and $dbusername == $data['username']){
										
										
										//wenn session noch nicht existiert
										if(!isset($_SESSION["loggedIn"])){
											//set a session
											$_SESSION["loggedIn"]= True;
										}
											echo "<p style='color:red'>Logged in as ADMIN!</p>";
											printAdminPanelForm($pdo);
											echo "<br><a href='https://html-online.com/editor/'>HTML Online Editor</a>";
											printAutoren($pdo, False);
										
										
									}
									else{
										
										//wrong PW or USER
										$msg = "Jemand versucht sich im Admin Panel einzuloggen. Eingabe: ".$data['username']." | ".$unhashedPW;
										$msg .= "\n IP:".$_SERVER['REMOTE_ADDR'];
										$msg .= "\n TIME: ".date("Y-m-d h:i:sa");
										mail("tribus-gispersleben@hotmail.com","Fehlgeschlagener Loginversuch ".date("Y-m-d h:i:sa"),$msg);
										
										echo "<p>Login erfasst! IP: ".$_SERVER['REMOTE_ADDR']." TIME: ".date("Y-m-d h:i:sa")."</p>";
									}
								}
								else{
									echo "<p>LOGIN: Fehlerhafte Eintragung. ALLES muss mindestens 5 Zeichen lang sein. Alle Felder müssen ausgefüllt sein.</p>";
								}
						
							}
						
						}
						
						
						break;
					
					case "projekte":
						//PROJEKTE----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						echo "<h1>Andere Projekte</h1>";
						
						echo "<h3>Gaming Channel Warjun11</h3>";
						echo "<a href='https://www.youtube.com/channel/UCzjuQwt60rLh_-u5CPrwi0Q'>Youtube</a><br/>";
						echo "<a href='https://www.twitch.tv/warjun11'>Twitch</a><br/>";
						echo "<a href='https://twitter.com/Warjun111'>Twitter</a><br/>";
						
						echo "<h3>Dreckiger Goblin</h3>";
						echo "<a href='https://www.youtube.com/channel/UCs0_DZGmH1-zkgQ4jJcZUiw/featured'>Youtube</a><br/>";
						echo "<a href='https://www.tiktok.com/@dreckigergoblin'>TikTok</a><br/>";
						echo '<br><iframe width="560" height="315" src="https://www.youtube.com/embed/VZfnEfYL6tQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
						
						
						echo "<h3>Gispersleben bei Nacht</h3>";
						echo "<a href='https://www.youtube.com/channel/UCG8L_2qF-OYQmaePZwcUtQw'>Youtube</a><br/>";
						echo "<a href='https://www.instagram.com/gispibeinacht/'>Instagram</a><br/>";
				
						echo "<h3>Prototypes</h3>";
						echo "<a href='#'>*hidden*</a><br/>";
					
						break;
					
					
					default:
						//DEFAULT----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
						printLast5PostTitles($pdo);
						echo "<br><br>";
						printEntrys($pdo);
				}
				
			}
			else{
				printLast5PostTitles($pdo);
				echo "<br><br>";
				printEntrys($pdo);
				
			}
		
			
		
		?>
		
		

			
		
		
		
		<div id='footer'>
			<a href='index.php?q=admin'>Admin</a>
			<a href='impressum.php'>Impressum/Rechtliches/Datenschutzerklärung</a>
			<br><br>
			<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Tribus Gispersleben - Der inoffizielle Blog rund um Gispersleben und Umgebung." data-hashtags="Tribus" data-size="small">Tweet this!</a>
			<br>
			<div class="fb-like" data-href="http://localhost/Tribus_Gispersleben/index.php" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
			<br>
			<a href="https://info.flagcounter.com/F724"><img src="https://s11.flagcounter.com/count/F724/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_20/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
			<p id='diss'>&#169; tribus-gispersleben.de 2021</p>
		</div>
		
	</div>
</body>
</html>