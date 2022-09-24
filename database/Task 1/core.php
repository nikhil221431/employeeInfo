<?php

    class TextInput
    {    
        protected $str = '';

        public function add($text) {
            $this->str .= $text;
        }
        public function getValue() {
            return $this->str;
        }
    }

    class NumericInput extends TextInput
    {

        public function add($text) {
            if ( is_numeric($text)) {
                $this->str .= $text;
            }
        }
    }

    $input = new NumericInput();
    $input->add('1');
    $input->add('a');
    $input->add('0');
    echo $input->getValue();
?>