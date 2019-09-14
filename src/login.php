<?php

require __DIR__.'/../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver;
use Facebook\WebDriver\WebDriverDimension;

$caps = new DesiredCapabilities();
$caps->setCapability(WebDriverCapabilityType::BROWSER_NAME, WebDriverBrowserType::CHROME);
$caps->setCapability(WebDriverCapabilityType::VERSION, '76.0');
// These capabilities are for Selenoid only
$caps->setCapability('enableVNC', true);
$caps->setCapability('enableLog', false);
$caps->setCapability('enableVideo', true);

$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);
// $driver.manage().window().setSize(new Dimension(1024,768));
// $driver->manage()->window()->setSize(new WebDriverDimension(1024, 768));


$baseUrl = 'https://www.phptravels.net/';
$invalidEmail = 'invalid.g@gmail.com';
$password = 'zaq12wsx';

$driver->get($baseUrl);
$driver->manage()->window()->setSize(new WebDriverDimension(1024, 768));
$driver->wait(10, 1000)->until(
    $$driver->findElement(WebDriverBy::xpath("(.//*[normalize-space(text()) and normalize-space(.)='My Account'])[2]/following::a[1]"))->click()
);


$driver->quit();
