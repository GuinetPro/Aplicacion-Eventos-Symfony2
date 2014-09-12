<?php
namespace Yoda\EventBundle\Reporting;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Router;
/**
 *¿Qué es un servicio?
 *En pocas palabras, un Servicio es cualquier objeto PHP que realiza algún tipo de tarea «global». 
 *Es un nombre genérico que se utiliza a propósito en informática para describir un objeto creado 
 *para un propósito específico (por ejemplo, la entrega de mensajes de correo electrónico). 
 *Cada servicio se utiliza en toda tu aplicación cada vez que necesites la funcionalidad específica 
 *que proporciona. No tienes que hacer nada especial para hacer un servicio: simplemente escribe 
 *una clase PHP con algo de código que realice una tarea específica. ¡Felicidades, 
 *acabas de crear un servicio!
 */

class EventReportManager
{	
	private $em;

    private $router;

    public function __construct(EntityManager $em, Router $router)
    {
        $this->em = $em;
        $this->router = $router;
    }
	/**
	 * [getRecentlyUpdatedReport description]
	 * @return [type] [description]
	 */
    public function getRecentlyUpdatedReport()
    {
        $events = $this->em->getRepository('EventBundle:Event')
        ->getRecentlyUpdatedEvents();

        $rows = array();
        foreach ($events as $event) {
            $data = array( $event->getId(), 
            			   $event->getName(), 
            			   $event->getTime()->format('Y-m-d H:i:s'),
            			   $this->router->generate(
						        'event_show',
						        array('slug' => $event->getSlug()),
						        true
						    )
            			  );

            $rows[] = implode(',', $data);
        }

        return implode("\n", $rows);
    }
}