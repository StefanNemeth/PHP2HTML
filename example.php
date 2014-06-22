<?php

/**
 * ----------------------------------------
 * Example - PHP2HTML
 * ----------------------------------------
 * https://github.com/SteveWinfield/PHP2HTML
**/
include 'php2html.php';

// Create error html object
$errorObject = HTML::strong(['color'=>'red'], 'Default message');

switch ($error->errorCode) {
	case 0:
		// Set error message
		$errorObject->setContent('Oh.. Login details incorrect.');
		break;
	case 1:
		// Set error message
		$errorObject->setContent('Permission denied, I am sorry.');
		break;
}

			// Create html body with attributes
$content =	HTML::body(['style'=>'background:#fff','onLoad'=>'alert(\'Welcome!\')'],
				// Create html input
				HTML::input(['type'=>'text']),
				// Reference to $errorObject
				$errorObject
			);

// Print out content
echo $content;

