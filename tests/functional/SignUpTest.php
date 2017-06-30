<?php
use PHPUnit\Framework\TestCase;

/**
 * @covers signup
 */
final class SignInTest extends TestCase
{
    public function testAllValid()
    {
        header("Location:../../index.php");
    }
    
    public function testAlreadyUsedPseudo()
    {
        header("Location:./index.php");
    }
    
    public function testAlreadyUsedEmail()
    {
        header("Location:./index.php");
    }
    
    public function testWrongPassword()
    {
        header("Location:./index.php");
    }

    public function testDifferentPassword()
    {
        header("Location:./index.php");
    }
    

}