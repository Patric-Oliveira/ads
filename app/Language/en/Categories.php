<?php

return [

    'title_index' => 'Listing the Categories',
    'title_new' => 'Create Category',
    'title_edit' => 'Edit Category',

    // Validations

    'name' => [
        'required'   => 'Mandatory field, fill in the name to proceed',
        'min_length' => 'Enter at least 3 characters',
        'max_length' => 'Please enter a maximum of 90 characters',
        'is_unique'  => 'This category already exists',
    ],


];