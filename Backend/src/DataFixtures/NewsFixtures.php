<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NewsFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /** @var Worker $worker */
        $worker = $this->getReference('worker1');

        $data = [
            ["Społeczność szkolna i my","1.jpg","W poniedziałek, 10 czerwca 2019 roku funkcjonariusze Zakładu Karnego w Przytułach Starych wzięli udział w „Dniu Służb Mundurowych”, który odbył się w hali sportowej i na boisku szkolnym Szkoły Podstawowej w Czerwinie."],
            ["„Pro Patria” - za kultywowanie pamięci o walce o niepodległość Rzeczypospolitej Polskiej","2.png","W dniach 30.05-02.06.2019 r. w Pułtusku odbył się XXXIV Międzynarodowy Zjazd Łagierników Żołnierzy Armii Krajowej, w którym gościli weterani i łagiernicy Armii Krajowej z Kresów Wschodnich m. in. Wileńszczyzny i Białorusi. Patronat honorowy nad zjazdem objął Prezydent Rzeczypospolitej Polskiej Andrzej Duda."],
            ["Nabywamy wiedzę","3.jpg","W dniach 31.05-01.06.2019 roku funkcjonariusze Zakładu Karnego w Przytułach Starych wzięli udział w II Międzynarodowych Warsztatach z zakresu Technik Interwencji i Samoobrony, które odbyło się w Państwowej Wyższej Szkole Zawodowej im. Prezydenta Stanisława Wojciechowskiego w Kaliszu."],
            ["Studenci w więzieniu","4.jpg","W dniu dzisiejszym studenci Państwowej Wyższej Szkoły Informatyki i Przedsiębiorczości w Łomży odwiedzili Zakład Karny w Przytułach Starych."],
            ["Jednośladem do Rosji","5.jpeg","W dniach 18-22 maja 2019 roku funkcjonariusze Zakładu Karnego w Przytułach Starych udali się motocyklami do Rosji."],
            ["29. Międzynarodowy Sztumski Bieg Solidarności","6.jpeg","Funkcjonariusze Zakładu Karnego w Przytułach Starych 3 maja 2019 roku wzięli udział w kolejnej edycji Biegu Funkcjonariuszy Służby Więziennej w ramach XXIX Międzynarodowego Biegu Solidarności, który odbył się na ulicach Sztumu."],
        ];

        foreach ($data as $key => $p) {
            $news = new News($p[0], $p[1], $p[2], $worker);
            $manager->persist($news);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            WorkerFixtures::class
        ];
    }
}
