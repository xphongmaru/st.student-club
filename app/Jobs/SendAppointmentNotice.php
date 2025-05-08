<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AppointmentNotice;
use App\Models\User;
use App\Models\Club;
use Illuminate\Support\Facades\Mail;
use App\Models\RequestMemberClub;
use App\Enums\StatusJoinClub;

class SendAppointmentNotice implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;
    protected $sender_id;
    protected $receiver_id;
    protected $address;
    protected $dateTime;
    protected $time;
    protected $content;
    protected $club_id;
    protected $request_id;
    protected $note;
    /**
     * Create a new job instance.
     */
    public function __construct($sender_id, $receiver_id, $address, $dateTime, $content, $club_id, $request_id, $note)
    {
        $this->address = $address;
        $this->dateTime = $dateTime;
        $this->content = $content;
        $this->club_id = $club_id;
        $this->request_id = $request_id;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sender = User::find($this->sender_id);
        $receiver = User::find($this->receiver_id);
        $club = Club::find($this->club_id);
        $request = RequestMemberClub::find($this->request_id);

        if (!$sender || !$receiver || !$club || !$request) {
            \Log::error("Thiếu dữ liệu khi gửi email", [
                'sender_id' => $this->sender_id,
                'receiver_id' => $this->receiver_id,
                'club_id' => $this->club_id,
                'request_id' => $this->request_id,
            ]);
            return;
        }

        Mail::to($request->email)->send(new AppointmentNotice(
            $sender,
            $receiver,
            $this->address,
            $this->dateTime,
            $this->content,
            $club,
            $this->note
        ));

        $request->status =StatusJoinClub::Interview;
        $request->dateTime = $this->dateTime;
        $request->address = $this->address;
        $request->content = $this->content;
        $request->note = $this->note;
        $request->save();

    }

    public function failed(\Throwable $exception): void
    {
        $request = RequestMemberClub::find($this->request_id);
        if ($request) {
            $request->status = StatusJoinClub::Fail;
            $request->save();
        }
    }


}
