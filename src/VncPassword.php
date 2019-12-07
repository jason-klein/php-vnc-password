<?php

namespace JasonKlein\PhpVncPassword;

class VncPassword
{
    private $method;
    private $key;
    private $options;
    private $block_size;

    public function __construct()
    {
        // WinVNC uses DES encryption and ECB block mode
        $this->method = 'des-ecb';

        // WinVNC uses a fixed key with reversed bits to encrypt/decrypt password in registry
        // Original Key: \x17\x52\x6B\x06\x23\x4E\x58\x07
        // Reversed Bits: \xE8\x4A\xD6\x60\xC4\x72\x1A\xE0
        $this->key = hex2bin('e84ad660c4721ae0');

        // We are sending raw data with zero padding to OpenSSL
        $this->options = OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING;

        // des-ecb seems to use 8 character block size
        $this->block_size = 8;
    }

    /*
     * Decrypt VNC password from registry
     *
     * @param $encrypted String
     * @return String
     */
    public function decrypt($encrypted): string
    {
        return $this->zero_unpad(openssl_decrypt(hex2bin($encrypted), $this->method, $this->key, $this->options));
    }

    /*
     * Encrypt VNC password for registry
     *
     * @param $password String
     * @return String
     */
    public function encrypt($password): string
    {
        return bin2hex(openssl_encrypt($this->zero_pad($password), $this->method, $this->key, $this->options));
    }

    /*
     * Add zero padding to clear text password so total length is increment of 8 characters
     *
     * @param $text String
     * @return String
     */
    private function zero_pad($text): string
    {
        $length = ceil(strlen($text) / $this->block_size) * $this->block_size;
        return str_pad($text, $length, "\x00");
    }

    /*
     * Remove zero padding from clear text password after decryption
     *
     * @param $text String
     * @return String
     */
    private function zero_unpad($text): string
    {
        return trim($text, "\00");
    }
}
