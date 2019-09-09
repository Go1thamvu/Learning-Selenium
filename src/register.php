<?php

require __DIR__.'/../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$caps = new DesiredCapabilities();
$caps->setCapability(WebDriverCapabilityType::BROWSER_NAME, WebDriverBrowserType::CHROME);
$caps->setCapability(WebDriverCapabilityType::VERSION, '75.0');
$caps->setCapability('selenoid:options', [
    WebDriverCapabilityType::BROWSER_NAME => WebDriverBrowserType::ANDROID,
    'skin' => 'WXGA720'
]);
// These capabilities are for Selenoid only
$caps->setCapability('enableVNC', true);
$caps->setCapability('enableLog', false);
$caps->setCapability('enableVideo', true);

$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);

$url = 'https://www.phptravels.net/';

$driver->get($url.'register');
$driver->wait(10, 1000)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('headersignupform'))
);

$driver->quit();
