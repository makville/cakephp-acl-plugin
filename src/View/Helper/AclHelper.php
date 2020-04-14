<?php

declare(strict_types = 1);

namespace MakvilleAcl\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Acl helper
 */
class AclHelper extends Helper {

    public $helpers = ['Form'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function profileControl($field, $value = null, $id = null) {
        $config = ['class' => 'form-control'];
        if ($field->label != '') {
            $config['label'] = $field->label;
        }
        if ($field->required) {
            $config['required'] = true;
        }
        if(!is_null($value)) {
            $config['value'] = $value;
        }
        switch ($field->input_type) {
            case 'short-text':
                $config['type'] = 'text';
                break;
            case 'long-text':
                $config['type'] = 'textarea';
                break;
            case 'number':
                $config['type'] = 'number';
                break;
            case 'date':
                $config['type'] = 'text';
                break;
            case 'single-choice':
                $config['options'] = $options = json_decode($field->options, true);
                break;
            case 'multiple-choice':
                $config['options'] = $options = json_decode($field->options, true);
                $config['multiple'] = 'multiple';
                $config['class'] .= ' select2';
                break;
        }
        return $this->Form->hidden('user_profiles.' . $field->id . '.id', ['value' => $id]) . 
                $this->Form->hidden('user_profiles.' . $field->id . '.user_profile_field_id', ['value' => $field->id]) . 
                $this->Form->control('user_profiles.' . $field->id . '.value', $config);
    }

    public function notify ($event) {
        if ($this->_View->elementExists("acl/notifications/$event")) {
            echo $this->_View->element("acl/notifications/$event");
        } else {
            echo $this->_View->element("MakvilleAcl.notifications/$event");
        }
    }
    
    public function loadAccountMenu () {
        if ($this->_View->elementExists('acl/account-menu')) {
            echo $this->_View->element('acl/account-menu');
        } else {
            echo $this->_View->element('MakvilleAcl.layout/account-menu');
        }
    }
}
