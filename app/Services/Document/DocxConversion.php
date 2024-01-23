<?php

namespace App\Services\Document;

use Exception;
use ZipArchive;
use DOMDocument;
use App\Models\File;
use App\Models\DocumentData;
use Smalot\PdfParser\Parser;
use thiagoalessio\TesseractOCR\TesseractOCR;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpPresentation\IOFactory as phpIOFactory;



class DocxConversion
{
        private $document_id;
        private $filename;
        private $file_id;
        private $extension;

        public function __construct($document_id,$filePath,$fileId,$extension)
        {
            $this->document_id = $document_id;
            $this->filename = $filePath;
            $this->file_id = $fileId;
            $this->file_ext = $extension;
        }

        private function read_doc()
        {
            $dir = File::FilesDir();
            $file = public_path().'/'. $dir . $this->filename;
            if(file_exists($file))
            {
                if(($fh = fopen($file, 'r')) !== false )
                {
                   $headers = fread($fh, 0xA00);
                   $n1 = ( ord($headers[0x21C]) - 1 );
                   $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );
                   $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );
                   $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );
                   $textLength = ($n1 + $n2 + $n3 + $n4);
                   $extracted_plaintext = fread($fh, $textLength);
                   return nl2br($extracted_plaintext);
                }
            }
        }

        private function read_docx()
        {
            echo " Reading Docx file";
            $striped_content = '';
            $content = '';
            $dir = File::FilesDir();
            $file = public_path().'/'. $dir . $this->filename;
            $zip = zip_open($file);
            echo " Finished Zip Open";

            if (!$zip || is_numeric($zip)) return false;
            while ($zip_entry = zip_read($zip))
            {

                if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

                if (zip_entry_name($zip_entry) != "word/document.xml") continue;

                $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                zip_entry_close($zip_entry);
            }

            zip_close($zip);
            echo " Finished Zip Closed";

            $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
            $content = str_replace('</w:r></w:p>', "\r\n", $content);
            $striped_content = strip_tags($content);

            echo " Striped content:" . $striped_content;
            return $striped_content;
        }



    function xlsx_to_text()
    {

    $dir = File::FilesDir();
    $input_file = public_path().'/'. $dir . $this->filename;
    $spreadsheet = IOFactory::load($input_file);

    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    $string = '';
    foreach ($rows as $row) {
        $row = str_replace('\n','',$row);
        $row = str_replace('\r','',$row);
        $string .= implode(', ', $row) . PHP_EOL;
    }

        return $string;
    }


    function ppt_to_text(){

        $dir = File::FilesDir();
        $input_file = public_path().'/'. $dir . $this->filename;
            // This approach uses detection of the string "chr(0f).Hex_value.chr(0x00).chr(0x00).chr(0x00)" to find text strings, which are then terminated by another NUL chr(0x00). [1] Get text between delimiters [2]
            $fileHandle = fopen($input_file, "r");
            $line = @fread($fileHandle, filesize($input_file));
            $lines = explode(chr(0x0f),$line);
            $outtext = '';

            foreach($lines as $thisline) {
                if (strpos($thisline, chr(0x00).chr(0x00).chr(0x00)) == 1) {
                    $text_line = substr($thisline, 4);
                    $end_pos   = strpos($text_line, chr(0x00));
                    $text_line = substr($text_line, 0, $end_pos);
                    $text_line = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$text_line);
                    if (strlen($text_line) > 1) {
                        $outtext.= substr($text_line, 0, $end_pos)."\n";
                    }
                }
            }
            return $outtext;

    }


    public function convertToText() {

        if(!isset($this->filename)) {
            return "File Not exists";
        }

        try
        {
            if( $this->file_ext == "doc" || $this->file_ext == "pdf" || $this->file_ext == "docx" || $this->file_ext == "xlsx" || $this->file_ext == "ppt" || $this->file_ext == "png" || $this->file_ext == "jpg" || $this->file_ext == "jpeg" )
            {
                if($this->file_ext == "doc") {
                    return $this->read_doc();
                } elseif($this->file_ext == "docx") {
                    return $this->read_docx();
                } elseif($this->file_ext == "xlsx") {
                    return $this->xlsx_to_text();
                }elseif($this->file_ext == "ppt") {
                    return $this->ppt_to_text();
                } elseif ($this->file_ext == "pdf") {
                    return $this->ReadPdf();
                } elseif ($this->file_ext == "png" || $this->file_ext == "jpg" || $this->file_ext == "jpeg") {
                    return $this->ReadImagesText();
                }

            } else
            {
                return "Invalid File Type";
            }
        } catch (Exception $e)
        {
            echo 'File read failed: ' . $e->getMessage();
        }
    }

    public function ReadImagesText () {

        $dir = File::FilesDir();
        $file = public_path().'/'. $dir . $this->filename;
        $ocr = new TesseractOCR();
        $ocr->image($file);
        $text = $ocr->run();
        return $text;

    }

    public function ReadPdf ()
    {
        $parser = new Parser();
        $dir = File::FilesDir();
        $file = public_path().'/'. $dir . $this->filename;
        $pdf = $parser->parseContent(file_get_contents($file));
        $data = $pdf->getText();
        $data = str_replace("\t", '', $data);
        $data = str_replace("\u{A0}", '', $data);

        return $data;
    }

}
