<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php

			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\Exception;
				
				if(isset($_POST['sendmail'])){

					require 'library/vendor/autoload.php';

					require_once('mypdf.php');

					$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

					$pdf->SetCreator(PDF_CREATOR);
					$pdf->SetAuthor('Nicola Asuni');
					$pdf->SetTitle('TCPDF Example 011');
					$pdf->SetSubject('TCPDF Tutorial');
					$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

					$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

					$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
					    require_once(dirname(__FILE__).'/lang/eng.php');
					    $pdf->setLanguageArray($l);
					}


					$pdf->SetFont('helvetica', '', 12);

					$pdf->AddPage();

					$header = array('id', 'name', 'type', 'pages', 'author', 'created_at');


					$data = $pdf->LoadData();

					$pdf->ColoredTable($header, $data);

					ob_end_clean();

					$pdfFile = $pdf->Output('books.pdf', 'S');

			       $date = date('Y-m-d');
			       $mail = new PHPMailer;
			       try{
			       $mail->IsSMTP();
			       //$mail->SMTPDebug = 2;
			       $mail->Mailer = 'smtp';
			       //$mail->Host = 'email-smtp.us-west-2.amazonaws.com';  // Specify main and backup SMTP servers
			       $mail->Host = 'smtp.gmail.com';
			       $mail->SMTPAuth = true;                               // Enable SMTP authentication
			                      // SMTP username
			       $mail->Username = 'chandanletsservice@gmail.com';//$this->smtpUsername;                 // SMTP username
			       $mail->Password = 'chandanlets1995';//                            // Enable TLS encryption, `ssl` also accepted
			         
			       $mail->SMTPSecure = 'ssl';
			       $mail->Port = 465;
			       //Recipients
			       $mail->setFrom('artibarnwal111@gmail.com', 'check');
			       $mail->addAddress('chandanbarnwal111@gmail.com'); 
			      
			       $mail->addStringAttachment($pdfFile, 'book.pdf');     // Add a recipient


			       $mail->isHTML(true);                                  // Set email format to HTML
			       $mail->Subject = 'Testing and sending mail from localhost - '.$date;
			       $mail->Body    = 'hello chandan';

			       if($mail->send())
			           echo 'Message has been sent';
			       else
			           echo 'Message not sent';

			       } catch (MailException $e) {
			           echo 'Message could not be sent.';
			           echo 'Mailer Error: ' . $mail->ErrorInfo;
			       }

				}

			?>
	
	<h1 class="text-center">Using <strong>tcpdf</strong> Generate pdf and send as attachment in php</h1>
	<h1 class="text-center">Generate pdf from db</h1>
	<hr>
	<div class="row">
		<div>

			
		

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">NAme</th>
			<th scope="col">Type</th>
			<th scope="col">Pages</th>
			<th scope="col">author</th>
			<th scope="col">created at</th>
		</tr>
	</thead>
	<tbody>
		<?php
			require_once 'Book.php';
			$objBook = new Book;
			$books = $objBook->getAllBooks();
			foreach ($books as $book) {
				$data = json_encode($book, true);
				echo "<tr> 
					<td>$book[id]</td>
					<td>$book[name]</td>
					<td>$book[type]</td>
					<td>$book[pages]</td>
					<td>$book[author]</td>
					<td>$book[created_at]</td>
				   	</tr>";

			}



		?>
	</tbody>
</table>


			<hr>

			<div class="row">
				<form method="post" action="generatePDF.php">
					<div class="col-sm-6 form-group">
						<button type="submit" name="generatepdf" class="btn btn-lg btn-success btn-block">Generate pdf</button>
					</div>
				</form>

				<form method="post" action="">
					<div class="col-sm-6 form-group">
						<button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Mail me</button>
					</div>
				</form>

			</div>
		</div>
		
	</div>
</div>



</body>
</html>