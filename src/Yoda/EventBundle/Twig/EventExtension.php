<?php
namespace Yoda\EventBundle\Twig;

class EventExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'event';
    }

    public function getFilters(){

	    return array(
	        new \Twig_SimpleFilter('ago', array($this, 'calculateAgo')),
	    );
	}

	public function ago(\DateTime $dt){
    	
    	return DateUtil::ago($dt);
	}

}