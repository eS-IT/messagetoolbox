# MessageToolbox

Mit dieser Toolbox können Rückmeldungen an den Nutzer einer Seite im Frontend ausgegeben werden. Die Meldungen werden
in der Session zwischengespeichert und können z.B. nach dem Redirect bim Speichern eines Formulars ausgegeben werden.

## Installtion 

Die Installation erfolgt am einfachsten über die ComoperToolbox.

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

Für die Ausgabe steht auch ein Inhaltselement zur Verfügung.

## Autor

- __e@sy Solutions IT__: Patrick Froch <info@easySolutionsIT.de>

