<?php

require_once __DIR__ . '/../vendor/autoload.php';

class CustomForm extends \Sirius\Html\Tag {

    protected $tag = 'form';

    function __construct($props = null, $content = null, \Sirius\Html\Builder $builder) {
        parent::__construct($props, $content, $builder);
        $data = $this->get('_data');
        $this->set('action', $data['form_url']);
        $this->setContent(array(
            $this->builder->make('custom-form-group', array('_classes' => $data['classes'], '_field' => $data['username'])),
            $this->builder->make('custom-form-group', array('_classes' => $data['classes'], '_field' => $data['email'])),
            $this->builder->make('submit', array('class' => $data['classes']['submit']))
        ));
    }
}

class CustomFormGroup extends \Sirius\Html\Tag {
    protected $tag = 'div';

    function __construct($props = null, $content = null, \Sirius\Html\Builder $builder) {
        parent::__construct($props, $content, $builder);
        $classes = $this->get('_classes');
        $field = $this->get('_field');
        $this->set('class', $classes['form_group']);
        $this->setContent(array(
            $this->builder->make('label', array('class' => $classes['form_label']), $field['label']),
            $this->builder->make('text', array('class' => $classes['form_control']), $field['value'])
        ));
    }
}

$h = new \Sirius\Html\Builder();
$h->registerTag('custom-form', 'CustomForm');
$h->registerTag('custom-form-group', 'CustomFormGroup');

$data = array(
    'form_url' => 'http://www.google.com',
    'classes' => array(
        'form_group' => 'form-group',
        'form_label' => 'form-label',
        'form_control' => 'form-control',
        'submit' => 'btn btn-primary'
    ),
    'email' => array(
        'label' => 'Your email',
        'value' => 'me@domain.com',
    ),
    'username' => array(
        'label' => 'Username',
        'value' => 'twig',
    )
);

$customForm = $h->make('custom-form', array('_data' => $data));
echo $customForm;

$start = microtime(true);
for ($i = 0; $i < 1000; $i++) {
    $result = (string)$customForm;
}

echo PHP_EOL, '-----------------------------', PHP_EOL;
echo 'Duration: ', microtime(true) - $start, PHP_EOL;
echo 'Memory:', memory_get_peak_usage();