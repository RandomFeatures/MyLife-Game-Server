<?php
/*
 Description:    commonly used web routines

 ****************History************************************
 Date:         	9.14.2009
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

function generatePassword($length=6,$level=2){

	list($usec, $sec) = explode(' ', microtime());
	srand((float) $sec + ((float) $usec * 100000));

	$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
	$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

	$password  = "";
	$counter   = 0;

	while ($counter < $length) {
		$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

		// All character must be different
		if (!strstr($password, $actChar)) {
			$password .= $actChar;
			$counter++;
		}
	}

	return $password;

}

function base64_url_encode($input) {
	return strtr(base64_encode($input), '+/=', '-_,');
}

function base64_url_decode($input) {
	return base64_decode(strtr($input, '-_,', '+/='));
}

function strip_html_tags($text)
{
	$text=preg_replace(array
	(
	// Remove invisible content
        '@<head[^>]*?>.*?</head>@siu',
        '@<style[^>]*?>.*?</style>@siu',
        '@<script[^>]*?.*?</script>@siu',
        '@<object[^>]*?.*?</object>@siu',
        '@<embed[^>]*?.*?</embed>@siu',
        '@<applet[^>]*?.*?</applet>@siu',
        '@<noframes[^>]*?.*?</noframes>@siu',
        '@<noscript[^>]*?.*?</noscript>@siu',
        '@<noembed[^>]*?.*?</noembed>@siu',
        '@<iframe[^>]*?.*?</iframe>@siu',
        '@<a[^>]*?.*?</a>@siu',
	// Add line breaks before and after blocks
        '@</?((address)|(blockquote)|(center)|(del))@iu',
        '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
        '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
        '@</?((table)|(th)|(tr)|(td)|(caption))@iu',
        '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
        '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
        '@</?((frameset)|(frame)|(iframe))@iu',
	), array
	(
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        "\n\$0",
        "\n\$0",
        "\n\$0",
        "\n\$0",
        "\n\$0",
        "\n\$0",
        "\n\$0",
        "\n\$0",
	), $text);

	return strip_tags($text);
}

function strip_img_tags($text)
{
	$text=preg_replace(array
	(
	// Remove invisible content
        '@<img[^>]*?>.*?</img>@siu',
        '@<img[^>]*?>@siu',
	), array
	(
        ' ',
        ' ',
	), $text);

	return $text;
}

//escape quotes from a string
function removequote($strNeutr)
{
	$strNeutr=str_replace("'", "&#39;", $strNeutr);
	return ($strNeutr);
}

//store quotes in a string
function restorequote($strNeutr)
{
	$strNeutr=str_replace("&#39;", "'", $strNeutr);
	return ($strNeutr);
}


//limit the display of text to a specific lenght
function LimitDisplay($msg, $maxlength)
{
	if (strlen($msg) > $maxlength)
	{

		$position=$maxlength; // Define how many characters you want to display.
		$message=substr($msg, 0, $position);
		$tmpstr=
		substr($message, $maxlength,
		1);           // Find what is the last character displaying. We find it by getting only last one character from your display message.

		if ($tmpstr != ' ')
		{                     // In this step, if last character is not ' '(space) do this step .
			// Find until we found that last character is ' '(space)
			// by $position+1 (14+1=15, 15+1=16 until we found ' '(space) that mean character 20)
			while ($tmpstr != ' ' && $position > 0)
			{
				$position=$position - 1;
				$tmpstr=substr($message, $position, 1);
			}
		}

		$strrtn=substr($message, 0, $position) . '...'; // Display your message
	}
	else { $strrtn=$msg; }

	return $strrtn;
}


?>
