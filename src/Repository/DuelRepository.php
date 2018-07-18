<?php

namespace App\Repository;

use App\Entity\Duel;
use App\Entity\TypeDuel;
use App\Entity\Equipe;
use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @method Duel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Duel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Duel[]    findAll()
 * @method Duel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DuelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Duel::class);
    }
    
    public function nbMatchGagne(Equipe $equipe){
        $reqsql = "SELECT count(*) as nbMatchGagne FROM duel d WHERE (d.equipe1_id = :equipe AND d.score_equipe1 > d.score_equipe2) OR (d.equipe2_id = :equipe AND d.score_equipe1 < d.score_equipe2)";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        return $stmt->fetchAll();
    }
    
    public function nbMatchNul(Equipe $equipe){
        $reqsql = "SELECT count(*) as nbMatchNul FROM duel d WHERE (d.equipe1_id = :equipe AND d.score_equipe1 = d.score_equipe2) OR (d.equipe2_id = :equipe AND d.score_equipe1 = d.score_equipe2)";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        return $stmt->fetchAll();
    }
    
    public function nbMatchPerdu(Equipe $equipe){
        $reqsql = "SELECT count(*) as nbMatchPerdu FROM duel d WHERE (d.equipe1_id = :equipe AND d.score_equipe1 < d.score_equipe2) OR (d.equipe2_id = :equipe AND d.score_equipe1 > d.score_equipe2)";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        return $stmt->fetchAll();
    }
    
    public function nbMatchJoue(Equipe $equipe){
        $reqsql = "SELECT count(*) as nbMatch FROM duel d WHERE (d.equipe1_id = :equipe AND d.score_equipe1 IS NOT NULL AND d.score_equipe2 IS NOT NULL) OR (d.equipe2_id = :equipe AND d.score_equipe1 IS NOT NULL AND d.score_equipe2 IS NOT NULL)";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        return $stmt->fetchAll();
    }
    
    public function nbButPour(Equipe $equipe){
        $reqsql = "SELECT 
                        CASE
                            WHEN SUM(d.score_equipe1)IS NULL THEN '0'
                            ELSE SUM(d.score_equipe1)
                        END as nbButPour 
                    FROM duel d WHERE d.equipe1_id = :equipe";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        $butpour1 = $stmt->fetchAll();
        
        $reqsql = "SELECT 
                        CASE
                            WHEN SUM(d.score_equipe2)IS NULL THEN '0'
                            ELSE SUM(d.score_equipe2)
                        END as nbButPour 
                    FROM duel d WHERE d.equipe2_id = :equipe";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        $butpour2 = $stmt->fetchAll();
        
        return [0 => ["nbButPour" => intval($butpour1[0]['nbButPour']) + intval($butpour2[0]['nbButPour'])]];
    }
    
    public function nbButContre(Equipe $equipe){
        $reqsql = "SELECT 
                        CASE
                            WHEN SUM(d.score_equipe2)IS NULL THEN '0'
                            ELSE SUM(d.score_equipe2)
                        END as nbButContre 
                    FROM duel d WHERE d.equipe1_id = :equipe";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        $butcontre1 = $stmt->fetchAll();
        
        $reqsql = "SELECT 
                        CASE
                            WHEN SUM(d.score_equipe1)IS NULL THEN '0'
                            ELSE SUM(d.score_equipe1)
                        END as nbButContre 
                    FROM duel d WHERE d.equipe2_id = :equipe";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["equipe" => $equipe->getId()]);
        
        $butcontre2 = $stmt->fetchAll();
        
        return [0 => ["nbButContre" => intval($butcontre1[0]['nbButContre']) + intval($butcontre2[0]['nbButContre'])]];
    }
    
    public function findDuelByGroupe(Groupe $groupe){
        
        $reqsql = "SELECT * FROM duel d 
                    INNER JOIN groupe_equipe ge1 ON ge1.equipe_id = d.equipe1_id
                    INNER JOIN groupe_equipe ge2 ON ge2.equipe_id = d.equipe2_id
                    INNER JOIN type_duel td ON d.typeduel_id = td.id
                    WHERE ge1.groupe_id = :groupe AND ge2.groupe_id = :groupe AND d.horaire IS NOT NULL AND td.code_type_duel = :duel_poule
                    ORDER BY d.horaire";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($reqsql);
        $stmt->execute(["groupe" => $groupe->getId(), "duel_poule" => Duel::DUEL_POULE]);
        
        $retour = $stmt->fetchAll();
        
        $duels = new ArrayCollection();
        
        for($i=0;$i<count($retour);$i++)
        {
            $d = new Duel();
            if($retour[$i]['horaire'] != null)
                $d->setHoraire(new \DateTime($retour[$i]['horaire']));
            $d->setEquipe1($this->getEntityManager()->find(Equipe::class, $retour[$i]['equipe1_id']));
            $d->setEquipe2($this->getEntityManager()->find(Equipe::class, $retour[$i]['equipe2_id']));
            $d->setScoreEquipe1($retour[$i]['score_equipe1']);
            $d->setScoreEquipe2($retour[$i]['score_equipe2']);
            $d->setTypeduel($this->getEntityManager()->find(TypeDuel::class, $retour[$i]['typeduel_id']));
            $duels[] = $d;
        }
        
        return $duels;
    }

//    /**
//     * @return Duel[] Returns an array of Duel objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Duel
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
