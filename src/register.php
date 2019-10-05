<?php

require __DIR__.'/../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Webmozart\Assert\Assert;

$caps = new DesiredCapabilities();
$caps->setCapability(WebDriverCapabilityType::BROWSER_NAME, WebDriverBrowserType::CHROME);
$caps->setCapability(WebDriverCapabilityType::VERSION, '76.0');

// These capabilities are for Selenoid only
$caps->setCapability('enableVNC', true);
$caps->setCapability('enableLog', false);
$caps->setCapability('enableVideo', true);

$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);

$baseUrl = 'https://www.phptravels.net';
$firtName = 'Tham';
$lastName = 'Vu';
$phone = '0123456789';
$email = time().'.account@gmail.com';
$password = '1234567890';

$driver->manage()->window()->maximize();
$driver->get($baseUrl);
$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::cssSelector('.container .user_menu li a'))
);

$driver->findElement(WebDriverBy::cssSelector('.container .user_menu li a'))->click();

$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.container .user_menu li .dropdown-menu'))
);

$driver->findElement(WebDriverBy::cssSelector('.container .user_menu li .dropdown-menu a[href*="https://www.phptravels.net/register"]'))->click();

$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('headersignupform'))
);

$driver->findElement(WebDriverBy::cssSelector('input[name = firstname]'))->sendKeys($firtName);
$driver->findElement(WebDriverBy::cssSelector('input[name = lastname]'))->sendKeys($lastName);
$driver->findElement(WebDriverBy::cssSelector('input[name = phone]'))->sendKeys($phone);
$driver->findElement(WebDriverBy::cssSelector('input[name = email]'))->sendKeys($email);
$driver->findElement(WebDriverBy::cssSelector('input[name = password]'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('input[name = confirmpassword]'))->sendKeys($password);

$driver->findElement(WebDriverBy::cssSelector('.signupbtn'))->click();

$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::urlIs('https://www.phptravels.net/account/')
);

Assert::eq(
    'My Account',
    $driver->getTitle()
);

$driver->quit();
