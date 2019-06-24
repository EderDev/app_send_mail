<?php
    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensage = null;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function mensagemValida(){

        }
    }

    $mensagem = new Mensagem();

