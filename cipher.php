<?php

    // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    
    if(isset($_POST['cipher'])){
        $inputFile = $_POST['inputFile'];
        $inputFileFormat = verifyInputFormat($_POST['inputFile']);
        
        if($inputFileFormat == TRUE){
            $inputFileArray = preg_split("/:/", $inputFile);
            $fileDictionary = array(
                "shiftCount" => $inputFileArray[0],
                "cipherType" => $inputFileArray[1],
                "alphabet" => $inputFileArray[2],
                "cipherText" => $inputFileArray[3],
            );

            $shiftCount = $fileDictionary['shiftCount'];
            $alphabet = $fileDictionary['alphabet'];
            $inputText = $fileDictionary['cipherText'];
            // Check the Alphabet to Determine the language
            // English => 0 French => 1 Spainish => 2 Turkish => 3
            
            switch ($alphabet) {
                case 0:
                    if($fileDictionary["cipherType"] == 0){ // Encrypt
                        echo '
                            <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Encrypt</h5><h5>Alphabet : English</h5> </span>
                            <h4>'.encryptEnglishWords($inputText, $shiftCount).'</h4>
                        ';
                    }elseif($fileDictionary["cipherType"] == 1){ // Decrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Decrypt</h5><h5>Alphabet : English</h5> </span>
                            <h4>'.decryptEnglishWords($inputText, $shiftCount).'</h4>
                        ';
                    }
                    break;
                case 1:
                    if($fileDictionary["cipherType"] == 0){ // Encrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Encrypt</h5><h5>Alphabet : French</h5> </span>
                            <h4>'.encryptEnglishWords($inputText, $shiftCount).'</h4>
                        ';
                    }elseif($fileDictionary["cipherType"] == 1){ // Decrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Decrypt</h5><h5>Alphabet : French</h5> </span>
                            <h4>'.decryptEnglishWords($inputText, $shiftCount).'</h4>
                        ';
                    }
                    break;
                case 2:
                    if($fileDictionary["cipherType"] == 0){ // Encrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Encrypt</h5><h5>Alphabet : Spanish</h5> </span>
                            <h4>'.encryptSpanishWords($inputText, $shiftCount).'</h4>
                        ';
                    }elseif($fileDictionary["cipherType"] == 1){ // Decrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Decrypt</h5><h5>Alphabet : Spanish</h5> </span>
                            <h4>'.decryptSpanishWords($inputText, $shiftCount).'</h4>
                        ';
                    }
                    break;
                case 3:
                    if($fileDictionary["cipherType"] == 0){ // Encrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Encrypt</h5><h5>Alphabet : Turkish</h5> </span>
                            <h4>'.encryptTurkishWords($inputText, $shiftCount).'</h4>
                        ';
                    }elseif($fileDictionary["cipherType"] == 1){ // Decrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h5>CipherType : Decrypt</h5><h5>Alphabet : Turkish</h5> </span>
                            <h4>'.decryptTurkishWords($inputText, $shiftCount).'</h4>
                        ';
                    }
                    break;
                                        
                default:
                    # code...
                    break;
            }
            // Check the CipherType to Know if The user wants to Encrypt or Decrypt
            // Encrypt => 0,  Decrypt => 1
            
            
        }else{
            echo '
                <span style="color:red">
                Error: File Input Format Incorrect
                <p>Format:</p>
                <p style="font-size: 11px">[Shift Count]:[Encrypt/De-crypt]:[Alphabet 0-4]:Plain text/Cipher Text<p>
                <p style="font-size: 11px">Input File Example - 4:0:0:Hello world<p>
                </span>
            ';

        }
    }

    function verifyInputFormat($input){
        $pattern = '/^(?:[1-9]|[1-9][0-9]+)(:)[01](:)[0123](:)[a-zA-Z]+( [a-zA-Z_]+)*$/';
        return preg_match_all($pattern, $input);
    };

    function encryptEnglishWords($text, $shift){

        $englishUcAlpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $englishLcAlpha = "abcdefghijklmnopqrstuvwxyz";

        $cipherText = "";

        for ($i=0; $i < strlen($text); $i++) { 
            $letter = $text[$i];

            $uppercase = strpos($englishUcAlpha, $letter);
            $lowercase = strpos($englishLcAlpha, $letter);
            // Return Number if letter is number
            if(is_numeric($letter)){
                $cipherText .= $letter;
            }elseif($letter == " "){
                $cipherText .= $letter;
            }elseif($lowercase){
                $enc = ($lowercase + $shift) % 26;
                $cipherText .= $englishLcAlpha[$enc];
            }
            else{// for uppercase
                $enc = ($uppercase + $shift) % 26;
                $cipherText .= $englishUcAlpha[$enc];
            }
        }
        return strtoupper($cipherText);
    }

    function encryptSpanishWords($text, $shift){
        $spanishLcAlpha = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'];
        $spanishUcAlpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        $cipherText = "";
        for ($i=0; $i < strlen($text) ; $i++) { 
            $letter = $text[$i];

            $letterPositionInUcAlpha = array_search($letter,$spanishUcAlpha);
            $letterPositionInLcAlpha = array_search($letter,$spanishLcAlpha);
            // Return Number if letter is number
            if($letter == " "){
                $cipherText .= $letter;
            }elseif($letterPositionInLcAlpha){
                $cipherText .= $spanishLcAlpha[(($letterPositionInLcAlpha + $shift) % count($spanishLcAlpha))];
            }
            else{// for uppercase
                $cipherText .= $spanishUcAlpha[(($letterPositionInUcAlpha + $shift) % count($spanishUcAlpha))];
            }
        }
        return strtoupper($cipherText);
    }

    function encryptTurkishWords($text, $shift){
        $turkishLcAlpha = ['a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','ŀ','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z'];
        $turkishUcAlpha = ['A','B','C','Ç','D','E','F','G','Ğ','H','I','Ï','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z'];

        $cipherText = "";
        for ($i=0; $i < strlen($text) ; $i++) { 
            $letter = $text[$i];

            $letterPositionInUcAlpha = array_search($text[$i],$turkishUcAlpha);
            $letterPositionInLcAlpha = array_search($text[$i],$turkishLcAlpha);
            // Return Number if letter is number
            if($letter == " "){
                $cipherText .= $letter;
            }elseif($letterPositionInLcAlpha){
                $cipherText .= $turkishLcAlpha[(($letterPositionInLcAlpha + $shift) % count($turkishLcAlpha))];
            }
            else{// for uppercase
                $cipherText .= $turkishUcAlpha[(($letterPositionInUcAlpha + $shift) % count($turkishUcAlpha))];
            }
        }
        return strtoupper($cipherText);
    };

    function decryptSpanishWords($text, $shift){
        $spanishLcAlpha = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'];
        $spanishUcAlpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        $len = count($spanishUcAlpha);
        $plainText = "";
        for ($i=0; $i < strlen($text) ; $i++) { 
            $letter = $text[$i];

            $letterPositionInUcAlpha = array_search($letter,$spanishUcAlpha);
            $letterPositionInLcAlpha = array_search($letter,$spanishLcAlpha);
            
            // Return Number if letter is number
            if($letter == " "){
                $plainText .= $letter;
            }elseif($letterPositionInLcAlpha){
                $plainText .= $spanishLcAlpha[(($letterPositionInLcAlpha - $shift) % $len)];
            }
            else{// for uppercase
                $plainText .= $spanishUcAlpha[(($letterPositionInUcAlpha - $shift) % $len)];
            }
        }
        return strtolower($plainText);
    }

    function decryptEnglishWords($text, $shift){
        $englishUcAlpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $englishLcAlpha = "abcdefghijklmnopqrstuvwxyz";

        $plainText = "";

        for ($i=0; $i < strlen($text); $i++) { 
            $letter = $text[$i];

            $uppercase = strpos($englishUcAlpha, $letter);
            $lowercase = strpos($englishLcAlpha, $letter);
            // Return Number if letter is number
            if(is_numeric($letter)){
                $plainText .= $letter;
            }elseif($letter == " "){
                $plainText .= $letter;
            }elseif($lowercase){
                $enc = ($lowercase - $shift) % 26;
                $plainText .= $englishLcAlpha[$enc];
            }
            else{// for uppercase
                $enc = ($uppercase - $shift) % 26;
                $plainText .= $englishUcAlpha[$enc];
            }
        }
        return strtolower($plainText);
    }
    
    
    
?>