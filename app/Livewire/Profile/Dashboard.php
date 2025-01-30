<?php

namespace App\Livewire\Profile;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Dashboard extends Component
{
    use LivewireAlert;

    public string $active_tab = 'your_informations';

    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public array $roles;
    public int $comments_created;
    public string $created_at;
    public bool $banned;

    public bool $is_news_creator;
    public int $news_created;

    public bool $is_discussions_creator;
    public int $discussions_created;

    public string $new_email = '';
    public string $confirm_email = '';

    public string $current_password = '';
    public string $new_password = '';
    public string $confirm_password = '';

    public function mount()
    {
        $user = auth()->user();

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->roles = $user->roles()->get()->toArray();
        $this->banned = $user->banned;
        $this->created_at = Carbon::parse($user->created_at)->format('d F Y');
        $this->comments_created = $user->comments_on_articles()->count();
        $this->news_created = $user->newsArticles()->count();
        $this->discussions_created = $user->discussions()->count();

        $this->is_news_creator = $user->hasRole('news_creator');
        $this->is_discussions_creator = $user->hasRole('discussions_creator');
    }

    public function render()
    {
        return view('livewire.profile.dashboard');
    }

    protected function rules()
    {
        return [
            'current_password' => 'required_with:new_password',
            'new_email' => 'nullable|email',
            'confirm_email' => 'required_with:new_email',
            'new_password' => 'nullable|min:8',
            'confirm_password' => 'required_with:new_password'
        ];
    }

    protected function messages()
    {
        return [
            'current_password.required_with' => 'Current password is required when changing password.',
            'new_email.email' => 'Please enter a valid email address.',
            'confirm_email.required_with' => 'Please confirm your new email address.',
            'new_password.min' => 'Password must be at least 8 characters.',
            'confirm_password.required_with' => 'Please confirm your new password.'
        ];
    }

    public function updateUser()
    {
        if (empty($this->new_email) && empty($this->new_password))
            return;

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->alert(
                'error',
                'Validation Error',
                [
                    'toast' => false,
                    'text' => $e->validator->errors()->first(),
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
            return;
        }

        if (!empty($this->new_email) && $this->new_email != $this->confirm_email) {
            $this->alert(
                'error',
                'E-mail addresses are not matching!',
                [
                    'toast' => false,
                    'text' => 'Please ensure that you have typed the right address in both fields.',
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
            return;
        }

        if ($this->new_email == auth()->user()->email) {
            $this->alert(
                'error',
                'Invalid E-mail Address',
                [
                    'toast' => false,
                    'text' => 'Your new e-mail address cannot be the same as your old one.',
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
            return;
        }

        if (!empty($this->new_password) && $this->new_password != $this->confirm_password) {
            $this->alert(
                'error',
                'Passwords are not matching!',
                [
                    'toast' => false,
                    'text' => 'Please ensure that you have typed the right passwords in both fields.',
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
            return;
        }

        if (!empty($this->new_password) && !Hash::check($this->current_password, auth()->user()->password)) {
            $this->alert(
                'error',
                'Invalid Current Password',
                [
                    'toast' => false,
                    'text' => 'The current password you entered is incorrect.',
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
            return;
        }

        try {
            $user = auth()->user();

            if (!empty($this->new_email)) {
                $user->forceFill([
                    'email' => $this->new_email,
                    'email_verified_at' => null,
                ])->save();
                $this->email = $this->new_email;
            }

            if (!empty($this->new_password)) {
                $user->forceFill([
                    'password' => Hash::make($this->new_password),
                ])->save();
            }

            $this->reset(['current_password', 'new_email', 'confirm_email', 'new_password', 'confirm_password']);

            $this->alert(
                'success',
                'Profile Updated!',
                [
                    'toast' => false,
                    'text' => 'Your profile has been successfully updated.',
                    'position' => 'center',
                    'duration' => '3000'
                ]
            );
        } catch (\Exception $e) {
            Log::error($e);
            $this->alert(
                'error',
                'Update Failed',
                [
                    'toast' => false,
                    'text' => 'An error occurred while updating your profile. Please try again.',
                    'position' => 'center',
                    'duration' => '5000'
                ]
            );
        }
    }

    public function changeTab(string $tab)
    {
        if ($tab == $this->active_tab)
            return;

        $this->active_tab = $tab;
    }
}
