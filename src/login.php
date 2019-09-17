<?php

require __DIR__.'/../vendor/autoload.php';

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

$baseUrl = 'http://automationpractice.com';
$email = 'abc@xyz.com';
$password = 'Test@123';

$driver->manage()->window()->maximize();
$driver->get($baseUrl);
$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfAnyElementLocated(WebDriverBy::cssSelector('.login'))
);

$driver->findElement(WebDriverBy::cssSelector('.login'))->click();

$driver->findElement(WebDriverBy::id('email'))->sendKeys($email);
$driver->findElement(WebDriverBy::id('passwd'))->sendKeys($password);
$driver->findElement(WebDriverBy::id('SubmitLogin'))->click();

$driver->quit();
