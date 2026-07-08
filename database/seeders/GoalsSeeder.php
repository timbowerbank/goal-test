<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organisation;
use App\Models\Home;
use App\Models\Manager;
use App\Models\User;
use App\Models\Carer;
use App\Models\Goal;
use App\Models\GoalTask;
use App\Models\GoalNote;
use App\Models\Reward;
use App\Models\Client;
use App\Models\GoalAtom;
use App\Models\ActivityType;
use App\Enums\GoalStatus;
use App\Enums\TaskStatus;

class GoalsSeeder extends Seeder
{

    private array $homeNames = [
        'Didbury House',
        'Purleigh House',
        'Konnect House',
        'Bickford House',
        'Wakefield House',
        'Prescott House',
        'Gaskell House',
        ];

    private array $goalData = [
        [
            'title' => 'London Theatre Trip',
            'description' => 'Take train to London and enjoy a show',
            'goal_type' => 'milestone',
            'goal_status' => 'active',
            'activity_type' => 'Entertainment',
            'tasks' => [
                [
                    'title' => 'Book Train Ticket',
                    'description' => 'Go to station and book train ticket',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Research Shows',
                    'description' => 'Research a good show to go to, must be near a tube station',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Book Theatre Tickets',
                    'description' => 'Book tickets for the chosen show online or by phone',
                    'priority' => 'high',
                    'goal_task_status' => 'in progress',
                ],
            ],
        ],
        [
            'title' => 'Beaulieu Motor Museum',
            'description' => 'Visit the new forest and explore Beaulieu Motor Museum',
            'goal_type' => 'milestone',
            'goal_status' => 'completed',
            'activity_type' => 'Travel',
            'tasks' => [
                [
                    'title' => 'Plan The Route',
                    'description' => 'Research the best route to Beaulieu by public transport or car',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Book Museum Tickets',
                    'description' => 'Book entry tickets online in advance',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Pack A Lunch',
                    'description' => 'Prepare a packed lunch the night before',
                    'priority' => 'low',
                    'goal_task_status' => 'complete',
                ],
            ],
        ],
        [
            'title' => 'Improve My Teeth',
            'description' => 'Get brushing and flossing regularly.',
            'goal_type' => 'habit',
            'goal_status' => 'draft',
            'activity_type' => 'Wellbeing',
            'atom' => [
                'title' => 'Daily Brushing',
                'frequency_type' => 'twice daily',
                'frequency_value' => 90,
                'total_required' => 100,
            ],
            'tasks' => [
                [
                    'title' => 'Buy Toothbrush And Floss',
                    'description' => 'Visit the pharmacy and buy a new toothbrush and floss',
                    'priority' => 'high',
                    'goal_task_status' => 'not started',
                ],
                [
                    'title' => 'Book Dentist Appointment',
                    'description' => 'Book an initial check up with the local dentist',
                    'priority' => 'high',
                    'goal_task_status' => 'not started',
                ],
            ],
        ],
        [
            'title' => 'Learn To Make Breakfast',
            'description' => 'Prepare a simple breakfast independently each morning.',
            'goal_type' => 'habit',
            'goal_status' => 'active',
            'activity_type' => 'Life Skills',
            'atom' => [
                'title' => 'Daily Prep of Breakfast',
                'frequency_type' => 'daily',
                'frequency_value' => 90,
                'total_required' => 7,
            ],
            'tasks' => [
                [
                    'title' => 'Learn To Use The Toaster',
                    'description' => 'Practice using the toaster safely with carer supervision',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Practice Pouring Cereal',
                    'description' => 'Practice pouring cereal and milk into a bowl independently',
                    'priority' => 'medium',
                    'goal_task_status' => 'in progress',
                ],
                [
                    'title' => 'Write A Breakfast Menu',
                    'description' => 'Choose three breakfast options to rotate through the week',
                    'priority' => 'low',
                    'goal_task_status' => 'not started',
                ],
            ],
        ],
        [
            'title' => 'Visit Grandparents',
            'description' => 'Take the bus to visit grandparents for the afternoon.',
            'goal_type' => 'milestone',
            'goal_status' => 'active',
            'activity_type' => 'Social',
            'tasks' => [
                [
                    'title' => 'Learn The Bus Route',
                    'description' => 'Practice the bus route with a carer before going independently',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Plan The Visit',
                    'description' => 'Call grandparents to arrange a suitable date and time',
                    'priority' => 'medium',
                    'goal_task_status' => 'in progress',
                ],
            ],
        ],
        [
            'title' => 'Daily Walk',
            'description' => 'Go for a 20 minute walk around the local area each day.',
            'goal_type' => 'habit',
            'goal_status' => 'active',
            'activity_type' => 'Physical',
            'atom' => [
                'title' => 'Walking',
                'frequency_type' => 'daily',
                'frequency_value' => 90,
                'total_required' => 14,
            ],
            'tasks' => [
                [
                    'title' => 'Plan A Walking Route',
                    'description' => 'Map out a safe 20 minute walking route from the home',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Buy Comfortable Shoes',
                    'description' => 'Visit the shop to buy a pair of comfortable walking shoes',
                    'priority' => 'low',
                    'goal_task_status' => 'complete',
                ],
            ],
        ],
        [
            'title' => 'Swimming Lessons',
            'description' => 'Attend weekly swimming lessons at the local leisure centre.',
            'goal_type' => 'habit',
            'goal_status' => 'completed',
            'activity_type' => 'Physical',
            'atom' => [
                'title' => 'Swim Once a Week',
                'frequency_type' => 'weekly',
                'frequency_value' => 90,
                'total_required' => 4,
            ],
            'tasks' => [
                [
                    'title' => 'Register At Leisure Centre',
                    'description' => 'Visit the leisure centre and register for swimming lessons',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Buy Swimming Kit',
                    'description' => 'Purchase swimming costume, goggles and a towel',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Attend First Lesson',
                    'description' => 'Attend the first swimming lesson with carer support',
                    'priority' => 'high',
                    'goal_task_status' => 'complete',
                ],
            ],
        ],
        [
            'title' => 'Visit The Seaside',
            'description' => 'Take a day trip to Bournemouth beach.',
            'goal_type' => 'milestone',
            'goal_status' => 'draft',
            'activity_type' => 'Travel',
            'tasks' => [
                [
                    'title' => 'Check Travel Options',
                    'description' => 'Research train and bus options to Bournemouth',
                    'priority' => 'medium',
                    'goal_task_status' => 'not started',
                ],
                [
                    'title' => 'Plan Activities',
                    'description' => 'Decide on activities for the day — beach, arcade, fish and chips',
                    'priority' => 'low',
                    'goal_task_status' => 'not started',
                ],
            ],
        ],
        [
            'title' => 'Tidy My Room',
            'description' => 'Keep bedroom tidy by making bed and putting clothes away daily.',
            'goal_type' => 'habit',
            'goal_status' => 'active',
            'activity_type' => 'Life Skills',
            'atom' => [
                'title' => 'Daily Tidy',
                'frequency_type' => 'daily',
                'frequency_value' => 90,
                'total_required' => 7,
            ],
            'tasks' => [
                [
                    'title' => 'Declutter Bedroom',
                    'description' => 'Sort through belongings and donate items no longer needed',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Create A Tidying Routine',
                    'description' => 'Agree a daily tidying checklist with the carer',
                    'priority' => 'high',
                    'goal_task_status' => 'in progress',
                ],
            ],
        ],
        [
            'title' => 'Local Art Class',
            'description' => 'Attend a weekly art class at the community centre.',
            'goal_type' => 'habit',
            'goal_status' => 'draft',
            'activity_type' => 'Creative',
            'atom' => [
                'title' => 'Attend Class',
                'frequency_type' => 'weekly',
                'frequency_value' => 80,
                'total_required' => 4,
            ],
            'tasks' => [
                [
                    'title' => 'Find A Local Art Class',
                    'description' => 'Research art classes at the community centre or local college',
                    'priority' => 'high',
                    'goal_task_status' => 'not started',
                ],
                [
                    'title' => 'Buy Art Supplies',
                    'description' => 'Purchase basic art supplies — sketchbook, pencils, paints',
                    'priority' => 'low',
                    'goal_task_status' => 'not started',
                ],
            ],
        ],
        [
            'title' => 'Cooking A Meal',
            'description' => 'Plan and cook a simple evening meal for the house.',
            'goal_type' => 'milestone',
            'goal_status' => 'active',
            'activity_type' => 'Life Skills',
            'tasks' => [
                [
                    'title' => 'Choose A Recipe',
                    'description' => 'Pick a simple recipe to cook for the house',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Write A Shopping List',
                    'description' => 'Write out all the ingredients needed for the recipe',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Cook The Meal',
                    'description' => 'Cook the meal with carer supervision',
                    'priority' => 'high',
                    'goal_task_status' => 'in progress',
                ],
            ],
        ],
        [
            'title' => 'Reading For Pleasure',
            'description' => 'Read for 15 minutes before bed each night.',
            'goal_type' => 'habit',
            'goal_status' => 'completed',
            'activity_type' => 'Leisure',
            'atom' => [
                'title' => 'Read',
                'frequency_type' => 'daily',
                'frequency_value' => 90,
                'total_required' => 14,
            ],
            'tasks' => [
                [
                    'title' => 'Visit The Library',
                    'description' => 'Visit the local library and get a library card',
                    'priority' => 'medium',
                    'goal_task_status' => 'complete',
                ],
                [
                    'title' => 'Choose A Book',
                    'description' => 'Pick a book that looks interesting to start reading',
                    'priority' => 'low',
                    'goal_task_status' => 'complete',
                ],
            ],
        ],
    ];

    private array $goalNotes = [
        'Sed tristique nibh vel varius consectetur. Sed ut mauris mattis, faucibus mi eget, vehicula ante. Nunc at vulputate ipsum, eget aliquam risus. Aenean eget quam mauris. Aliquam eget leo in mi maximus fermentum. Phasellus mollis eros ac elit dapibus, id porta sapien iaculis. ',
        'Phasellus vel porta metus. Pellentesque lacus dolor, tincidunt sit amet neque at, pulvinar feugiat mi. Pellentesque iaculis non augue a dapibus.',
        'Praesent vulputate lectus vitae commodo venenatis. Sed a dui fermentum, imperdiet sapien dictum, tempus odio. Phasellus dignissim mattis mollis. Etiam quis sagittis sem, accumsan blandit nunc.',
    ];

    private array $rewards = [
        [
            'title' => 'Cream Tea at Bustopher Jones Cafe',
            'description' => 'If you complete the goal, then we will have a special trip to BJs'
        ],
        [
            'title' => 'Latest Mission Impossible Movie',
            'description' => 'If you complete the goal, we have tickets for the cinema waiting to see the latest Mission Impossible movie!'
        ],
        [
            'title' => 'Tea in Bed for the weekend',
            'description' => 'If you complete the goal, Dave will bring you a cup fo tea in bed for three mornings.'
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all clients as users
        $clients = Client::with([
            'user', 
            'home',
            'home.organisation',
            'home.managers.user',
            'home.carers.user'    
        ])->get();

        // validate there is a manager and carer
        

        // loop through users
        $mockGoalCounter = 0;
        $maxGoalCounterPerClient = 3;
        foreach($clients as $client) {

            $home = $client->home;
            $organisation = $home->organisations->first();
            $manager = $home->managers->first();
            $carer = $home->carers->first();

            if(!$manager || !$carer) {
                $this->command->warn("Skipping client {$client->user->full_name} - no manager or carer found for {$home->home_name}");
                continue;
            }

            // create more than 1 goal per client, based on $maxGoalCounterPerClient
            for($count = 0; $count < $maxGoalCounterPerClient; $count++) {

                // guard against this seeder creating goals in a live environment
                if(!in_array($client->home->home_name, $this->homeNames, true)) {
                    continue;
                }
                
                $data = $this->goalData[$mockGoalCounter % count($this->goalData)];
                
                // create a goal - array $data, User $client, User $manager, User $carer, Organisation $organisation, Home $home
                $goal = $this->createGoal($data, $client->user, $manager->user, $carer->user, $organisation, $home);
    
                // attach an activity type
                $this->attachActivityType($goal, $data);
    
                // attach carer to goal
                $this->attachGoalUser($carer->user, $goal, $manager->user);
    
                // create an atom if habit
                if($data['goal_type'] === 'habit') {
                    $this->createGoalAtom($data['atom'], $goal);
                }
    
                // create tasks
                foreach($data['tasks'] as $taskData) {
                    $this->createGoalTask($taskData, $goal, $manager->user, $carer->user);
                }
    
                // create a goal note
                $this->createGoalNote($goal, $manager->user);
    
                // create a reward
                $this->createReward($goal, $manager->user);
    
                // update $mockGoalCounter accordingly
                if($mockGoalCounter === count($this->goalData) - 1) {
                    $mockGoalCounter = 0;
                } else {
                    $mockGoalCounter++;
                }

            }

        }
    }

    private function createGoal(array $data, User $client, User $manager, User $carer, Organisation $organisation, Home $home):Goal {

        $goal = Goal::firstOrNew(
            [
                'title' => $data['title'],
                'client_user_id' => $client->id
            ],
            [
                'description' => $data['description'],
                'goal_type' => $data['goal_type'],
                'goal_status' => $data['goal_status'],
            ]);

        $goal->created_by_user_id = $manager->id;
        $goal->lead_user_id = $carer->id;
        $goal->home_id = $home->id;
        $goal->organisation_id = $organisation->id;
        if($data['goal_status'] === GoalStatus::Draft->value) {
            $goal->achieve_by = now()->plus(weeks: 4);
        } else if ($data['goal_status'] === GoalStatus::Active->value) {
            $goal->achieve_by = now()->plus(weeks: 5);
        } else {
            // must be completed
            $goal->achieve_by = now()->minus(weeks: 5);
            $goal->goal_completed_at = now()->minus(weeks: 6);
            $goal->goal_completed_with_user_id = $carer->id;
            $goal->status_percent = 100;
        }
        $goal->save();
        return $goal;

    }



    

    private function createGoalAtom(array $atom, Goal $goal):GoalAtom {
        $goalAtom = GoalAtom::firstOrNew(
            [
                'goal_id' => $goal->id
            ],
            [
                'title' => $atom['title'],
                'frequency_type' => $atom['frequency_type'],
                'frequency_value' => $atom['frequency_value'],
                'total_required' => $atom['total_required'],
            ]);

            return $goalAtom;
    }

    private function createGoalTask(array $taskData, Goal $goal, User $manager, User $carer ):GoalTask {

        $goalTask = GoalTask::firstOrNew(
            [
                'title' => $taskData['title'],
                'goal_id' => $goal->id,
            ],
            [
                'description' => $taskData['description'],
                'priority' => $taskData['priority'],
                'goal_task_status' => $taskData['goal_task_status'],

            ]);

        $goalTask->assigned_to_user_id = $carer->id;
        // due_at
        if($goal->goal_status === GoalStatus::Active || $goal->goal_status === GoalStatus::Draft) {
            $goalTask->due_at = now();
        }  else {
            // must be completed
            $goalTask->due_at = $goal->goal_completed_at->copy()->subWeek(); 
        }

        // completed_with and completed_at
        if($taskData['goal_task_status'] === TaskStatus::Complete->value) {
            $goalTask->completed_with_user_id = $carer->id;
            if($goal->goal_status === GoalStatus::Completed) {
                $goalTask->completed_at = $goal->goal_completed_at->copy()->subWeek();
            } else {
                $goalTask->completed_at = now();
            }
        }
        
        $goalTask->save();
        return $goalTask;
    }

    private function createGoalNote(Goal $goal, User $user):GoalNote {

            $randomText = $this->goalNotes[array_rand($this->goalNotes)];

            // prepend the goal name to it
            $randomText = "Note for: " . $goal->title . ". " . $randomText;

            $goalNote = GoalNote::firstOrNew(
                [
                    'goal_id' => $goal->id,
                    
                ],
                [
                    'note' => $randomText
                ]
            );

            $goalNote->created_by_user_id = $user->id;
            $goalNote->save();
            return $goalNote;

    }

    private function attachActivityType(Goal $goal, array $data):void {
        $activityType = ActivityType::where('name', $data['activity_type'])->first();
        if($activityType) {
            $goal->activityTypes()->syncWithoutDetaching([$activityType->id]);
        }
    }

    private function attachGoalUser(User $carer, Goal $goal, User $manager):void {

        $goal->users()->syncWithoutDetaching(
            [
                $carer->id => [
                    'assigned_by_user_id' => $manager->id,
                    'assigned_at' => $goal->created_at,
                ]
            ]
        );
    }

    private function createReward(Goal $goal, User $manager):Reward {
        $randomRewardMap = $this->rewards[array_rand($this->rewards)];

        $reward = Reward::firstOrNew(
            [
                'goal_id' => $goal->id
            ],
            [
                'title' => $randomRewardMap['title'],
                'description' => $randomRewardMap['description'],
            ]
        );
        $reward->created_by_user_id = $manager->id;

        $reward->save();
        return $reward;
    }


}
