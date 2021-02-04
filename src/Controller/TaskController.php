<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/task", name="task_")
 */
class TaskController extends AbstractController
{

    /**
     * @Route("/{id}/{page}", name="delete", methods={"DELETE"})
     * @Entity("task", expr="repository.find(id)")
     */
    public function delete(Request $request, Task $task, string $page): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
            }
        if($page === 'day') {
            return $this->redirectToRoute('to_do_list_day');
        } elseif ($page === 'week') {
            return $this->redirectToRoute('to_do_list_week');
        } else {
            return $this->redirectToRoute('to_do_list_all');
        }
    }

    /**
     * @Route("/{id}", name="done",  methods={"GET","POST"})
     * @Entity("task", expr="repository.find(id)")
     */
    public function done(Task $task): Response
    {
        $task->setIsOfTheWeek('1');
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Added to your to do list of the week !');
        return $this->redirectToRoute('to_do_list_week');
    }
}
