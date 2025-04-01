
<?php

use google\appengine\api\mail\Message;

// Notice that $image_content_id is the optional Content-ID header value of the
// attachment. Must be enclosed by angle brackets (<>)
// $image_content_id = '<image-content-id>';

// Pull in the raw file data of the image file to attach it to the message.
// $image_data = file_get_contents('image.jpg');

try {
    $message = new Message();
    $message->setSender('ranjitdsouza26@gamil.com');
    $message->addTo('johndsouza26@icloud.com');
    $message->setSubject('Example email');
    $message->setTextBody('Hello, world!');
    // $message->addAttachment('image.jpg', $image_data, $image_content_id);
    $message->send();
    echo 'Mail Sent';
} catch (InvalidArgumentException $e) {
    echo 'There was an error';
}
?>