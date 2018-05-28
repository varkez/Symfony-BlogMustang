<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Controller\PageController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends Controller
{
    /**
    * @Route("/page", name="page")
    */
    public function index()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController.php',
        ]);
    }

    /**
     * @Route("/sidebar", name="sidebar")
     */
    public function sidebar() {
        return $this->render('sidebar/sidebar.html.twig');
    }

    /**
    * @Route("/contact", name="contact")
    * @Method("GET|POST")
    */
    public function contact(Request $request)
    {
        $enquiry = new Contact();
        $form = $this->createForm(ContactType::class, $enquiry);

            $this->request = $request;
                if ($request->getMethod() == 'POST') {
                $form->bind($request);
 
 
                if ($form->isValid()) {
                        $message = \Swift_Message::newInstance()
                                ->setSubject('Envoie demande de conatct BlogToDev')
                                ->setFrom('cariou.franck@gmail.com')
                                ->setTo($this->container->getParameter('app.emails.contact_email'))
                                ->setBody($this->renderView('contact/contactEmail.txt.twig', array('enquiry' => $enquiry)));
                            $this->get('mailer')->send($message);
             
                        $this->get('session')->getFlashbag('blog-notice', 'Votre demande de contact a bien été envoyée. Je vous remercie!');
  
                    // Redirect - This is important to prevent users re-posting
                    // the form if they refresh the page
                    return $this->redirect($this->generateUrl('contact'));
                }
            }
 
            return $this->render('contact/contact.html.twig', array(
                'form' => $form->createView()
            ));
    }
}
