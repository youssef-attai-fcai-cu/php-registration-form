<?php

return [
    'required' => 'Das :attribute Feld ist erforderlich.',
    'min' => [
        'string' => 'Das :attribute Feld muss mindestens :min Zeichen enthalten.',
    ],
    'password' => [
        'letters' => 'Das :attribute Feld muss mindestens einen Buchstaben enthalten.',
        'mixed' => 'Das :attribute Feld muss mindestens einen Groß- und einen Kleinbuchstaben enthalten.',
        'numbers' => 'Das :attribute Feld muss mindestens eine Zahl enthalten.',
        'symbols' => 'Das :attribute Feld muss mindestens ein Symbol enthalten.',
        'uncompromised' => 'Das angegebene :attribute ist in einem Datendiebstahl aufgetaucht. Bitte wählen Sie ein anderes :attribute.',
    ],
    'same' => 'Das :attribute Feld muss mit :other übereinstimmen.',
    'numeric' => 'Das :attribute Feld muss eine Zahl sein.',
    'digits' => 'Das :attribute Feld muss :digits Ziffern enthalten.',
    'email' => 'Das :attribute Feld muss eine gültige E-Mail-Adresse sein.',
    'date' => 'Das :attribute Feld muss ein gültiges Datum sein.',
];
