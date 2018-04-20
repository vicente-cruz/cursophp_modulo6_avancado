<?php

class language {
    
    private $l;
    private $ini;
    private $db;
    
    public function __construct()
    {
        $this->l = ((isset($_SESSION['lang']) && 
                   ( ! empty($_SESSION['lang'])) &&
                   file_exists("lang/".$_SESSION['lang'].".ini")) ? $_SESSION['lang'] : 'pt-br');
        
        $this->ini = parse_ini_file("lang/".$this->l.".ini");
        
        global $pdo;
        $sql = "SELECT * FROM lang WHERE lang = :lang";
        $query = $pdo->prepare($sql);
        $query->bindValue(":lang",$this->l);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll() as $item) {
                $this->db[$item['nome']] = $item['valor'];
            }
        }
    }
    
    public function getLanguage()
    {
        return $this->l;
    }
    
    public function get($word, $return = false)
    {
        
        if (isset($this->ini[$word])) {
            $text = $this->ini[$word];
        }
        elseif (isset($this->db[$word])) {
            $text = $this->db[$word];
        }
        else {
            $text = $word;
        }
        
        if ($return) {
            return $text;
        }
        else {
            echo $text;
        }
    }
}

?>