PHP2HTML
========

Convert PHP Code to HTML Text

## Why PHP2HTML?
You don't need to learn a second template pseudo-language just to stitch your HTML fragments together. On top of that your code is stressless more structured.

## Example

```php
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
```
This example prints out:
```html
<body style="background:#fff" onLoad="alert('Welcome!')">
	<input type="text">
	<strong color="red">Oh.. Login details incorrect.</strong>
</body>
```