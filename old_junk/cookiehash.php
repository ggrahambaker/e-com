<?php
define('HASH_TYPE', 'sha256');
$hash_len = strlen(hash(HASH_TYPE, 'sample text', true));

function my_encrypt($plaintext, $password)
{
    global $hash_len;

    # generate a binary key
    $securekey = hash(HASH_TYPE,$password,TRUE);

    # create a random IV to use with CBC encoding
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    # creates a cipher text compatible with AES (Rijndael block size = 128)
    # to keep the text confidential 
    # only suitable for encoded input that never ends with value 00h
    # (because of default zero padding)
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $securekey,
                    $plaintext, MCRYPT_MODE_CBC, $iv);

    # prepend the IV for it to be available for decryption
    $ciphertext = $iv . $ciphertext;

    # create a hash to protect against tampering
    $hash = hash(HASH_TYPE, $ciphertext, true);
    $hashed_cipher = $hash . $ciphertext;

    # encode the resulting cipher text so it can be represented by a string
    $ciphertext_base64 = base64_encode($hashed_cipher);

    return $ciphertext_base64;
}


# --- DECRYPTION ---
function my_decrypt($ciphertext, $password)
{
    global $hash_len;

    # generate a binary key
    $securekey = hash(HASH_TYPE,$password,TRUE);

    # undo base64
    $ciphertext_dec = base64_decode($ciphertext);


    # extract and check hash
    $hash = substr($ciphertext_dec, 0, $hash_len);
    $ciphertext_dec = substr($ciphertext_dec, $hash_len);

    if (hash(HASH_TYPE, $ciphertext_dec, true) !== $hash)
    {
        // ######################
        echo "cipher hash was invalid<br>\n";
        // Hash failure
        return false;
    }

    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv_dec = substr($ciphertext_dec, 0, $iv_size);

    # retrieves the cipher text (everything except the $iv_size in the front)
    $ciphertext_dec = substr($ciphertext_dec, $iv_size);

    # decrypt
    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $securekey,
        $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

    # strip trailing nulls
    $plaintext = rtrim($plaintext_dec);
    return $plaintext;
}
?>

<!doctype html>
<html>
<body>
<?php
require 'PasswordHash.php';

if (empty($_POST))
{
?>
<form action='cookiehash.php' method='post'>
username: <input type=text name=username><br>
password: <input type=text name=password><br>
<input type=submit name="submit" value="test"><br>
</form>
<?php
} else {
    $user = $_POST["username"];
    $password = $_POST["password"];

    $timepass = time().$password;
    echo "timestamp+pass: $timepass<br>";

    $hash = my_encrypt($password, "some secret");

    echo "Hash: $hash<br>";

    $decode = my_decrypt($hash, "some secret");
    if ($decode == false) die("Hash was tampered with");

    echo "Decoded: $decode<br>";
    if ($decode === $password)
    {
        echo "Hash was valid<br>";
    } else {
        echo "Hash was not valid<br>";
    }
}
?>
</body>
</html>



