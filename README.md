# MessageToolbox

Mit dieser Toolbox können Rückmeldungen an den Nutzer einer Seite im Frontend ausgegeben werden. Die Meldungen werden
in der Session zwischengespeichert und können z.B. nach dem Redirect bim Speichern eines Formulars ausgegeben werden.


## Installtion 

Die Installation durch Eintragung in die composer.json, mittels Deploy Token.


## Verwendung

```php
<?php

class MyClass {

    public function setMessage() {
        $sm = \Contao\System::getContainer()->get('esit_messagetoolbox.services.session.message');
        $sm->addMessage('languageKey_or_message');
    }

    public function getMessages() {
        $sm         = \Contao\System::getContainer()->get('esit_messagetoolbox.services.session.message');
        $messages   = $sm->getMessages();
        $sm->deleteMessages();  // Delete all Messages!
        var_dump($messages);    // Array of Messages!
    }

    public function outputMessages() {
        $sm = \Contao\System::getContainer()->get('esit_messagetoolbox.services.session.message');
        echo $sm->ouput();      // Output string with default template AND DELETES ALL MESSAGES!
    }
}
```

### Inhaltselement

Für die Ausgabe steht auch ein Inhaltselement zur Verfügung. Dies kann ganz normal in einen Artikel eingebunden werden.
Es gibt die Messages aus und löscht dann die Meldungen, damit sie nicht mehrfach ausgegeben werden können.


### Übersetzung der Ausgabe

Die Übersetzung der Ausgabe steht in der Sprachdatei `default.php`:

```php
$GLOBALS['TL_LANG']['MSC']['messagetoolbox']['output']['languageKey_or_message'] = 'Toller Nachrichtentext!';
```

Ist für den mit `$sm->addMessage('languageKey_or_message');` gesetzten Key ein Eineintrag in 
`$GLOBALS['TL_LANG']['MSC']['messagetoolbox']['output']` vorganden, wird dieser im Standardtemplate ausgegeben.


## Autor

- __e@sy Solutions IT__: Patrick Froch <info@easySolutionsIT.de>

