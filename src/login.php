<?php

require __DIR__.'/../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver;

$caps = new DesiredCapabilities();
$caps->setCapability(WebDriverCapabilityType::BROWSER_NAME, WebDriverBrowserType::CHROME);
$caps->setCapability(WebDriverCapabilityType::VERSION, '76.0');
// These capabilities are for Selenoid only
$caps->setCapability('enableVNC', true);
$caps->setCapability('enableLog', false);
$caps->setCapability('enableVideo', true);

$webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);

$baseUrl = 'https://www.phptravels.net/';
$invalidEmail = 'xinh.xing@gmail.com';
$password = 'zaq12wsx';

$webDriver->get($baseUrl);
$webDriver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('li_myaccount'))
 );

$driver->quit();
