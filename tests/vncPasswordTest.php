<?php

use JasonKlein\PhpVncPassword\VncPassword;
use PHPUnit\Framework\TestCase;

class vncPasswordTest extends TestCase
{

    public function testDecrypt()
    {
        $vnc = new VncPassword();
        $encrypted = 'd7a514d8c556aade';
        $decrypted = $vnc->decrypt($encrypted);
        $expected = 'Secure!';
        $this->assertEquals($expected, $decrypted);
    }

    public function testEncrypt()
    {
        $vnc = new VncPassword();
        $decrypted = 'Secure!';
        $encrypted = $vnc->encrypt($decrypted);
        $expected = 'd7a514d8c556aade';
        $this->assertEquals($expected, $encrypted);
    }
}
