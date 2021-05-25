---
category: Develop
---
# Sending Emails

Sometimes in Matomo or your plugin you'll want to send an email notifying one or more users of something happening, or
providing them some useful or relevant information. In the code, this is done using the `Mail` class.

This guide provides a brief description on how best to do that.

## The Mail class

All mail sending functionality in Matomo goes through the `Mail` class, which in turn uses the PHPMailer library.

Using the class is straightforward:

```php
$config = \Piwik\Config::getInstance();

$mail = new \Piwik\Mail();
$mail->addTo($targetEmail, 'Matomo User');
$mail->setFrom($config->General['noreply_email_address'], $config->General['noreply_email_name']);
$mail->setSubject($subject);
$mail->setWrappedHtmlBody($body);
$mail->send();
```

You can set the body of the email to be custom HTML or just plaintext, but it is better to use the `setWrappedHtmlBody()`
method, as this will surround the text in Matomo branding.

## The Mail Subclass Pattern

It is possible to use the `Mail` class directly to send emails. Currently however, there is a pattern of creating a new
class for every type of email that derives from `Mail`, like so:

```php
class MySpecialEmail extends \Piwik\Mail
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var int
     */
    private $idSite;

    public function __construct($login, $emailAddress, $idSite)
    {
        parent::__construct();

        $this->login = $login;
        $this->emailAddress = $emailAddress;
        $this->idSite = $idSite;

        $this->setUpEmail();
    }

    private function setUpEmail()
    {
        $siteName = Site::getNameFor($this->idSite);

        $this->setDefaultFromPiwik();
        $this->addTo($this->emailAddress);
        $this->setSubject(Piwik::translate('MyPlugin_MySpecialEmailSubject', [$siteName]));
        $this->addReplyTo($this->getFrom(), $this->getFromName());
        $this->setWrappedHtmlBody($this->getDefaultBodyView());
    }

    protected function getDefaultBodyView()
    {
        $view = new View('@MyPlugin\_mySpecialemail.twig');
        $view->login = $this->login;
        $view->emailAddress = $this->emailAddress;
        $view->siteName = Site::getNameFor($this->idSite);
        return $view;
    }
}
```

Encapsulating the logic to setup the email reduces the amount of code required to send the email, and allows us
to send it in multiple places, without having to duplicate code:

```php
$login = Piwik::getCurrentUserLogin();

$userModel = new \Piwik\Plugins\UsersManager\Model();
$user = $userModel->getUser($login);
$emailAddress = $user['email'];

$idSite = Common::getRequestVar('idSite');

$mail = new MySpecialEmail($login, $emailAddress, $idSite);
$mail->send();
```
