<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use App\Models\WhatsappHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendLateReturnNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-late-return-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lateBorrows = Borrow::whereNull('returned_at')
            ->where('due_at', '<', now())
            ->with(['user', 'items'])
            ->get()
            ->groupBy('user_id');

        foreach ($lateBorrows as $userId => $borrows) {
            $user = $borrows->first()->user;
            $phone = $user->telephone;

            $earliestDue = $borrows->min('due_at');
            $dueDate = Carbon::parse($earliestDue)->format('d-m-Y H:i');

            $itemsList = "";
            foreach ($borrows as $borrow) {
                foreach ($borrow->items as $item) {
                    $itemName = $item->name ?? 'Barang';
                    $quantity = $item->pivot->quantity ?? 1;
                    $itemsList .= "- {$itemName} (x{$quantity})\n";
                }
            }

            $message = "Halo {$user->name},\n\n"
                . "Anda memiliki pinjaman yang belum dikembalikan:\n\n"
                . "{$itemsList}\n"
                . "Jatuh tempo: {$dueDate}\n\n"
                . "Mohon segera dikembalikan ke petugas. Terima kasih 🙏";

            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
            ]);
            
            WhatsappHistory::create([
                'user_id' => $user->id,
                'phone'   => $phone,
                'message' => $message,
                'sent_at' => now(),
                'status'  => $response->successful() ? 'success' : 'failed',
            ]);

            $this->info("Notifikasi terkirim ke {$user->name} ({$phone})");
        }

        return Command::SUCCESS;
    }
}
