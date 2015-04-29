<?php
class Convert
{
    /*=============================================================*/
    // $this->convert->slug($str, $separator = '-', $lowercase = TRUE);
    /*=============================================================*/
	public function slug($str, $separator = '-', $lowercase = TRUE)
    {
        // Separators
		if ($separator == 'dash') {
			$separator = '-';
		}
        else if ($separator == 'underscore') {
			$separator = '_';
		}

        // Quote regular expression characters
		$q_separator = preg_quote($separator);

		$trans = array(
            '&.+?;'                     => '',
            '[^a-z0-9 _-]'              => '',
            '\s+'                       => $separator,
            '(' . $q_separator . ')+'   => $separator
        );

        // Strip HTML and PHP tags from a string
		$str = strip_tags($str);

		foreach ($trans as $key => $val) {
            // Perform a regular expression search and replace
			$str = preg_replace("#" . $key . "#i", $val, $str);
		}

		if ($lowercase === TRUE) {
            // Make a string lowercase
			$str = strtolower($str);
		}

        // Strip whitespace (or other characters) from the beginning and end of a string
        $trim = trim($str, $separator);
		return $trim;
	}
}