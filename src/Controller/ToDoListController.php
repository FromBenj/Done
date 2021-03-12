<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TasksCurrentWeek;

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
        $userId = $user->getId();

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        }

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
            ->tasksOfTheDay('Monday', $userId);

        $allTasksTuesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Tuesday', $userId);

        $allTasksWednesday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Wednesday', $userId);

        $allTasksThursday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Thursday', $userId);

        $allTasksFriday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Friday', $userId);

        $allTasksSaturday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Saturday', $userId);

        $allTasksSunday = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Sunday', $userId);


        $allTasksNotDefined = $this->getDoctrine()
            ->getRepository(Task::class)
            ->tasksOfTheDay('Not', $userId);


        $allTasksOfTheWeek = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'isOfTheWeek' => true,
                    'author' => $user,
                ]
            );
        $nbTasksWeek = count($allTasksOfTheWeek);


        $allTasksOfTheWeekAndDone = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findBy(
                [
                    'isOfTheWeek' => true,
                    'author' => $user,
                    'isDone' => true,
                ]
            );
        $nbTasksDone = count($allTasksOfTheWeekAndDone);

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
            'tasks_not_defined' => $allTasksNotDefined,
            'tasks_urgent' => $allTasksUrgent,
            'nb_week' => $nbTasksWeek,
            'nb_done' => $nbTasksDone,
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
