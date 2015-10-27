<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TwitterType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
    ->add('title', 'text')
    ->add('postcontent', 'textarea')
    ->add('Postit', 'submit')
;
}

public function getName()
{
return 'twitter';
}
}