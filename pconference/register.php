<?php
	include("database.php");
	session_start();
	
	if(isset($_POST['submit']))
	{	
	    
	    $sname = $_POST['Sname'];
		$sname = stripslashes($sname);
		$sname = addslashes($sname);
		
		$name = $_POST['name'];
		$name = stripslashes($name);
		$name = addslashes($name);

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$phone = $_POST['phone'];
		$phone = stripslashes($phone);
		$phone = addslashes($phone);

		$address = $_POST['address'];
		$address = stripslashes($address);
		$address = addslashes($address);
		
		$country = $_POST['country'];
		$country = stripslashes($country);
		$country = addslashes($country);

		$lga = $_POST['lga'];
		$lga = stripslashes($lga);
		$lga = addslashes($lga);

		$state = $_POST['state'];
		$state = stripslashes($state);
		$state = addslashes($state);

		$attend = $_POST['attend'];
		$attend = stripslashes($attend);
		$attend = addslashes($attend);

		$avail = $_POST['available'];
		$avail = stripslashes($avail);
		$avail = addslashes($avail);
		
		//set email variables 
        $from = 'support@ypfonline.org';
        $reply = 'theyoungprofessionalsforum@gmail.com';
    	// To send HTML mail, the Content-type header must be set
        $headers  .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$reply."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
		//Create Subject
		$subject = 'Registration For LEAD 2020';
		
		// Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h2 style="color:#080;">Hello There </h2>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;">This is to confirm that we have received your registration for the LEAD 2020</p>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;">You can add the event to your calender by clicking the link <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=YPF+LEADERSHIP+SUMMIT+2020&details=Experience+a+significant+leap+in+your+work+life+as+you+attend+LEAD+2020.+Higher+sights%2C+higher+standards+and+character+building+beyond+normal+limits.+These+and+many+more+await+you+at+LEAD+2020.&location=Live+Stream&dates=20200725T003600Z%2F20200726T003600Z"> ADD TO CALENDER</a>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;">Please expect more details on the event on your email</p>';
        
        $message .= '<p style="color:#3e3f3e;font-size:16px;"> Remember to follow us on all social medias @ypfonlinehq </p>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;"> Kindly create your personalized banner here and share with your networks on social media. <a href="https://getdp.co/lead2020attendees"><strong> Create DP</strong></a></p>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;"> Download the YPF Leadership summit Agenda here. <a href="https://www.ypfonline.org/lead/images/lead-agenda.pdf"><strong> Get Event Agenda</strong></a></p>';
        $message .= '<p style="color:#3e3f3e;font-size:16px;"> Watch event live on YouTube and Facebook. <a href="https://www.ypfonline.org/lead/live"><strong> Watch Now</strong></a></p>';
        $message .= '<p style="color:#080;font-size:16px;">Signed</p>';
        $message .= '<p style="color:#080;font-size:16px;">LEAD 2020 committee</p>';
        $message .= '</body></html>';
        
        //check if email exists 
		$str="SELECT email from ypfoyial_lead WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
            header("refresh:0;url=index.html");
        }
        
        //check if phone number exist
        $str2="SELECT phone from ypfoyial_lead WHERE phone='$phone'";
		$result2=mysqli_query($con,$str2);
		
		if((mysqli_num_rows($result2))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This Phone Number is already registered !!');</script></h3></center>";
            header("refresh:0;url=index.html");
        }
        
		else
		{
		    $str = "INSERT INTO ypfoyial_lead (Sname , name , email , phone , address , lga , state , country , attend , avail) Values ('$sname', '$name' , '$email' , '$phone' , '$address' , '$lga' , '$state' , '$country' , '$attend' , '$avail')";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered for the LEAD 2020 !!');</script></h3></center>";
			mail($email, $subject, $message, $headers);
			header('location: confirm.html?utm_source=ypfonline&utm_medium=confirmed-Registration&utm_term=&utm_content=&utm_campaign=');
		}
    }
?>
