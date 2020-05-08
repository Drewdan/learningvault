<?php

namespace App\Notifications;

use App\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LessonSubmitted extends Notification implements ShouldQueue{

	use Queueable;

	/**
	 * @var \App\Lesson
	 */
	public $lesson;

	/**
	 * LessonSubmitted constructor.
	 *
	 * @param \App\Lesson lesson
	 */
	public function __construct(Lesson $lesson) {
		$this->lesson = $lesson;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function via($notifiable): array {
		return ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable): MailMessage
	{
		$url = route('profile.lesson.edit', ['lesson' => $this->lesson]);
		return (new MailMessage)
			->subject('New Lesson Submitted')
			->line('A new lesson has been submitted for review')
			->line('*Lesson name:* ' . $this->lesson->name)
			->line('*Lesson submitted by:* ' . $this->lesson->user->name)
			->action('Review Lesson', $url);
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable): array
	{
		return [
			$this->lesson->toArray(),
		];
	}
}
