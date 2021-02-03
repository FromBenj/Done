<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/to/do/list", name="to_do_list_")
 */
class ToDoListController extends AbstractController
{
    /**
     * @Route("/all", name="all")
     */
    public function all(Request $request): Response
    {
        $day = date('l');
        $date = date('F\, \t\h\e jS');

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        }
        $allTasks = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAll();

        return $this->render('to_do_list/all.html.twig', [
            'day' => $day,
            'date'=> $date,
            'task_form' => $form->createView(),
            'all_tasks' => $allTasks,
        ]);
    }

    /**
     * @Route("/week", name="week")
     */
    public function week(Request $request): Response
    {

        $day = date('l');
        $date = date('F\, \t\h\e jS');

        $urgent = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findByName('Urgent');

        $allTasksUrgent = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'category' => $urgent,
                    'isOfTheWeek' => true,
                ]
            );

        $allTasksMonday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Monday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksTuesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Tuesday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksWednesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Wednesday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksThursday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Thursday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksFriday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Friday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksSaturday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Saturday',
                    'isOfTheWeek' => true
                ]
            );
        $allTasksSunday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Sunday',
                    'isOfTheWeek' => true
                ]
            );

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        }



        return $this->render('to_do_list/week.html.twig', [
            'day' => $day,
            'date'=> $date,
            'task_form' => $form->createView(),
            'tasks_monday' => $allTasksMonday,
            'tasks_tuesday' => $allTasksTuesday,
            'tasks_wednesday' => $allTasksWednesday,
            'tasks_thursday' => $allTasksThursday,
            'tasks_friday' => $allTasksFriday,
            'tasks_saturday' => $allTasksSaturday,
            'tasks_sunday' => $allTasksSunday,
            'tasks_urgent' => $allTasksUrgent,
        ]);

    }
}
