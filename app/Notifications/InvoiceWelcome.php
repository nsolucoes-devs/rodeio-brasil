<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class InvoiceWelcome extends Notification
{
    use Queueable, SerializesModels;

    private $user;

    private $password;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Seja Bem-vindo à Miss e Mister Rodeio Brasil!')
            ->greeting('Olá, '.$this->user->first_name.', Seja muito bem-vindo à Miss e Mister Rodeio Brasil, a primeira empresa de Cash on Delivery no Brasil!')
            ->action('ACESSAR O DASHBOARD', route('admin.index'))
            ->line('Aqui você terá acesso a todas as funcionalidades disponíveis para gerenciar a sua conta e dos candidatos.')
            ->salutation('Muito obrigado, Equipe Miss e Mister Rodeio Brasi');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
