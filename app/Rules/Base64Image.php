<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Image implements Rule
{
public function passes($attribute, $value)
{
// Check if the value is a base64 image
if (preg_match('/^data:image\/(\w+);base64,/', $value, $type)) {
$mimeType = strtolower($type[1]);
// Check mime types, e.g., jpg, png, gif
$validMimeTypes = ['jpeg', 'png', 'jpg', 'gif'];
return in_array($mimeType, $validMimeTypes);
}

// If not a base64 image, validate as a file
return $value->isValid() && $value->isImage();
}

public function message()
{
return 'The :attribute must be a valid image.';
}
}
