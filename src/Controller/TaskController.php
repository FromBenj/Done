<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
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
            $this->addFlash('danger', 'This task is deleted');
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
     * @Route("/{id}/{page}", name="done",  methods={"GET","POST"})
     * @Entity("task", expr="repository.find(id)")
     */
    public function done(Task $task, string $page): Response
    {
        $isDone = $task->getIsDone();
        if($isDone) {
            $task->setIsDone('0');
        } else {
            $task->setIsDone('1');
        }


        $this->getDoctrine()->getManager()->flush();

        if($task->getIsDone()) {
            $this->addFlash('success', 'Well done!');
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
     * @Route("/{id}", name="week",  methods={"GET","POST"})
     * @Entity("task", expr="repository.find(id)")
     */
    public function ofTheWeek(Task $task): Response
    {
        $isWeek = $task->getIsOfTheWeek();
        if($isWeek === true) {
            $task->setIsOfTheWeek(false);
        } else {
            $task->setIsOfTheWeek('1');
        }
        $this->getDoctrine()->getManager()->flush();

        if($task->getIsOfTheWeek()) {
            $this->addFlash('warning', 'Added to your to do list of the week !');
        }
        return $this->redirectToRoute('to_do_list_week');
    }

    /**
     * @Route("/modify/{id}/{page}", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Task $task, string $page): Response
    {
        // Check wether the logged in user is the owner of the task
        if ($this->getUser() == $task->getAuthor()) {
            $form = $this->createForm(TaskType::class, $task);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
            }
            return $this->render('task/edit.html.twig', [
                'task_form' => $form->createView(),
                'page'      => $page
            ]);
        }
        else {
            if($page === 'day') {
                return $this->redirectToRoute('to_do_list_day');
            } elseif ($page === 'week') {
                return $this->redirectToRoute('to_do_list_week');
            } else {
                return $this->redirectToRoute('to_do_list_all');
            }
        }
    }
}
