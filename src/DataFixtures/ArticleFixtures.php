<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Promotions;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            $article->setNomarticle("gunnm Tome $i")
                    ->setPrixArticle(9.95)
                    ->setPointArticle(10)
                    ->setLaPromotion(null);
                    
            $manager->persist($article);
           
        }

        $manager->flush();
    }
}
