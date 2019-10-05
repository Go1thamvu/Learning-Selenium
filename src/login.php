<?php

require __DIR__.'/../vendor/autoload.php';

use Webmozart\Assert\Assert;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

$caps = new DesiredCapabilities();
$caps->setCapability(WebDriverCapabilityType::BROWSER_NAME, WebDriverBrowserType::CHROME);
$caps->setCapability(WebDriverCapabilityType::VERSION, '76.0');
// These capabilities are for Selenoid only
$caps->setCapability('enableVNC', true);
$caps->setCapability('enableLog', false);
$caps->setCapability('enableVideo', true);

$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);

$baseUrl = 'https://www.phptravels.net';
$email = 'tham.vu@go1.com';
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

$driver->findElement(WebDriverBy::cssSelector('.container .user_menu li .dropdown-menu a[href*="www.phptravels.net/login"]'))->click();

$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('input[name = username]'))
);

$driver->findElement(WebDriverBy::cssSelector('input[name = username]'))->sendKeys($email);
$driver->findElement(WebDriverBy::cssSelector('input[name = password]'))->sendKeys($password);
$driver->findElement(WebDriverBy::cssSelector('.loginbtn'))->click();
$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::urlIs('https://www.phptravels.net/account/')
);

Assert::eq(
    'My Account',
    $driver->getTitle()
);

$driver->quit();
