<?php

namespace App\Jobs;

use App\Services\WhatsAppGatewayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $receiverNumber;
    protected $messageText;

    /**
     * Create a new job instance.
     */
    public function __construct($receiverNumber, $messageText)
    {
        $this->receiverNumber = $receiverNumber;
        $this->messageText = $messageText;
    }

    /**
     * Execute the job.
     */
    public function handle(WhatsAppGatewayService $waService): void
    {
        if (!empty($this->receiverNumber)) {
            $waService->sendMessage($this->receiverNumber, $this->messageText);
        }
    }
}
