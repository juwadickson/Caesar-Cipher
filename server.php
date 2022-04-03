<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
                        <span><h5>Shift Count : '.$shiftCount.'</h5><h4>CipherType : Encrypt</h5><h5>Alphabet : Spanish</h5> </span>
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
                        <span><h5>Shift Count : '.$shiftCount.'</h5> | <h4>CipherType : Encrypt |</h5><h5>Alphabet : Turkish</h5> </span>
                            <h4>'.encryptTurkishWords($inputText, $shiftCount).'</h4>
                        ';
                    }elseif($fileDictionary["cipherType"] == 1){ // Decrypt
                        echo '
                        <span><h5>Shift Count : '.$shiftCount.'</h5> | <h4>CipherType : Decrypt |</h5><h5>Alphabet : Turkish</h5> </span>
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

    function encryptEnglishWords($text, $shiftCount){
        $encryptedText = ""; // Initialize the encrypted text to empty string
        $lowercaseText = strtolower($text); // convert the text to lowercase

        for ($i=0; $i < strlen($lowercaseText); $i++) { // Loop through each characters in the text
            if(preg_match('/[^A-Z]/i', $lowercaseText[$i])){
                $encryptedText = $encryptedText;
            }else{
                $ascii = ord($lowercaseText[$i]); // Get the ASCII code of the character in the text
                $ascii = $ascii - 97;
                $ascii += $shiftCount;
                if($ascii > 25){ // Check if 
                    $ascii = $ascii - 26;
                }
                $encryptedText = $encryptedText.chr($ascii + 97);
            }
        }
        return strtoupper($encryptedText);
    };

    function encryptSpanishWords($text, $shiftCount){
        $lowercase = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'];
        $uppercase = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        return strtoupper(getCipherText($text, $shiftCount,$uppercase, $lowercase));
    };
    
    function encryptTurkishWords($text, $shiftCount){
        $lowercase = ['a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','ŀ','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z'];
        $uppercase = ['A','B','C','Ç','D','E','F','G','Ğ','H','I','Ï','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z'];

        return strtoupper(getCipherText($text, $shiftCount,$uppercase, $lowercase));
    };


    function decryptEnglishWords($text, $shiftCount){
        $plaintext = "";
        $lowercaseText = strtolower($text);

        for ($i=0; $i < strlen($lowercaseText); $i++) { 
            if(preg_match('/[^A-Z]/i', $lowercaseText[$i])){
                $plaintext = $plaintext;
            }else{
                $ascii = ord($lowercaseText[$i]);
                $ascii = $ascii - 97;
                $ascii -= $shiftCount;
                if($ascii < 0){
                    $ascii = $ascii + 26;
                }
                $plaintext = $plaintext.chr($ascii + 97);
            }
        }
        return strtolower($plaintext);
    };
    

    function getCipherText($txt,$sc,$uc,$lc){
        $cipherText = "";
        for($i=0; $i < strlen($txt); $i++){
            if(in_array($txt[$i],$uc) == TRUE){
                $cipherText .= $uc[((array_search($txt[$i],$uc) + $sc) % count($uc))];
            }else{
                $cipherText .= $lc[((array_search($txt[$i],$lc) + $sc) % count($lc))];
            }
        }
        return $cipherText;
    };

?>