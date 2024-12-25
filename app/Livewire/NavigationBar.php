<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavigationBar extends Component
{
    public string $active_tab;
    public array $tabs;

    public function mount(string $active_tab)
    {
        $this->$active_tab = $active_tab;

        $this->tabs = [
            'Home' => [
                'route' => '/',
                'active' => strcmp('home', $active_tab) == 0
            ],
            'Discover' => [
                'route' => 'discover',
                'active' => strcmp('discover', $active_tab) == 0
            ],
            'News' => [
                'route' => 'news',
                'active' => strcmp('news', $active_tab) == 0
            ],
            'Discussions' => [
                'route' => 'discussions',
                'active' => strcmp('discussions', $active_tab) == 0
            ]
        ];

        $conditional_tabs = [];
        if(Auth::check()) {
            $conditional_tabs = [
                'Profile' => [
                    'route' => 'profile',
                    'active' => strcmp('profile', $active_tab) == 0
                ],
                'Logout' => [
                    'route' => 'logout',
                    'active' => strcmp('logout', $active_tab) == 0
                ]
            ];
        } else {
            $conditional_tabs = [
                'Login' => [
                    'route' => 'login',
                    'active' => strcmp('login', $active_tab) == 0
                ],
                'Register' => [
                    'route' => 'register',
                    'active' => strcmp('register', $active_tab) == 0
                ]
            ];
        }

        $this->tabs = array_merge($this->tabs, $conditional_tabs);
    }

    public function render()
    {
        return view('livewire.navigation-bar');
    }
}
