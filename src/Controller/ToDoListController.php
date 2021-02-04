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

        $user = $this->getUser();

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
            ->findBy(
                [
                    'author' => $user,
                ]
            );

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

        $user = $this->getUser();

        $urgent = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findByName('Urgent');

        $allTasksUrgent = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'category' => $urgent,
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );

        $allTasksMonday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Monday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksTuesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Tuesday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksWednesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Wednesday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksThursday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Thursday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksFriday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Friday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksSaturday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Saturday',
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $allTasksSunday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => 'Sunday',
                    'isOfTheWeek' => true,
                    'author' => $user,
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

    /**
     * @Route("/day", name="day")
     */
    public function day(Request $request): Response
    {
        $day = date('l');
        $date = date('F\, \t\h\e jS');
        $user = $this->getUser();

        $tasksOfTheDay = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'day' => $day,
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );

        return $this->render('to_do_list/day.html.twig', [
            'day' => $day,
            'date'=> $date,
            'tasks_day' => $tasksOfTheDay,
        ]);
    }
}
