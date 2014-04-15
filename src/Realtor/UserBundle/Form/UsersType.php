<?php

namespace Realtor\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('outerId')
            ->add('login')
            ->add('password')
            ->add('email')
            ->add('lastLogin')
            ->add('isActive')
            ->add('roles')
            ->add('expiredAt')
            ->add('isAuthOnlyApp')
            ->add('manager')
            ->add('dismiss')
            ->add('dismissDate')
            ->add('fullName')
            ->add('firstName')
            ->add('secondName')
            ->add('lastName')
            ->add('inOffice')
            ->add('officePhone')
            ->add('officesIpPhone')
            ->add('phone')
            ->add('mayTrans')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('branch')
            ->add('idOfficeIn')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Realtor\UserBundle\Entity\Users'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'realtor_userbundle_users';
    }
}
