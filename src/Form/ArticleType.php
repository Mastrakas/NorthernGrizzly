<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\TypeArticle;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('text')
            ->add('date', DateType::class, ['widget' => 'single_text'])
            //->add('author', EntityType::class, ['class' => User::class, 'choice_label' => 'id'])
            ->add('type_article', EntityType::class, ['class' => TypeArticle::class, 'choice_label' => 'name'])
           // ->add('media')
           ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
