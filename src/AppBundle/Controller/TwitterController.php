<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\RegisterType;
use AppBundle\Form\Type\LoginType;
use AppBundle\Form\Type\TwitterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Account;
use AppBundle\Entity\Twitter;
use Symfony\Component\HttpFoundation\Request;

class TwitterController extends Controller
{
    /**
     * @Route("/twitter")
     * @Route("/twitter/")
     * @Route("/twitter/{val}")
     */
    public function indexAction(Request $request, $val = null)
    {
        $twitter = new Twitter();
        $twitter->setTitle('#titel hier');
        $twitter->setPostContent('#twitter bericht hier');
        $form = $this->createForm(new TwitterType(), $twitter, array(
            'action' => "",
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            return $this->forward('AppBundle:Twitter:thankyou', array(
                'getTitle' => $twitter->getTitle(),
                'getPostContent' => $twitter->getPostContent(),
            ));
        }
        //retrieve data
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Twitter');
        $twitter = $repository->findAll(); // find all
        //parse to twigie, pass $val with twigie
        return $this->render(
            'twitter/twitter.html.twig',
            array('data_twitter' => $twitter,
                'value' => $val,
                'current_year' => date("Y"),
                'twitter_form' => $form->createView(),
            ));
    }

    /**
     * @Route("/thankyou")
     * @Route("/thankyou/")
     */
    public
    function thankyouAction($getTitle, $getPostContent)
    {
        $twitter = new twitter();
        $twitter->setPostContent($getPostContent);
        $twitter->setTitle($getTitle);
        $twitter->setCreated(time());
        $twitter->setLastEdit($getTitle);
        $em = $this->getDoctrine()->getManager();
        $em->persist($twitter);
        $em->flush();
        return $this->render(
            'twitter/success.html.twig',
            array('getTitle' => $getTitle,
                'getPostContent' => $getPostContent,
                'current_year' => date("Y"),
            ));
    }

    /**
     * @Route("/created")
     * @Route("/created/")
     */
    public
    function createdAction($getUsername, $getPassword, $getEmail)
    {
        $account = new account();
        $account->setUsername($getUsername);
        $account->setPassword(strtoupper(sha1($getUsername . ":" . $getPassword)));
        $account->setEmail($getEmail);
        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();
        return $this->render(
            'twitter/success_created.html.twig',
            array('getUsername' => $getUsername,
                'getEmail' => $getEmail,
                'current_year' => date("Y"),
            ));
    }

    /**
     * @Route("/verifyLogin")
     * @Route("/verifyLogin/")
     */
    public
    function verifyLoginAction($getUsername, $getPassword)
    {
        $account = new account();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->select('COUNT(f.id)')
            ->from('AppBundle:Account', 'f')
            ->where('f.username = :username',
                'f.password = :password')
            ->setParameter('username', $getUsername)
            ->setParameter('password', strtoupper(sha1($getUsername . ":" . $getPassword)))
            ->getQuery();

        $total = $query->getSingleScalarResult();
        if ($total >= 1) {
            return $this->render(
                'twitter/account.html.twig',
                array('current_year' => date("Y"),
                ));
        } else {
            die("wrong credentials" . " <b>username:</b> " . $getUsername . " <b>-------</b> <b>pass:</b> " . strtoupper(sha1($getUsername . ":" . $getPassword)));
        }
        return $this->render(
            'twitter/success_created.html.twig',
            array('getUsername' => $getUsername,
                'getEmail' => $getEmail,
                'current_year' => date("Y"),
            ));
    }

    /**
     * @Route("/register")
     * @Route("/register/")
     */
    public
    function register(Request $request)
    {
        $account = new Account();
        $account->setUsername('username');
        $account->setPassword('password');
        $account->setEmail('vincent.provo@tactics.be');
        $form = $this->createForm(new RegisterType(), $account, array(
            'action' => "",
            'method' => 'POST',
        ));
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->forward('AppBundle:Twitter:created', array(
                'getUsername' => $account->getUsername(),
                'getPassword' => $account->getPassword(),
                'getEmail' => $account->getEmail(),
            ));
        }
        return $this->render(
            'twitter/register.html.twig',
            array('current_year' => date("Y"),
                'register_form' => $form->createView(),
            ));
    }

    /**
     * @Route("login")
     * @Route("/login")
     * @Route("/login/")
     */
    public
    function login(Request $request)
    {
        $account = new Account();
        $account->setUsername('username');
        $account->setPassword('password');
        $form = $this->createForm(new LoginType(), $account, array(
            'action' => "",
            'method' => 'POST',
        ));
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->forward('AppBundle:Twitter:verifyLogin', array(
                'getUsername' => $account->getUsername(),
                'getPassword' => $account->getPassword(),
            ));
        }
        return $this->render(
            'twitter/login.html.twig',
            array('current_year' => date("Y"),
                'login_form' => $form->createView(),
            ));
    }
}