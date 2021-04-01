<?php

namespace App\Console\Commands;

use App\Form;
use App\Notifications\EventNotification;
use App\Operation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class EndOperation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operation:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closse all operation where date is past';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $operations = Operation::all();
            foreach ($operations  as $operation)
            {
                $date1 = $operation->date_end;
                $date = Carbon::now();

                if($date > $date1)
                {
                    $message = "l'operration : " . $operation->nom . " est terminé.";
                    $AllUser = $operation->users()->where('role', '1')->get();
                    foreach ($AllUser as $User) {
                        $operation->users()->detach($User);
                    }

                    $AllOpUser = $operation->users()->where('role', '1')->where('role', '0')->get();
                    foreach ($AllOpUser as $user) {
                        $user->notify(new EventNotification($message));
                        $pusher = App::make('pusher');
                        $data = ['clossing an operation']; // sending from and to user id when pressed enter
                        $pusher->trigger('my-channel', 'notification-event', $data);
                    }
                    $form = Form::findOrFail($operation->form_id);
                    $form->status = Form::STATUS_CLOSED ;
                    $form->save();
                    $operation->status = "TERMINER";
                    $operation->save();
                }
            }
    }
}
