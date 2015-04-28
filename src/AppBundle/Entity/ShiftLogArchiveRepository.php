<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Filesystem\Filesystem;

/**
 * ShiftLogArchiveRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ShiftLogArchiveRepository extends EntityRepository
{
    public function checkExistsShiftReport($archivedDate, $archivedShift)
    {
        $em = $this->findBy(array(
            'archivedDate' => $archivedDate,
            'archivedShift' => $archivedShift,));

        if (count($em) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function moveActiveToArchive($user, $shift, $date, $kernel_dir)
    {
        $fs = new Filesystem();
        $archive = [];

        $em = $this->getEntityManager();

        $entities = $em->getRepository('AppBundle:ShiftLog')->returnAllOrdered();

        foreach ($entities as $entity) {
            $archive['log'][] = array('info_type' => $entity['info_type'],
                                    'info_header' => $entity['info_header'],
                                    'content' => $entity['content'],);
        }

        $entities = $em->getRepository('AppBundle:ShiftLogFiles')->findAll();

        foreach ($entities as $entity) {
            $archive['files'][] = array('description' => $entity->getDescription(),
                                        'file_name' => $entity->getFileName(),);

            $fs->copy($kernel_dir.'/../web/uploads/shiftlog/'.$entity->getFileName(),
                $kernel_dir.'/../web/uploads/shiftlog/archive/'.$entity->getFileName());
        }

        $shiftLogArchive = new ShiftLogArchive();
        $shiftLogArchive->setContent(serialize($archive));
        $shiftLogArchive->setArchivedDate($date);
        $shiftLogArchive->setArchivedBy($user);
        $shiftLogArchive->setArchivedShift($shift);
        $em->persist($shiftLogArchive);

        $em->flush();
    }
}
