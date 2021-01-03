<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactoController extends AbstractController
{
private $contactos = array(
array("codigo" => 1, "nombre" => "Juan Pérez",
"telefono" => "966112233", "email" => "juanp@gmail.com"), array("codigo" => 2, "nombre" => "Ana López",
"telefono" => "965667788", "email" => "anita@hotmail.com"), array("codigo" => 3, "nombre" => "Mario Montero",
"telefono" => "965929190", "email" => "mario.mont@gmail.com"), array("codigo" => 4, "nombre" => "Laura Martínez",
"telefono" => "611223344", "email" => "lm2000@gmail.com"), array("codigo" => 5, "nombre" => "Nora Jover",
"telefono" => "638765432", "email" => "norajover@hotmail.com"),
);

/**
* @Route("/contacto/{codigo}", name="ficha_contacto", requirements={"codigo"="\d+"})
*/
public function ficha($codigo)
{
    $resultado = array_filter($this->contactos,
    function($contacto) use ($codigo)
    {
    return $contacto["codigo"] == $codigo;
    });
    if (count($resultado) > 0)
    return $this->render('ficha_contacto.html.twig', array(
    'contacto' => array_shift($resultado)
    ));
    else
    return $this->render('ficha_contacto.html.twig', array(
    'contacto' => NULL
    ));
    }
/**
* @Route("/contacto/{texto}", name="buscar_contacto")
*/
public function buscar($texto)
{
$resultado = array_filter($this->contactos,
function($contacto) use ($texto)
{
return strpos($contacto["nombre"], $texto) !== FALSE;
});
return $this->render('lista_contactos.html.twig', array(
'contactos' => $resultado
));
}
}
?>