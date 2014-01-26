<?php

/**
 * Description of TransportTemplate
 *
 * @author Nives
 */
class TransportTemplate implements Serializable{
    protected $idTemplate;
    
    function __construct($idTemplate) {
        $this->idTemplate = $idTemplate;
    }

    public function getId() {
        return $this->idTemplate;
    }
    
    public function serialize() {
        return serialize(
            array(
                'idTemplate' => $this->idTemplate
            )
        );
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        
        $this->idTemplate = $data['idTemplate'];
    }

}
