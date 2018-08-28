<?php
namespace App\Core;

class File
{
    private $name;
    private $type;
    private $tmp_name;
    private $error;
    private $size;

    public function __construct($file)
    {
        $this->name = $file["name"];
        $this->type = $file["type"];
        $this->tmp_name = $file["tmp_name"];
        $this->error = $file["error"];
        $this->size = $file["size"];
    }

    /**
     * Método que salva o arquivo
     * 
     * @param $dir Diretório na pasta public para salvar o arquivo
     */
    public function save($dir)
    {
        // configura o caminho para salvar o arquivo
        $path = ROOT_PATH."public/".$dir.$this->getName();
        
        // salva o arquivo
        move_uploaded_file($this->getTempName(), $path);
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Configura o nome do arquivo
     * 
     * @param $name Nome do arquivo sem a extenção
     */
    public function setName($name)
    {
        $this->name = $name.$this->getExtension();
    }

    public function getType()
    {
        return $this->type;
    }

    public function getExtension()
    {
        return '.'.pathinfo($this->getName(), PATHINFO_EXTENSION);
    }

    public function getTempName()
    {
        return $this->tmp_name;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getSize()
    {
        return $this->size;
    }
}