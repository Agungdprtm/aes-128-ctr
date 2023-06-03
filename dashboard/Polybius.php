<?php

class Polybius
{
    // Polybius cipher encryption
    function polybiusEncrypt($plaintext)
    {
        // Polybius cipher encryption
        $grid = array(
            array('A', 'B', 'C', 'D', 'E'),
            array('F', 'G', 'H', 'I', 'K'),
            array('L', 'M', 'N', 'O', 'P'),
            array('Q', 'R', 'S', 'T', 'U'),
            array('V', 'W', 'X', 'Y', 'Z')
        );

        $ciphertext = "";
        $plaintext = strtoupper($plaintext);

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $char = $plaintext[$i];
            if ($char == 'J')
                $char = 'I'; // Replace 'J' with 'I'

            for ($row = 0; $row < 5; $row++) {
                for ($col = 0; $col < 5; $col++) {
                    if ($grid[$row][$col] == $char) {
                        $ciphertext .= ($row + 1) . ($col + 1); // Append coordinates
                    }
                }
            }
        }

        return $ciphertext;
    }

    function polybiusDecrypt($ciphertext)
    {
        // Polybius cipher decryption
        $grid = array(
            array('A', 'B', 'C', 'D', 'E'),
            array('F', 'G', 'H', 'I', 'K'),
            array('L', 'M', 'N', 'O', 'P'),
            array('Q', 'R', 'S', 'T', 'U'),
            array('V', 'W', 'X', 'Y', 'Z')
        );

        $plaintext = "";
        $ciphertext = str_replace(' ', '', $ciphertext);

        for ($i = 0; $i < strlen($ciphertext); $i += 2) {
            $row = intval($ciphertext[$i]) - 1;
            $col = intval($ciphertext[$i + 1]) - 1;
            $plaintext .= $grid[$row][$col];
        }

        return $plaintext;
    }
}

?>