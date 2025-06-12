<?php

namespace Classes;

class Encrypt
{
    private $primeiraKey;
    private $segundaKey;
    private $method = 'aes-256-cbc';

    public function __construct()
    {
        $this->primeiraKey = TOKEN;
        $this->segundaKey = TOKEN_SECUNDARY;
    }

    public function encrypt(string $data): string
    {
        return $this->secureEncrypt($data);
    }

    public function decrypt(string $input): ?string
    {
        return $this->secureDecrypt($input);
    }

    private function secureEncrypt(string $data): string
    {
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $firstEncrypted = openssl_encrypt($data, $this->method, $this->primeiraKey, OPENSSL_RAW_DATA, $iv);

        $secondEncrypted = hash_hmac('sha3-512', $firstEncrypted, $this->segundaKey, true);

        return base64_encode($iv . $secondEncrypted . $firstEncrypted);
    }

    private function secureDecrypt(string $input): ?string
    {
        $mix = base64_decode($input);

        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = substr($mix, 0, $ivLength);
        $secondEncrypted = substr($mix, $ivLength, 64);
        $firstEncrypted = substr($mix, $ivLength + 64);

        $data = openssl_decrypt($firstEncrypted, $this->method, $this->primeiraKey, OPENSSL_RAW_DATA, $iv);

        $secondEncryptedNew = hash_hmac('sha3-512', $firstEncrypted, $this->segundaKey, true);

        if (hash_equals($secondEncrypted, $secondEncryptedNew)) {
            return $data;
        }

        return null;
    }
}
?>
