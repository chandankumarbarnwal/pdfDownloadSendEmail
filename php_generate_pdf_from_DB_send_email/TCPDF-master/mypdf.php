<?php

require_once('tcpdf.php');

require_once('config/tcpdf_config.php');




class MYPDF extends TCPDF {

    public function LoadData() {


            require_once 'Book.php';
            $objBook = new Book;
            $books = $objBook->getAllBooks();

        return $books;
    }

    public function ColoredTable($header,$data) {

        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 35, 20, 25,15,55);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['name'], 'LR', 0, 'L', $fill);
             $this->Cell($w[2], 6, $row['type'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, number_format($row['pages']), 'LR', 0, 'R', $fill);
             $this->Cell($w[4], 6, $row['author'], 'LR', 0, 'L', $fill);
              $this->Cell($w[5], 6, $row['created_at'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}


?>